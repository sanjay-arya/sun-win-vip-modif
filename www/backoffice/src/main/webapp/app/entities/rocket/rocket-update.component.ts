import { Component, OnInit } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';
import * as moment from 'moment';
import { DATE_TIME_FORMAT } from 'app/shared/constants/input.constants';

import { IRocket, Rocket } from 'app/shared/model/rocket.model';
import { RocketService } from './rocket.service';

@Component({
  selector: 'jhi-rocket-update',
  templateUrl: './rocket-update.component.html',
})
export class RocketUpdateComponent implements OnInit {
  isSaving = false;

  editForm = this.fb.group({
    id: [],
    opentime: [],
    endtime: [],
    status: [],
    result: [],
  });

  constructor(protected rocketService: RocketService, protected activatedRoute: ActivatedRoute, private fb: FormBuilder) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ rocket }) => {
      if (!rocket.id) {
        const today = moment().startOf('day');
        rocket.opentime = today;
        rocket.endtime = today;
      }

      this.updateForm(rocket);
    });
  }

  updateForm(rocket: IRocket): void {
    this.editForm.patchValue({
      id: rocket.id,
      opentime: rocket.opentime ? rocket.opentime.format(DATE_TIME_FORMAT) : null,
      endtime: rocket.endtime ? rocket.endtime.format(DATE_TIME_FORMAT) : null,
      status: rocket.status,
      result: rocket.result,
    });
  }

  previousState(): void {
    window.history.back();
  }

  save(): void {
    this.isSaving = true;
    const rocket = this.createFromForm();
    if (rocket.id !== undefined) {
      this.subscribeToSaveResponse(this.rocketService.update(rocket));
    } else {
      this.subscribeToSaveResponse(this.rocketService.create(rocket));
    }
  }

  private createFromForm(): IRocket {
    return {
      ...new Rocket(),
      id: this.editForm.get(['id'])!.value,
      opentime: this.editForm.get(['opentime'])!.value ? moment(this.editForm.get(['opentime'])!.value, DATE_TIME_FORMAT) : undefined,
      endtime: this.editForm.get(['endtime'])!.value ? moment(this.editForm.get(['endtime'])!.value, DATE_TIME_FORMAT) : undefined,
      status: this.editForm.get(['status'])!.value,
      result: this.editForm.get(['result'])!.value,
    };
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<IRocket>>): void {
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
