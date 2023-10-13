import { Component, OnInit, OnDestroy } from '@angular/core';
import { HttpHeaders, HttpResponse } from '@angular/common/http';
import { ActivatedRoute, ParamMap, Router, Data } from '@angular/router';
import { Subscription, combineLatest, Observable } from 'rxjs';
import { JhiAlertService, JhiEventManager } from 'ng-jhipster';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

import { IXocdiaRank } from 'app/shared/model/xocdia-rank.model';

import { ITEMS_PER_PAGE } from 'app/shared/constants/pagination.constants';
import { XocdiaRankService } from './xocdia-rank.service';
import { XocdiaRankDeleteDialogComponent } from './xocdia-rank-delete-dialog.component';
import { SaveAllDialogComponent } from 'app/shared/dialog/save-all/save-all.component';

@Component({
  selector: 'jhi-xocdia-rank',
  templateUrl: './xocdia-rank.component.html',
  styleUrls: ['./xocdia-rank.component.scss'],
})
export class XocdiaRankComponent implements OnInit, OnDestroy {
  xocdiaRanks?: IXocdiaRank[];
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
  xocdiaRanksUpdate?: IXocdiaRank[];
  validateUpdateFail = false;

  constructor(
    protected xocdiaRankService: XocdiaRankService,
    protected activatedRoute: ActivatedRoute,
    protected router: Router,
    protected eventManager: JhiEventManager,
    protected modalService: NgbModal,
    private alertService: JhiAlertService
  ) {
    this.ascending = false;
    this.isEditing = false;
  }

  loadPage(page?: number, dontNavigate?: boolean): void {
    const pageToLoad: number = page || this.page || 1;

    this.xocdiaRankService
      .query({
        page: pageToLoad - 1,
        size: this.itemsPerPage,
        sort: this.sort(),
      })
      .subscribe(
        (res: HttpResponse<IXocdiaRank[]>) => this.onSuccess(res.body, res.headers, pageToLoad, !dontNavigate),
        () => this.onError()
      );
  }

  ngOnInit(): void {
    this.handleNavigation();
    this.registerChangeInXocdiaRanks();
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

  trackId(index: number, item: IXocdiaRank): number {
    // eslint-disable-next-line @typescript-eslint/no-unnecessary-type-assertion
    return item.id!;
  }

  registerChangeInXocdiaRanks(): void {
    this.eventSubscriber = this.eventManager.subscribe('xocdiaRankListModification', () => this.loadPage());
  }

  delete(xocdiaRank: IXocdiaRank): void {
    const modalRef = this.modalService.open(XocdiaRankDeleteDialogComponent, { size: 'lg', backdrop: 'static' });
    modalRef.componentInstance.xocdiaRank = xocdiaRank;
  }

  sort(): string[] {
    const result = [this.predicate + ',' + (this.ascending ? 'asc' : 'desc')];
    if (this.predicate !== 'amount') {
      result.push('amount');
    }
    return result;
  }

  protected onSuccess(data: IXocdiaRank[] | null, headers: HttpHeaders, page: number, navigate: boolean): void {
    this.totalItems = Number(headers.get('X-Total-Count'));
    this.page = page;
    if (navigate) {
      this.router.navigate(['/xocdia-rank'], {
        queryParams: {
          page: this.page,
          size: this.itemsPerPage,
          sort: this.predicate + ',' + (this.ascending ? 'asc' : 'desc'),
        },
      });
    }
    this.xocdiaRanks = data || [];
    this.ngbPaginationPage = this.page;
  }

  protected onError(): void {
    this.ngbPaginationPage = this.page ?? 1;
  }

  editAll(): void {
    if (this.xocdiaRanks && this.xocdiaRanks.length > 0) {
      this.isEditing = true;
    }
  }

  saveAll(): void {
    this.xocdiaRanksUpdate?.forEach(rank => {
      this.subscribeToSaveResponse(this.xocdiaRankService.update(rank));
    });
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<IXocdiaRank>>): void {
    result.subscribe(
      () => {
        this.recordUpdateSuccessCount++;
        if (this.xocdiaRanksUpdate?.length === this.recordUpdateSuccessCount + this.recordUpdateErrorCount) {
          this.resetAfterSave();
        }
      },
      () => {
        this.recordUpdateErrorCount++;
        if (this.xocdiaRanksUpdate?.length === this.recordUpdateSuccessCount + this.recordUpdateErrorCount) {
          this.resetAfterSave(this.recordUpdateSuccessCount, this.recordUpdateErrorCount);
        }
      }
    );
  }

  updateAmount(ev: any, id: any): void {
    this.xocdiaRanks?.map(rank => {
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
    this.xocdiaRanks?.map(rank => {
      if (rank.id === id && rank.loginname !== ev.target.value.trim()) {
        rank.loginname = ev.target.value.trim();
        rank['updated'] = true;
      }
      return rank;
    });
  }

  resetAfterSave(successRecord?: number, errorRecord?: number): void {
    if (!errorRecord || errorRecord === 0) {
      this.alertService.success('txcbApp.txRank.home.msgSuccess');
    } else {
      this.alertService.addAlert(
        {
          type: 'warning',
          msg: 'txcbApp.txRank.home.msgUnsuccessAll',
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
    this.xocdiaRanksUpdate = [];
    this.validateUpdateFail = false;
    this.xocdiaRanks?.map(rank => {
      if (rank['updated']) rank['updated'] = false;
      return rank;
    });
    this.eventManager.broadcast('txRankListModification'); // update rank list after change
  }

  cancalEditAll(): void {
    this.isSavingAll = false;
    this.isEditing = false;
    this.eventManager.broadcast('txRankListModification'); // update rank list after change
  }

  saveAllConfirm(): any {
    this.isSavingAll = true;
    this.recordUpdateCount = 0;
    this.xocdiaRanksUpdate = [];
    if (this.xocdiaRanks && this.xocdiaRanks.length > 0) {
      for (let i = 0; i < this.xocdiaRanks.length; i++) {
        if (this.xocdiaRanks[i]['updated']) {
          this.xocdiaRanksUpdate.push(this.xocdiaRanks[i]);
        }
      }
    }
    if (this.xocdiaRanksUpdate && this.xocdiaRanksUpdate.length > 0) {
      const modalRef = this.modalService.open(SaveAllDialogComponent, { size: 'lg', backdrop: 'static' });
      modalRef.result.then(
        data => {
          if (data) {
            this.saveAll();
          }
        },
        // eslint-disable-next-line
        dismiss => {
          this.isSavingAll = false;
        }
      );
    } else {
      this.isEditing = false;
      this.isSavingAll = false;
    }
  }
}
