import { Component, OnInit } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';

import { IJackpotSettingRecord, JackpotSettingRecord } from 'app/shared/model/jackpot-setting-record.model';
import { JackpotSettingRecordService } from './jackpot-setting-record.service';

@Component({
  selector: 'jhi-jackpot-setting-record-update',
  templateUrl: './jackpot-setting-record-update.component.html',
})
export class JackpotSettingRecordUpdateComponent implements OnInit {
  isSaving = false;

  editForm = this.fb.group({
    id: [],
  });

  constructor(
    protected jackpotSettingRecordService: JackpotSettingRecordService,
    protected activatedRoute: ActivatedRoute,
    private fb: FormBuilder
  ) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ jackpotSettingRecord }) => {
      this.updateForm(jackpotSettingRecord);
    });
  }

  updateForm(jackpotSettingRecord: IJackpotSettingRecord): void {
    this.editForm.patchValue({
      id: jackpotSettingRecord.id,
    });
  }

  previousState(): void {
    window.history.back();
  }

  save(): void {
    this.isSaving = true;
    const jackpotSettingRecord = this.createFromForm();
    if (jackpotSettingRecord.id !== undefined) {
      this.subscribeToSaveResponse(this.jackpotSettingRecordService.update(jackpotSettingRecord));
    } else {
      this.subscribeToSaveResponse(this.jackpotSettingRecordService.create(jackpotSettingRecord));
    }
  }

  private createFromForm(): IJackpotSettingRecord {
    return {
      ...new JackpotSettingRecord(),
      id: this.editForm.get(['id'])!.value,
    };
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<IJackpotSettingRecord>>): void {
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
