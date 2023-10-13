import { ITEMS_PER_PAGE } from 'app/shared/constants/pagination.constants';
import { Component, OnInit, OnDestroy } from '@angular/core';
import { HttpHeaders, HttpResponse } from '@angular/common/http';
import { Observable, Subscription, combineLatest } from 'rxjs';
import { JhiAlertService, JhiEventManager } from 'ng-jhipster';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

import { IRocketRank } from 'app/shared/model/rocket-rank.model';
import { RocketRankService } from './rocket-rank.service';
import { RocketRankDeleteDialogComponent } from './rocket-rank-delete-dialog.component';
import { ActivatedRoute, Router, Data, ParamMap } from '@angular/router';
import { SaveAllDialogComponent } from 'app/shared/dialog/save-all/save-all.component';

@Component({
  selector: 'jhi-rocket-rank',
  templateUrl: './rocket-rank.component.html',
  styleUrls: ['./rocket-rank.component.scss'],
})
export class RocketRankComponent implements OnInit, OnDestroy {
  rocketRanks?: IRocketRank[];
  eventSubscriber?: Subscription;
  totalItems = 0;
  itemsPerPage = ITEMS_PER_PAGE;
  page!: number;
  predicate!: string;
  ascending!: boolean;
  ngbPaginationPage = 1;
  isEditing = false;
  isSavingAll = false;
  recordUpdateCount = 0;
  recordUpdateSuccessCount = 0;
  recordUpdateErrorCount = 0;
  rocketRanksUpdate?: IRocketRank[];
  validateUpdateFail = false;

  constructor(
    protected rocketRankService: RocketRankService,
    protected eventManager: JhiEventManager,
    protected modalService: NgbModal,
    protected activatedRoute: ActivatedRoute,
    protected router: Router,
    private alertService: JhiAlertService
  ) {
    this.ascending = false;
    this.isEditing = false;
  }

  loadAll(): void {
    this.rocketRankService.query().subscribe((res: HttpResponse<IRocketRank[]>) => (this.rocketRanks = res.body || []));
  }

  loadPage(page?: number, dontNavigate?: boolean): void {
    const pageToLoad: number = page || this.page || 1;

    this.rocketRankService
      .query({
        page: pageToLoad - 1,
        size: this.itemsPerPage,
        sort: this.sort(),
      })
      .subscribe(
        (res: HttpResponse<IRocketRank[]>) => this.onSuccess(res.body, res.headers, pageToLoad, !dontNavigate),
        () => this.onError()
      );
  }

  ngOnInit(): void {
    this.handleNavigation();
    this.registerChangeInRocketRanks();
  }

  protected handleNavigation(): void {
    combineLatest(this.activatedRoute.data, this.activatedRoute.queryParamMap, (data: Data, params: ParamMap) => {
      const page = params.get('page');
      const pageNumber = page !== null ? +page : 1;
      const sort = (params.get('sort') ?? data['defaultSort']).split(',');
      const predicate = sort[0];
      const ascending = sort[1] === 'asc';
      if (pageNumber !== this.page || predicate !== this.predicate || ascending !== this.ascending) {
        this.predicate = predicate;
        this.ascending = ascending;
        this.loadPage(pageNumber, true);
      }
    }).subscribe();
  }

  ngOnDestroy(): void {
    if (this.eventSubscriber) {
      this.eventManager.destroy(this.eventSubscriber);
    }
  }

  trackId(index: number, item: IRocketRank): number {
    // eslint-disable-next-line @typescript-eslint/no-unnecessary-type-assertion
    return item.id!;
  }

  registerChangeInRocketRanks(): void {
    this.eventSubscriber = this.eventManager.subscribe('rocketRankListModification', () => this.loadAll());
  }

  delete(rocketRank: IRocketRank): void {
    const modalRef = this.modalService.open(RocketRankDeleteDialogComponent, { size: 'lg', backdrop: 'static' });
    modalRef.componentInstance.rocketRank = rocketRank;
  }

  sort(): string[] {
    const result = [this.predicate + ',' + (this.ascending ? 'desc' : 'asc')];
    if (this.predicate !== 'amount') {
      result.push('amount');
    }
    return result;
  }

  protected onSuccess(data: IRocketRank[] | null, headers: HttpHeaders, page: number, navigate: boolean): void {
    this.totalItems = Number(headers.get('X-Total-Count'));
    this.page = page;
    if (navigate) {
      this.router.navigate(['/rocket-rank'], {
        queryParams: {
          page: this.page,
          size: this.itemsPerPage,
          sort: this.predicate + ',' + (this.ascending ? 'asc' : 'desc'),
        },
      });
    }
    this.rocketRanks = data || [];
    this.ngbPaginationPage = this.page;
  }

  protected onError(): void {
    this.ngbPaginationPage = this.page ?? 1;
  }

  editAll(): void {
    if (this.rocketRanks && this.rocketRanks.length > 0) {
      this.isEditing = true;
    }
  }

