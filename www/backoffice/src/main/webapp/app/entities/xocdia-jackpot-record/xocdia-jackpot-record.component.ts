import { Component, OnInit, OnDestroy } from '@angular/core';
import { HttpHeaders, HttpResponse } from '@angular/common/http';
import { ActivatedRoute, ParamMap, Router, Data } from '@angular/router';
import { Subscription, combineLatest } from 'rxjs';
import { JhiEventManager } from 'ng-jhipster';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

import { IXocdiaJackpotRecord } from 'app/shared/model/xocdia-jackpot-record.model';

import { ITEMS_PER_PAGE } from 'app/shared/constants/pagination.constants';
import { XocdiaJackpotRecordService } from './xocdia-jackpot-record.service';
import { XocdiaJackpotRecordDeleteDialogComponent } from './xocdia-jackpot-record-delete-dialog.component';
import { faCalendar } from '@fortawesome/free-solid-svg-icons';
import { FormBuilder, FormGroup } from '@angular/forms';

@Component({
  selector: 'jhi-xocdia-jackpot-record',
  templateUrl: './xocdia-jackpot-record.component.html',
  styleUrls: ['./xocdia-jackpot-record.component.scss'],
})
export class XocdiaJackpotRecordComponent implements OnInit, OnDestroy {
  xocdiaJackpotRecords?: IXocdiaJackpotRecord[];
  eventSubscriber?: Subscription;
  totalItems = 0;
  itemsPerPage = ITEMS_PER_PAGE;
  page!: number;
  predicate!: string;
  ascending!: boolean;
  ngbPaginationPage = 1;
  filterForm: FormGroup;
  faCalendar = faCalendar;

  constructor(
    protected xocdiaJackpotRecordService: XocdiaJackpotRecordService,
    protected activatedRoute: ActivatedRoute,
    protected router: Router,
    protected eventManager: JhiEventManager,
    protected modalService: NgbModal,
    private formBuilder: FormBuilder
  ) {
    this.ascending = false;
    this.filterForm = this.formBuilder.group({
      // loginName: '',
      gameid: '',
    });
  }

  loadPage(page?: number, dontNavigate?: boolean): void {
    const pageToLoad: number = page || this.page || 1;

    this.xocdiaJackpotRecordService
      .query({
        page: pageToLoad - 1,
        size: this.itemsPerPage,
        sort: this.sort(),
      })
      .subscribe(
        (res: HttpResponse<IXocdiaJackpotRecord[]>) => this.onSuccess(res.body, res.headers, pageToLoad, !dontNavigate),
        () => this.onError()
      );
  }

  ngOnInit(): void {
    this.handleNavigation();
    this.registerChangeInXocdiaJackpotRecords();
  }

  protected handleNavigation(): void {
    combineLatest(this.activatedRoute.data, this.activatedRoute.queryParamMap, (data: Data, params: ParamMap) => {
      const page = params.get('page');
      const pageNumber = page !== null ? +page : 1;
      // const sort = (params.get('sort') ?? data['defaultSort']).split(',');
      const sort = (params.get('sort') ?? 'id,desc').split(','); // change default is desc
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

  trackId(index: number, item: IXocdiaJackpotRecord): number {
    // eslint-disable-next-line @typescript-eslint/no-unnecessary-type-assertion
    return item.id!;
  }

  registerChangeInXocdiaJackpotRecords(): void {
    this.eventSubscriber = this.eventManager.subscribe('xocdiaJackpotRecordListModification', () => this.loadPage());
  }

  delete(xocdiaJackpotRecord: IXocdiaJackpotRecord): void {
    const modalRef = this.modalService.open(XocdiaJackpotRecordDeleteDialogComponent, { size: 'lg', backdrop: 'static' });
    modalRef.componentInstance.xocdiaJackpotRecord = xocdiaJackpotRecord;
  }

  sort(): string[] {
    const result = [this.predicate + ',' + (this.ascending ? 'asc' : 'desc')];
    if (this.predicate !== 'id') {
      result.push('id');
    }
    return result;
  }

  protected onSuccess(data: IXocdiaJackpotRecord[] | null, headers: HttpHeaders, page: number, navigate: boolean): void {
    this.totalItems = Number(headers.get('X-Total-Count'));
    this.page = page;
    if (navigate) {
      this.router.navigate(['/xocdia-jackpot-record'], {
        queryParams: {
          page: this.page,
          size: this.itemsPerPage,
          sort: this.predicate + ',' + (this.ascending ? 'asc' : 'desc'),
        },
      });
    }
    this.xocdiaJackpotRecords = data || [];
    this.ngbPaginationPage = this.page;
  }

  protected onError(): void {
    this.ngbPaginationPage = this.page ?? 1;
  }

  onSubmit(filter: {
    // loginName: string;
    gameid: number;
  }): void {
    filter.gameid = parseInt(String(filter.gameid), 10);

    this.xocdiaJackpotRecordService
      .query({
        page: 0,
        size: this.itemsPerPage,
        sort: this.sort(),
        // loginname: filter.loginName ? filter.loginName : null,
        gameid: isNaN(filter.gameid) ? null : filter.gameid,
      })
      .subscribe(
        (res: HttpResponse<IXocdiaJackpotRecord[]>) => this.onSuccess(res.body, res.headers, 1, false),
        () => this.onError()
      );
  }
}
