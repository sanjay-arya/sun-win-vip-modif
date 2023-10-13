import { Component, OnInit } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';

import { IXocdiaRecord, XocdiaRecord } from 'app/shared/model/xocdia-record.model';
import { XocdiaRecordService } from './xocdia-record.service';
import * as moment from 'moment';
import { DATE_TIME_FORMAT } from 'app/shared/constants/input.constants';

@Component({
  selector: 'jhi-xocdia-record-update',
  templateUrl: './xocdia-record-update.component.html',
})
export class XocdiaRecordUpdateComponent implements OnInit {
  isSaving = false;

  editForm = this.fb.group({
    id: [],
    xocdiaId: [],
    userId: [],
    loginname: [],
    betamount: [],
    winamount: [],
    typed: [],
    status: [],
    bettime: [],
    result: [],
    description: [],
    refundamount: [],
    ip: [],
  });

  constructor(protected xocdiaRecordService: XocdiaRecordService, protected activatedRoute: ActivatedRoute, private fb: FormBuilder) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ xocdiaRecord }) => {
      if (!xocdiaRecord.id) {
        const today = moment().startOf('day');
        xocdiaRecord.bettime = today;
      }
      this.updateForm(xocdiaRecord);
    });
  }

  updateForm(xocdiaRecord: IXocdiaRecord): void {
    this.editForm.patchValue({
      id: xocdiaRecord.id,
      xocdiaId: xocdiaRecord.xocdiaId,
      userId: xocdiaRecord.userId,
      loginname: xocdiaRecord.loginname,
      betamount: xocdiaRecord.betamount,
      winamount: xocdiaRecord.winamount,
      typed: xocdiaRecord.typed,
      status: xocdiaRecord.status,
      bettime: xocdiaRecord.bettime ? xocdiaRecord.bettime.format(DATE_TIME_FORMAT) : null,
      result: xocdiaRecord.result,
      description: xocdiaRecord.description,
      refundamount: xocdiaRecord.refundamount,
      ip: xocdiaRecord.ip,
    });
  }

  previousState(): void {
    window.history.back();
  }

  save(): void {
    this.isSaving = true;
    const xocdiaRecord = this.createFromForm();
    if (xocdiaRecord.id !== undefined) {
      this.subscribeToSaveResponse(this.xocdiaRecordService.update(xocdiaRecord));
    } else {
      this.subscribeToSaveResponse(this.xocdiaRecordService.create(xocdiaRecord));
    }
  }

  private createFromForm(): IXocdiaRecord {
    return {
      ...new XocdiaRecord(),
      id: this.editForm.get(['id'])!.value,
      xocdiaId: this.editForm.get(['xocdiaId'])!.value,
      userId: this.editForm.get(['userId'])!.value,
      loginname: this.editForm.get(['loginname'])!.value,
      betamount: this.editForm.get(['betamount'])!.value,
      winamount: this.editForm.get(['winamount'])!.value,
      typed: this.editForm.get(['typed'])!.value,
      status: this.editForm.get(['status'])!.value,
      bettime: this.editForm.get(['bettime'])!.value ? moment(this.editForm.get(['bettime'])!.value, DATE_TIME_FORMAT) : undefined,
      result: this.editForm.get(['result'])!.value,
      description: this.editForm.get(['description'])!.value,
      refundamount: this.editForm.get(['refundamount'])!.value,
      ip: this.editForm.get(['ip'])!.value,
    };
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<IXocdiaRecord>>): void {
    result.subscribe(
      () => this.onSaveSuccess(),
      () => this.onSaveError()
    );
  }

  protected onSaveSuccess(): void {
    this.isSaving = false;
    this.previousState();
  }

  protected onSaveError(): void {
    this.isSaving = false;
  }
}
