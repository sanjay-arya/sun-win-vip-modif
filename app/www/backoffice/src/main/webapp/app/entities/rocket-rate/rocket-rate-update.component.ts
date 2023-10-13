import { Component, OnInit } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';

import { IRocketRate, RocketRate } from 'app/shared/model/rocket-rate.model';
import { RocketRateService } from './rocket-rate.service';
/* eslint-disable */
@Component({
  selector: 'jhi-rocket-rate-update',
  templateUrl: './rocket-rate-update.component.html',
})
export class RocketRateUpdateComponent implements OnInit {
  isSaving = false;
  typed = [
    {
      id: 1,
      name: 'Trên',
    },
    {
      id: 2,
      name: 'Dưới',
    },
  ];

  editForm = this.fb.group({
    id: [],
    typed: [null, [Validators.required]],
    pick: [null, [Validators.required, Validators.min(2), Validators.max(12)]],
    rate: [null, [Validators.required]],
  });

  constructor(protected rocketRateService: RocketRateService, protected activatedRoute: ActivatedRoute, private fb: FormBuilder) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ rocketRate }) => {
      this.updateForm(rocketRate);
    });
  }

  updateForm(rocketRate: IRocketRate): void {
    this.editForm.patchValue({
      id: rocketRate.id,
      typed: rocketRate.typed,
      pick: rocketRate.pick,
      rate: rocketRate.rate,
    });
    if (this.editForm.get('id')?.value) {
      this.editForm.get('typed')?.disable();
      this.editForm.get('pick')?.disable();
    } else {
      this.editForm.get('typed')?.enable();
      this.editForm.get('pick')?.enable();
    }
  }

  previousState(): void {
    window.history.back();
  }

  save(): void {
    this.isSaving = true;
    const rocketRate = this.createFromForm();
    if (rocketRate.id !== undefined) {
      this.subscribeToSaveResponse(this.rocketRateService.update(rocketRate));
    } else {
      this.subscribeToSaveResponse(this.rocketRateService.create(rocketRate));
    }
  }

  private createFromForm(): IRocketRate {
    return {
      ...new RocketRate(),
      id: this.editForm.get(['id'])!.value,
      typed: this.editForm.get(['typed'])!.value,
      pick: this.editForm.get(['pick'])!.value,
      rate: this.editForm.get(['rate'])!.value,
    };
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<IRocketRate>>): void {
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
