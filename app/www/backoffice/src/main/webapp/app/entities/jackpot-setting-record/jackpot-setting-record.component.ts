import { Component, OnInit, OnDestroy } from '@angular/core';
import { HttpHeaders, HttpResponse } from '@angular/common/http';
import { ActivatedRoute, ParamMap, Router, Data } from '@angular/router';
import { Subscription, combineLatest } from 'rxjs';
import { JhiEventManager } from 'ng-jhipster';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

import { IJackpotSettingRecord } from 'app/shared/model/jackpot-setting-record.model';

import { ITEMS_PER_PAGE } from 'app/shared/constants/pagination.constants';
import { JackpotSettingRecordService } from './jackpot-setting-record.service';
import { JackpotSettingRecordDeleteDialogComponent } from './jackpot-setting-record-delete-dialog.component';

import { FormBuilder, FormGroup } from '@angular/forms';

import { faCalendar } from '@fortawesome/free-solid-svg-icons';
import * as moment from 'moment/moment';
import { Moment } from 'moment/moment';

@Component({
  selector: 'jhi-jackpot-setting-record',
  templateUrl: './jackpot-setting-record.component.html',
  styleUrls: ['./jackpot-setting-record.component.scss'],
})
export class JackpotSettingRecordComponent implements OnInit, OnDestroy {
  jackpotSettingRecords?: IJackpotSettingRecord[];
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
    protected jackpotSettingRecordService: JackpotSettingRecordService,
    protected activatedRoute: ActivatedRoute,
    protected router: Router,
    protected eventManager: JhiEventManager,
    protected modalService: NgbModal,
    private formBuilder: FormBuilder
  ) {
    this.filterForm = this.formBuilder.group({
      createdBy: '',
      startDate: moment(new Date()),
      startTime: { hour: 0, minute: 0, second: 0 },
      endDate: moment(new Date()),
      endTime: { hour: 23, minute: 59, second: 59 },
    });
  }

  loadPage(page?: number, dontNavigate?: boolean): void {
    // const formControl = this.filterForm.controls;
    // const start = new Date(
    //   formControl.startDate.value.year(),
    //   formControl.startDate.value.month(),
    //   formControl.startDate.value.date(),
    //   formControl.startTime.value['hour'],
    //   formControl.startTime.value['minute'],
    //   formControl.startTime.value['second'],
    //   0
    // );
    // const end = new Date(
    //   formControl.endDate.value.year(),
    //   formControl.endDate.value.month(),
    //   formControl.endDate.value.date(),
    //   formControl.endTime.value['hour'],
    //   formControl.endTime.value['minute'],
    //   formControl.endTime.value['second'],
    //   0
    // );
    const pageToLoad: number = page || this.page || 1;

    // eslint-disable-next-line
    console.log(this.sort());
    this.jackpotSettingRecordService
      .findJPSetting({
        page: pageToLoad - 1,
        size: this.itemsPerPage,
        sort: this.sort(),
        // sdate: start.toISOString(),
        // edate: end.toISOString(),
      })
      .subscribe(
        (res: HttpResponse<any>) => this.onSuccess(res.body, res.headers, pageToLoad, !dontNavigate),
        () => this.onError()
      );
  }

  ngOnInit(): void {
    this.handleNavigation();
    this.registerChangeInJackpotSettingRecords();
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

  trackId(index: number, item: IJackpotSettingRecord): number {
    // eslint-disable-next-line @typescript-eslint/no-unnecessary-type-assertion
    return item.id!;
  }

  registerChangeInJackpotSettingRecords(): void {
    this.eventSubscriber = this.eventManager.subscribe('jackpotSettingRecordListModification', () => this.loadPage());
  }

  delete(jackpotSettingRecord: IJackpotSettingRecord): void {
    const modalRef = this.modalService.open(JackpotSettingRecordDeleteDialogComponent, { size: 'lg', backdrop: 'static' });
    modalRef.componentInstance.jackpotSettingRecord = jackpotSettingRecord;
  }

  sort(): string[] {
    const result = [this.predicate + ',' + (this.ascending ? 'asc' : 'desc')];
    if (this.predicate !== 'id') {
      result.push('id');
    }
    return result;
  }

  protected onSuccess(data: any | null, headers: HttpHeaders, page: number, navigate: boolean): void {
    // this.totalItems = Number(headers.get('X-Total-Count'));
    this.totalItems = data['totalElements'];
    this.page = page;
    if (navigate) {
      this.router.navigate(['/jackpot-setting-record'], {
        queryParams: {
          page: this.page,
          size: this.itemsPerPage,
          sort: this.predicate + ',' + (this.ascending ? 'asc' : 'desc'),
        },
      });
    }
    this.jackpotSettingRecords = this.formatData(data.content) || [];
    this.ngbPaginationPage = this.page;
  }

  formatData(list: any): any {
    if (!list) return [];
    list.map((item: any) => {
      const listValue = item.value.split(';');
      let newValue = '';
      listValue.forEach((num: string, idx: number) => {
        if (idx !== listValue.length - 1) {
          newValue += `${this.numberWithCommas(Number(num))};`;
        } else {
          newValue += `${this.numberWithCommas(Number(num))}`;
        }
      });
      item['value'] = newValue;
    });
    return list;
  }

  protected onError(): void {
    this.ngbPaginationPage = this.page ?? 1;
  }

  onSubmit(filter: {
    createdBy: string;
    startDate: Moment;
    startTime: { hour: number; minute: number; second: number };
    endDate: Moment;
    endTime: { hour: number; minute: number; second: number };
  }): void {
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
    this.jackpotSettingRecordService
      .findJPSetting({
        page: 0,
        size: this.itemsPerPage,
        sort: this.sort(),
        createdBy: filter.createdBy,
        sdate: start.toISOString(),
        edate: end.toISOString(),
      })
      .subscribe(
        (res: HttpResponse<any>) => this.onSuccess(res.body, res.headers, 1, false),
        () => this.onError()
      );
  }

  numberWithCommas(x: number): string {
    const num = Number(x).toFixed(0);
    return num
      .toString()
      .replace(/\D/g, '')
      .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
  }
}
