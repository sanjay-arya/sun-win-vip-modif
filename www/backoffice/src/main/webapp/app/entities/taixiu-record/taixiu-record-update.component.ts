import { Component, OnInit } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';
import * as moment from 'moment';
import { DATE_TIME_FORMAT } from 'app/shared/constants/input.constants';

import { ITaixiuRecord, TaixiuRecord } from 'app/shared/model/taixiu-record.model';
import { TaixiuRecordService } from './taixiu-record.service';

@Component({
  selector: 'jhi-taixiu-record-update',
  templateUrl: './taixiu-record-update.component.html',
})
export class TaixiuRecordUpdateComponent implements OnInit {
  isSaving = false;

  editForm = this.fb.group({
    id: [],
    taixiuId: [],
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

  constructor(protected taixiuRecordService: TaixiuRecordService, protected activatedRoute: ActivatedRoute, private fb: FormBuilder) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ taixiuRecord }) => {
      if (!taixiuRecord.id) {
        const today = moment().startOf('day');
        taixiuRecord.bettime = today;
      }

      this.updateForm(taixiuRecord);
    });
  }

  updateForm(taixiuRecord: ITaixiuRecord): void {
    this.editForm.patchValue({
      id: taixiuRecord.id,
      taixiuId: taixiuRecord.taixiuId,
      userId: taixiuRecord.userId,
      loginname: taixiuRecord.loginname,
      betamount: taixiuRecord.betamount,
      winamount: taixiuRecord.winamount,
      typed: taixiuRecord.typed,
      status: taixiuRecord.status,
      bettime: taixiuRecord.bettime ? taixiuRecord.bettime.format(DATE_TIME_FORMAT) : null,
      result: taixiuRecord.result,
      description: taixiuRecord.description,
      refundamount: taixiuRecord.refundamount,
      ip: taixiuRecord.ip,
    });
  }

  previousState(): void {
    window.history.back();
  }

  save(): void {
    this.isSaving = true;
    const taixiuRecord = this.createFromForm();
    if (taixiuRecord.id !== undefined) {
      this.subscribeToSaveResponse(this.taixiuRecordService.update(taixiuRecord));
    } else {
      this.subscribeToSaveResponse(this.taixiuRecordService.create(taixiuRecord));
    }
  }

  private createFromForm(): ITaixiuRecord {
    return {
      ...new TaixiuRecord(),
      id: this.editForm.get(['id'])!.value,
      taixiuId: this.editForm.get(['taixiuId'])!.value,
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

  protected subscribeToSaveResponse(result: Observable<HttpResponse<ITaixiuRecord>>): void {
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
