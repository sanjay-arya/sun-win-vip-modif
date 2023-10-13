import { Component, OnInit } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';

import { IXocdiaJackpotRecord, XocdiaJackpotRecord } from 'app/shared/model/xocdia-jackpot-record.model';
import { XocdiaJackpotRecordService } from './xocdia-jackpot-record.service';

@Component({
  selector: 'jhi-xocdia-jackpot-record-update',
  templateUrl: './xocdia-jackpot-record-update.component.html',
})
export class XocdiaJackpotRecordUpdateComponent implements OnInit {
  isSaving = false;

  editForm = this.fb.group({
    id: [],
  });

  constructor(
    protected xocdiaJackpotRecordService: XocdiaJackpotRecordService,
    protected activatedRoute: ActivatedRoute,
    private fb: FormBuilder
  ) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ xocdiaJackpotRecord }) => {
      this.updateForm(xocdiaJackpotRecord);
    });
  }

  updateForm(xocdiaJackpotRecord: IXocdiaJackpotRecord): void {
    this.editForm.patchValue({
      id: xocdiaJackpotRecord.id,
    });
  }

  previousState(): void {
    window.history.back();
  }

  save(): void {
    this.isSaving = true;
    const xocdiaJackpotRecord = this.createFromForm();
    if (xocdiaJackpotRecord.id !== undefined) {
      this.subscribeToSaveResponse(this.xocdiaJackpotRecordService.update(xocdiaJackpotRecord));
    } else {
      this.subscribeToSaveResponse(this.xocdiaJackpotRecordService.create(xocdiaJackpotRecord));
    }
  }

  private createFromForm(): IXocdiaJackpotRecord {
    return {
      ...new XocdiaJackpotRecord(),
      id: this.editForm.get(['id'])!.value,
    };
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<IXocdiaJackpotRecord>>): void {
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
