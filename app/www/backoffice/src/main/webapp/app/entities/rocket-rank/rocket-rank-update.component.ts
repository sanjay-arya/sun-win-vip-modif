import { Component, OnInit } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';

import { IRocketRank, RocketRank } from 'app/shared/model/rocket-rank.model';
import { RocketRankService } from './rocket-rank.service';

@Component({
  selector: 'jhi-rocket-rank-update',
  templateUrl: './rocket-rank-update.component.html',
})
export class RocketRankUpdateComponent implements OnInit {
  isSaving = false;

  editForm = this.fb.group({
    id: [],
    loginname: [],
    amount: [null, [Validators.required, Validators.min(1000000), Validators.max(99999999999999999)]],
    type: 2,
  });

  constructor(protected rocketRankService: RocketRankService, protected activatedRoute: ActivatedRoute, private fb: FormBuilder) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ rocketRank }) => {
      this.updateForm(rocketRank);
    });
  }

  updateForm(rocketRank: IRocketRank): void {
    this.editForm.patchValue({
      id: rocketRank.id,
      loginname: rocketRank.loginname,
      amount: rocketRank.amount,
      type: 2,
    });
  }

  previousState(): void {
    window.history.back();
  }

  save(): void {
    this.isSaving = true;
    const rocketRank = this.createFromForm();
    if (rocketRank.id !== undefined) {
      this.subscribeToSaveResponse(this.rocketRankService.update(rocketRank));
    } else {
      this.subscribeToSaveResponse(this.rocketRankService.create(rocketRank));
    }
  }

  private createFromForm(): IRocketRank {
    return {
      ...new RocketRank(),
      id: this.editForm.get(['id'])!.value,
      loginname: this.editForm.get(['loginname'])!.value,
      amount: this.editForm.get(['amount'])!.value,
      type: 2,
    };
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<IRocketRank>>): void {
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