  saveAll(): void {
    this.rocketRanksUpdate?.forEach(rank => {
      this.subscribeToSaveResponse(this.rocketRankService.update(rank));
    });
    // if (this.validateUpdateFail) {
    //   this.alertService.warning('txcbApp.rocketRank.home.validationAmountMinMax');
    //   this.validateUpdateFail = false;
    //   return;
    // }
    // this.isSavingAll = true;
    // this.recordUpdateCount = 0;
    // this.rocketRanksUpdate = [];
    // if (this.rocketRanks && this.rocketRanks.length > 0) {
    //   for (let i = 0; i < this.rocketRanks.length; i++) {
    //     if (this.rocketRanks[i]['updated']) {
    //       this.rocketRanksUpdate.push(this.rocketRanks[i]);
    //     }
    //   }
    // }
    // if (this.rocketRanksUpdate && this.rocketRanksUpdate.length > 0) {
    //   this.rocketRanksUpdate.forEach(rank => {
    //     this.subscribeToSaveResponse(this.rocketRankService.update(rank));
    //   });
    // } else {
    //   this.isEditing = false;
    //   this.isSavingAll = false;
    // }
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<IRocketRank>>): void {
    result.subscribe(
      () => {
        this.recordUpdateSuccessCount++;
        if (this.rocketRanksUpdate?.length === this.recordUpdateSuccessCount + this.recordUpdateErrorCount) {
          this.resetAfterSave();
        }
      },
      () => {
        this.recordUpdateErrorCount++;
        if (this.rocketRanksUpdate?.length === this.recordUpdateSuccessCount + this.recordUpdateErrorCount) {
          this.resetAfterSave(this.recordUpdateSuccessCount, this.recordUpdateErrorCount);
        }
      }
    );
  }

  updateAmount(ev: any, id: any): void {
    this.rocketRanks?.map(rank => {
      if (rank.id === id && rank.amount !== Number(ev.target.value)) {
        if (Number(ev.target.value) < 1000000) {
          rank.amount = ev.target.value = 1000000;
          this.validateUpdateFail = true;
        } else if (Number(ev.target.value) > 99999999999999999) {
          rank.amount = ev.target.value = 99999999999999999;
          this.validateUpdateFail = true;
        } else if (!Number(ev.target.value)) {
          ev.target.value = rank.amount;
          return;
        } else {
          rank.amount = ev.target.value;
        }
        rank['updated'] = true;
      }
      return rank;
    });
  }

  updateLoginname(ev: any, id: any): void {
    this.rocketRanks?.map(rank => {
      if (rank.id === id && rank.loginname !== ev.target.value.trim()) {
        rank.loginname = ev.target.value.trim();
        rank['updated'] = true;
      }
      return rank;
    });
  }

  resetAfterSave(successRecord?: number, errorRecord?: number): void {
    if (!errorRecord || errorRecord === 0) {
      this.alertService.success('txcbApp.rocketRank.home.msgSuccess');
    } else {
      this.alertService.addAlert(
        {
          type: 'warning',
          msg: 'txcbApp.rocketRank.home.msgUnsuccessAll',
          params: {
            param1: successRecord,
            param2: errorRecord,
          },
          timeout: 3500,
        },
        []
      );
    }
    this.recordUpdateSuccessCount = 0;
    this.recordUpdateErrorCount = 0;
    this.isSavingAll = false;
    this.isEditing = false;
    this.rocketRanksUpdate = [];
    this.validateUpdateFail = false;
    this.rocketRanks?.map(rank => {
      if (rank['updated']) rank['updated'] = false;
      return rank;
    });
    this.eventManager.broadcast('rocketRankListModification'); // update rank list after change
  }

  cancalEditAll(): void {
    this.isSavingAll = false;
    this.isEditing = false;
    this.eventManager.broadcast('rocketRankListModification'); // update rank list after change
  }

  saveAllConfirm(): any {
    // const modalRef = this.modalService.open(SaveAllDialogComponent, { size: 'lg', backdrop: 'static' });
    // modalRef.componentInstance.rocketRate = rocketRate;
    this.isSavingAll = true;
    this.recordUpdateCount = 0;
    this.rocketRanksUpdate = [];
    if (this.rocketRanks && this.rocketRanks.length > 0) {
      for (let i = 0; i < this.rocketRanks.length; i++) {
        if (this.rocketRanks[i]['updated']) {
          this.rocketRanksUpdate.push(this.rocketRanks[i]);
        }
      }
    }
    if (this.rocketRanksUpdate && this.rocketRanksUpdate.length > 0) {
      // this.rocketRatesUpdate.forEach(rate => {
      //   this.subscribeToSaveResponse(this.rocketRateService.update(rate));
      // });
      const modalRef = this.modalService.open(SaveAllDialogComponent, { size: 'lg', backdrop: 'static' });
      // modalRef.componentInstance.rocketRate = rocketRate;
      modalRef.result.then(
        data => {
          if (data) {
            this.saveAll();
          }
        },
        // eslint-disable-next-line
        dismiss => {
          // this.isEditing = false;
          this.isSavingAll = false;
        }
      );
    } else {
      this.isEditing = false;
      this.isSavingAll = false;
    }
  }
}
