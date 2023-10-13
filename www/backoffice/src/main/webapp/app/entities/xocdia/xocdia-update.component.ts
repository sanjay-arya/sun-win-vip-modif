import { DATE_TIME_FORMAT } from './../../shared/constants/input.constants';
import { Component, OnInit } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';

import { IXocdia, Xocdia } from 'app/shared/model/xocdia.model';
import { XocdiaService } from './xocdia.service';
import * as moment from 'moment';

@Component({
  selector: 'jhi-xocdia-update',
  templateUrl: './xocdia-update.component.html',
})
export class XocdiaUpdateComponent implements OnInit {
  isSaving = false;

  editForm = this.fb.group({
    id: [],
    opentime: [],
    endtime: [],
    status: [],
    result: [],
  });

  constructor(protected xocdiaService: XocdiaService, protected activatedRoute: ActivatedRoute, private fb: FormBuilder) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ xocdia }) => {
      if (!xocdia.id) {
        const today = moment().startOf('day');
        xocdia.opentime = today;
        xocdia.endtime = today;
      }

      this.updateForm(xocdia);
    });
  }

  updateForm(xocdia: IXocdia): void {
    this.editForm.patchValue({
      id: xocdia.id,
      opentime: xocdia.opentime ? xocdia.opentime.format(DATE_TIME_FORMAT) : null,
      endtime: xocdia.endtime ? xocdia.endtime.format(DATE_TIME_FORMAT) : null,
      status: xocdia.status,
      result: xocdia.result,
    });
  }

  previousState(): void {
    window.history.back();
  }

  save(): void {
    this.isSaving = true;
    const xocdia = this.createFromForm();
    if (xocdia.id !== undefined) {
      this.subscribeToSaveResponse(this.xocdiaService.update(xocdia));
    } else {
      this.subscribeToSaveResponse(this.xocdiaService.create(xocdia));
    }
  }

  private createFromForm(): IXocdia {
    return {
      ...new Xocdia(),
      id: this.editForm.get(['id'])!.value,
      opentime: this.editForm.get(['opentime'])!.value ? moment(this.editForm.get(['opentime'])!.value, DATE_TIME_FORMAT) : undefined,
      endtime: this.editForm.get(['endtime'])!.value ? moment(this.editForm.get(['endtime'])!.value, DATE_TIME_FORMAT) : undefined,
      status: this.editForm.get(['status'])!.value,
      result: this.editForm.get(['result'])!.value,
    };
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<IXocdia>>): void {
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
