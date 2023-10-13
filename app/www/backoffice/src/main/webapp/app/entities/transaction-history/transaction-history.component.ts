import { Component, OnInit, OnDestroy } from '@angular/core';
import { HttpHeaders, HttpResponse } from '@angular/common/http';
import { ActivatedRoute, ParamMap, Router, Data } from '@angular/router';
import { Subscription, combineLatest } from 'rxjs';
import { JhiEventManager } from 'ng-jhipster';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

import { ITransactionHistory } from 'app/shared/model/transaction-history.model';
import { FormBuilder, FormGroup } from '@angular/forms';

import { faCalendar } from '@fortawesome/free-solid-svg-icons';
import { ITEMS_PER_PAGE } from 'app/shared/constants/pagination.constants';
import { TransactionHistoryService } from './transaction-history.service';
import { TransactionHistoryDeleteDialogComponent } from './transaction-history-delete-dialog.component';
import * as moment from 'moment/moment';
import { Moment } from 'moment/moment';

@Component({
  selector: 'jhi-transaction-history',
  templateUrl: './transaction-history.component.html',
  styleUrls: ['./transaction-history.component.scss'],
})
export class TransactionHistoryComponent implements OnInit, OnDestroy {
  transactionHistories?: ITransactionHistory[];
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
    protected transactionHistoryService: TransactionHistoryService,
    protected activatedRoute: ActivatedRoute,
    protected router: Router,
    protected eventManager: JhiEventManager,
    protected modalService: NgbModal,
    private formBuilder: FormBuilder
  ) {
    this.filterForm = this.formBuilder.group({
      username: '',
      action: '',
      startDate: moment(new Date()),
      startTime: { hour: 0, minute: 0, second: 0 },
      endDate: moment(new Date()),
      endTime: { hour: 23, minute: 59, second: 59 },
    });
  }

  loadPage(page?: number, dontNavigate?: boolean): void {
    const pageToLoad: number = page || this.page || 1;

    this.transactionHistoryService
      .query({
        page: pageToLoad - 1,
        size: this.itemsPerPage,
        sort: this.sort(),
      })
      .subscribe(
        (res: HttpResponse<ITransactionHistory[]>) => this.onSuccess(res.body, res.headers, pageToLoad, !dontNavigate),
        () => this.onError()
      );
  }

  ngOnInit(): void {
    this.handleNavigation();
    this.registerChangeInTransactionHistories();
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

  trackId(index: number, item: ITransactionHistory): number {
    // eslint-disable-next-line @typescript-eslint/no-unnecessary-type-assertion
    return item.id!;
  }

  registerChangeInTransactionHistories(): void {
    this.eventSubscriber = this.eventManager.subscribe('transactionHistoryListModification', () => this.loadPage());
  }

  delete(transactionHistory: ITransactionHistory): void {
    const modalRef = this.modalService.open(TransactionHistoryDeleteDialogComponent, { size: 'lg', backdrop: 'static' });
    modalRef.componentInstance.transactionHistory = transactionHistory;
  }

  sort(): string[] {
    const result = [this.predicate + ',' + (this.ascending ? 'asc' : 'desc')];
    if (this.predicate !== 'id') {
      result.push('id');
    }
    return result;
  }

  protected onSuccess(data: ITransactionHistory[] | null, headers: HttpHeaders, page: number, navigate: boolean): void {
    this.totalItems = Number(headers.get('X-Total-Count'));
    this.page = page;
    if (navigate) {
      this.router.navigate(['/transaction-history'], {
        queryParams: {
          page: this.page,
          size: this.itemsPerPage,
          sort: this.predicate + ',' + (this.ascending ? 'asc' : 'desc'),
        },
      });
    }
    this.transactionHistories = data || [];
    this.ngbPaginationPage = this.page;
  }

  protected onError(): void {
    this.ngbPaginationPage = this.page ?? 1;
  }

  onSubmit(filter: {
    username: string;
    action: number;
    startDate: Moment;
    startTime: { hour: number; minute: number; second: number };
    endDate: Moment;
    endTime: { hour: number; minute: number; second: number };
  }): void {
    filter.action = parseInt(String(filter.action), 10);
    const start = new Date(
      filter.startDate.year(),
      filter.startDate.month(),
      filter.startDate.date(),
      filter.startTime.hour,
      filter.startTime.minute,
      filter.startTime.second,
      0
    );
    const end = new Date(
      filter.endDate.year(),
      filter.endDate.month(),
      filter.endDate.date(),
      filter.endTime.hour,
      filter.endTime.minute,
      filter.endTime.second,
      0
    );
    this.transactionHistoryService
      .query({
        page: 0,
        size: this.itemsPerPage,
        sort: this.sort(),
        username: filter.username ? filter.username : null,
        action: isNaN(filter.action) ? null : filter.action,
        starttime: start.toISOString(),
        endTime: end.toISOString(),
      })
      .subscribe(
        (res: HttpResponse<ITransactionHistory[]>) => this.onSuccess(res.body, res.headers, 1, false),
        () => this.onError()
      );
  }
}
