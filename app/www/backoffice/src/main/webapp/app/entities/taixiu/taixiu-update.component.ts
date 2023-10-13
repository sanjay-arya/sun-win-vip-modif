import { Component, OnInit } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';
import * as moment from 'moment';
import { DATE_TIME_FORMAT } from 'app/shared/constants/input.constants';

import { ITaixiu, Taixiu } from 'app/shared/model/taixiu.model';
import { TaixiuService } from './taixiu.service';

@Component({
  selector: 'jhi-taixiu-update',
  templateUrl: './taixiu-update.component.html',
})
export class TaixiuUpdateComponent implements OnInit {
  isSaving = false;

  editForm = this.fb.group({
    id: [],
    opentime: [],
    endtime: [],
    status: [],
    result: [],
  });

  constructor(protected taixiuService: TaixiuService, protected activatedRoute: ActivatedRoute, private fb: FormBuilder) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ taixiu }) => {
      if (!taixiu.id) {
        const today = moment().startOf('day');
        taixiu.opentime = today;
        taixiu.endtime = today;
      }

      this.updateForm(taixiu);
    });
  }

  updateForm(taixiu: ITaixiu): void {
    this.editForm.patchValue({
      id: taixiu.id,
      opentime: taixiu.opentime ? taixiu.opentime.format(DATE_TIME_FORMAT) : null,
      endtime: taixiu.endtime ? taixiu.endtime.format(DATE_TIME_FORMAT) : null,
      status: taixiu.status,
      result: taixiu.result,
    });
  }

  previousState(): void {
    window.history.back();
  }

  save(): void {
    this.isSaving = true;
    const taixiu = this.createFromForm();
    if (taixiu.id !== undefined) {
      this.subscribeToSaveResponse(this.taixiuService.update(taixiu));
    } else {
      this.subscribeToSaveResponse(this.taixiuService.create(taixiu));
    }
  }

  private createFromForm(): ITaixiu {
    return {
      ...new Taixiu(),
      id: this.editForm.get(['id'])!.value,
      opentime: this.editForm.get(['opentime'])!.value ? moment(this.editForm.get(['opentime'])!.value, DATE_TIME_FORMAT) : undefined,
      endtime: this.editForm.get(['endtime'])!.value ? moment(this.editForm.get(['endtime'])!.value, DATE_TIME_FORMAT) : undefined,
      status: this.editForm.get(['status'])!.value,
      result: this.editForm.get(['result'])!.value,
    };
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<ITaixiu>>): void {
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
