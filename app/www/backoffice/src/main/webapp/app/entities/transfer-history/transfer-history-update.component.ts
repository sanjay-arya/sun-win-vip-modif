import { Component, OnInit } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';
import * as moment from 'moment';
import { DATE_TIME_FORMAT } from 'app/shared/constants/input.constants';

import { ITransferHistory, TransferHistory } from 'app/shared/model/transfer-history.model';
import { TransferHistoryService } from './transfer-history.service';

@Component({
  selector: 'jhi-transfer-history-update',
  templateUrl: './transfer-history-update.component.html',
})
export class TransferHistoryUpdateComponent implements OnInit {
  isSaving = false;

  editForm = this.fb.group({
    id: [],
    amount: [],
    created: [],
    action: [],
    current_balance: [],
    username: [],
    orderId: [],
    transId: [],
  });

  constructor(
    protected transferHistoryService: TransferHistoryService,
    protected activatedRoute: ActivatedRoute,
    private fb: FormBuilder
  ) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ transferHistory }) => {
      if (!transferHistory.id) {
        const today = moment().startOf('day');
        transferHistory.created = today;
      }

      this.updateForm(transferHistory);
    });
  }

  updateForm(transferHistory: ITransferHistory): void {
    this.editForm.patchValue({
      id: transferHistory.id,
      amount: transferHistory.amount,
      created: transferHistory.created ? transferHistory.created.format(DATE_TIME_FORMAT) : null,
      action: transferHistory.action,
      current_balance: transferHistory.current_balance,
      username: transferHistory.username,
      orderId: transferHistory.orderId,
      transId: transferHistory.transId,
    });
  }

  previousState(): void {
    window.history.back();
  }

  save(): void {
    this.isSaving = true;
    const transferHistory = this.createFromForm();
    if (transferHistory.id !== undefined) {
      this.subscribeToSaveResponse(this.transferHistoryService.update(transferHistory));
    } else {
      this.subscribeToSaveResponse(this.transferHistoryService.create(transferHistory));
    }
  }

  private createFromForm(): ITransferHistory {
    return {
      ...new TransferHistory(),
      id: this.editForm.get(['id'])!.value,
      amount: this.editForm.get(['amount'])!.value,
      created: this.editForm.get(['created'])!.value ? moment(this.editForm.get(['created'])!.value, DATE_TIME_FORMAT) : undefined,
      action: this.editForm.get(['action'])!.value,
      current_balance: this.editForm.get(['current_balance'])!.value,
      username: this.editForm.get(['username'])!.value,
      orderId: this.editForm.get(['orderId'])!.value,
      transId: this.editForm.get(['transId'])!.value,
    };
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<ITransferHistory>>): void {
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
