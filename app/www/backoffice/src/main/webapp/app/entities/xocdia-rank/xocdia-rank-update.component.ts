import { Component, OnInit } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';

import { IXocdiaRank, XocdiaRank } from 'app/shared/model/xocdia-rank.model';
import { XocdiaRankService } from './xocdia-rank.service';

@Component({
  selector: 'jhi-xocdia-rank-update',
  templateUrl: './xocdia-rank-update.component.html',
})
export class XocdiaRankUpdateComponent implements OnInit {
  isSaving = false;

  editForm = this.fb.group({
    id: [],
    loginname: [],
    amount: [null, [Validators.required, Validators.min(1000000), Validators.max(99999999999999999)]],
    type: 1,
  });

  constructor(protected xocdiaRankService: XocdiaRankService, protected activatedRoute: ActivatedRoute, private fb: FormBuilder) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ xocdiaRank }) => {
      this.updateForm(xocdiaRank);
    });
  }

  updateForm(xocdiaRank: IXocdiaRank): void {
    this.editForm.patchValue({
      id: xocdiaRank.id,
      loginname: xocdiaRank.loginname,
      amount: xocdiaRank.amount,
      type: 1,
    });
  }

  previousState(): void {
    window.history.back();
  }

  save(): void {
    this.isSaving = true;
    const xocdiaRank = this.createFromForm();
    if (xocdiaRank.id !== undefined) {
      this.subscribeToSaveResponse(this.xocdiaRankService.update(xocdiaRank));
    } else {
      this.subscribeToSaveResponse(this.xocdiaRankService.create(xocdiaRank));
    }
  }

  private createFromForm(): IXocdiaRank {
    return {
      ...new XocdiaRank(),
      id: this.editForm.get(['id'])!.value,
      loginname: this.editForm.get(['loginname'])!.value,
      amount: this.editForm.get(['amount'])!.value,
      type: 3,
    };
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<IXocdiaRank>>): void {
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
