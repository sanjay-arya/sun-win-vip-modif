import { SaveAllDialogComponent } from './../../shared/dialog/save-all/save-all.component';
import { Component, OnInit, OnDestroy } from '@angular/core';
import { HttpHeaders, HttpResponse } from '@angular/common/http';
import { Observable, Subscription } from 'rxjs';
import { JhiAlertService, JhiEventManager, JhiParseLinks } from 'ng-jhipster';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

import { IRocketRate } from 'app/shared/model/rocket-rate.model';

import { ITEMS_PER_PAGE } from 'app/shared/constants/pagination.constants';
import { RocketRateService } from './rocket-rate.service';
import { RocketRateDeleteDialogComponent } from './rocket-rate-delete-dialog.component';
import { AccountService } from 'app/core/auth/account.service';
import { Authority } from 'app/shared/constants/authority.constants';
/* eslint-disable */
@Component({
  selector: 'jhi-rocket-rate',
  templateUrl: './rocket-rate.component.html',
  styleUrls: ['./rocket-rate.component.scss'],
})
export class RocketRateComponent implements OnInit, OnDestroy {
  rocketRates: IRocketRate[];
  eventSubscriber?: Subscription;
  itemsPerPage: number;
  links: any;
  page: number;
  predicate: string;
  ascending: boolean;
  isEditing = false;
  isSavingAll = false;
  recordUpdateCount = 0;
  recordUpdateSuccessCount = 0;
  recordUpdateErrorCount = 0;
  rocketRatesUpdate?: IRocketRate[];
  hasPermission: boolean;

  constructor(
    protected rocketRateService: RocketRateService,
    protected eventManager: JhiEventManager,
    protected modalService: NgbModal,
    protected parseLinks: JhiParseLinks,
    private alertService: JhiAlertService,
    private accountService: AccountService
  ) {
    this.rocketRates = [];
    this.itemsPerPage = ITEMS_PER_PAGE;
    this.page = 0;
    this.links = {
      last: 0,
    };
    this.predicate = 'id';
    this.ascending = true;
    this.isEditing = false;
    this.hasPermission = false;
  }

  loadAll(): void {
    this.rocketRateService
      .query({
        page: this.page,
        size: this.itemsPerPage,
        sort: this.sort(),
      })
      .subscribe((res: HttpResponse<IRocketRate[]>) => this.paginateRocketRates(res.body, res.headers));
  }

  reset(): void {
    this.page = 0;
    this.rocketRates = [];
    this.loadAll();
  }

  loadPage(page: number): void {
    this.page = page;
    this.loadAll();
  }

  ngOnInit(): void {
    this.accountService.getAuthenticationState().subscribe(account => {
      this.hasPermission = this.getPermission(account);
    });
    this.loadAll();
    this.registerChangeInRocketRates();
  }

  ngOnDestroy(): void {
    if (this.eventSubscriber) {
      this.eventManager.destroy(this.eventSubscriber);
    }
  }

  trackId(index: number, item: IRocketRate): number {
    // eslint-disable-next-line @typescript-eslint/no-unnecessary-type-assertion
    return item.id!;
  }

  registerChangeInRocketRates(): void {
    this.eventSubscriber = this.eventManager.subscribe('rocketRateListModification', () => this.reset());
  }

  delete(rocketRate: IRocketRate): void {
    const modalRef = this.modalService.open(RocketRateDeleteDialogComponent, { size: 'lg', backdrop: 'static' });
    modalRef.componentInstance.rocketRate = rocketRate;
  }

  sort(): string[] {
    const result = [this.predicate + ',' + (this.ascending ? 'asc' : 'desc')];
    if (this.predicate !== 'id') {
      result.push('id');
    }
    return result;
  }

  protected paginateRocketRates(data: IRocketRate[] | null, headers: HttpHeaders): void {
    const headersLink = headers.get('link');
    this.links = this.parseLinks.parse(headersLink ? headersLink : '');
    if (data) {
      for (let i = 0; i < data.length; i++) {
        this.rocketRates.push(data[i]);
      }
    }
  }

  updateRate(ev: any, id: any): void {
    this.rocketRates?.map(rate => {
      if (rate.id === id && Number(rate.rate) != Number(ev.target.value.trim())) {
        rate.rate = ev.target.value.trim();
        rate['updated'] = true;
      }
      return rate;
    });
  }

  editAll(): void {
    if (this.rocketRates && this.rocketRates.length > 0) {
      this.isEditing = true;
    }
  }

  saveAll(): void {
    this.rocketRatesUpdate?.forEach(rate => {
      this.subscribeToSaveResponse(this.rocketRateService.update(rate));
    });
    // this.isSavingAll = true;
    // this.recordUpdateCount = 0;
    // this.rocketRatesUpdate = [];
    // if (this.rocketRates && this.rocketRates.length > 0) {
    //   for (let i = 0; i < this.rocketRates.length; i++) {
    //     if (this.rocketRates[i]['updated']) {
    //       this.rocketRatesUpdate.push(this.rocketRates[i]);
    //     }
    //   }
    // }
    // if (this.rocketRatesUpdate && this.rocketRatesUpdate.length > 0) {
    //   this.rocketRatesUpdate.forEach(rate => {
    //     this.subscribeToSaveResponse(this.rocketRateService.update(rate));
    //   });
    // } else {
    //   this.isEditing = false;
    //   this.isSavingAll = false;
    // }
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<IRocketRate>>): void {
    result.subscribe(
      () => {
        this.recordUpdateSuccessCount++;
        if (this.rocketRatesUpdate?.length === this.recordUpdateSuccessCount + this.recordUpdateErrorCount) {
          this.resetAfterSave();
        }
      },
      () => {
        this.recordUpdateErrorCount++;
        if (this.rocketRatesUpdate?.length === this.recordUpdateSuccessCount + this.recordUpdateErrorCount) {
          this.resetAfterSave(this.recordUpdateSuccessCount, this.recordUpdateErrorCount);
        }
      }
    );
  }

  resetAfterSave(successRecord?: number, errorRecord?: number): void {
    if (!errorRecord || errorRecord === 0) {
      this.alertService.success('txcbApp.rocketRate.home.msgSuccess');
    } else {
      this.alertService.addAlert(
        {
          type: 'warning',
          msg: 'txcbApp.rocketRate.home.msgUnsuccessAll',
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
    this.rocketRatesUpdate = [];
    this.rocketRates?.map(rate => {
      if (rate['updated']) rate['updated'] = false;
      return rate;
    });
    this.eventManager.broadcast('rocketRateListModification'); // update rate list after change
  }

  cancalEditAll(): void {
    this.isSavingAll = false;
    this.isEditing = false;
    this.eventManager.broadcast('rocketRateListModification'); // update rate list after change
  }

  saveAllConfirm() {
    // const modalRef = this.modalService.open(SaveAllDialogComponent, { size: 'lg', backdrop: 'static' });
    // modalRef.componentInstance.rocketRate = rocketRate;
    this.isSavingAll = true;
    this.recordUpdateCount = 0;
    this.rocketRatesUpdate = [];
    if (this.rocketRates && this.rocketRates.length > 0) {
      for (let i = 0; i < this.rocketRates.length; i++) {
        if (this.rocketRates[i]['updated']) {
          this.rocketRatesUpdate.push(this.rocketRates[i]);
        }
      }
    }
    if (this.rocketRatesUpdate && this.rocketRatesUpdate.length > 0) {
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

  getPermission(account: any): boolean {
    if (account && account.authorities && account.authorities.length > 0 && account.authorities.includes(Authority.ADMIN)) {
      return true;
    }
    return false;
  }
}
