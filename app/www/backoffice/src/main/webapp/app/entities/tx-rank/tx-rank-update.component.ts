import { Component, OnInit } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';

import { ITxRank, TxRank } from 'app/shared/model/tx-rank.model';
import { TxRankService } from './tx-rank.service';

@Component({
  selector: 'jhi-tx-rank-update',
  templateUrl: './tx-rank-update.component.html',
})
export class TxRankUpdateComponent implements OnInit {
  isSaving = false;

  editForm = this.fb.group({
    id: [],
    loginname: [],
    amount: [null, [Validators.required, Validators.min(1000000), Validators.max(99999999999999999)]],
    type: 1,
  });

  constructor(protected txRankService: TxRankService, protected activatedRoute: ActivatedRoute, private fb: FormBuilder) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ txRank }) => {
      this.updateForm(txRank);
    });
  }

  updateForm(txRank: ITxRank): void {
    this.editForm.patchValue({
      id: txRank.id,
      loginname: txRank.loginname,
      amount: txRank.amount,
      type: 1,
    });
  }

  previousState(): void {
    window.history.back();
  }

  save(): void {
    this.isSaving = true;
    const txRank = this.createFromForm();
    if (txRank.id !== undefined) {
      this.subscribeToSaveResponse(this.txRankService.update(txRank));
    } else {
      this.subscribeToSaveResponse(this.txRankService.create(txRank));
    }
  }

  private createFromForm(): ITxRank {
    return {
      ...new TxRank(),
      id: this.editForm.get(['id'])!.value,
      loginname: this.editForm.get(['loginname'])!.value,
      amount: this.editForm.get(['amount'])!.value,
      type: 1,
    };
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<ITxRank>>): void {
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
