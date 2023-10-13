import { Component, OnInit } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';

import { IXocdiaChatbox, XocdiaChatbox } from 'app/shared/model/xocdia-chatbox.model';
import { XocdiaChatboxService } from './xocdia-chatbox.service';

@Component({
  selector: 'jhi-xocdia-chatbox-update',
  templateUrl: './xocdia-chatbox-update.component.html',
})
export class XocdiaChatboxUpdateComponent implements OnInit {
  isSaving = false;

  editForm = this.fb.group({
    id: [],
    loginname: [],
    message: [],
    types: [],
    created: [],
  });

  constructor(protected xocdiaChatboxService: XocdiaChatboxService, protected activatedRoute: ActivatedRoute, private fb: FormBuilder) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ xocdiaChatbox }) => {
      this.updateForm(xocdiaChatbox);
    });
  }

  updateForm(xocdiaChatbox: IXocdiaChatbox): void {
    this.editForm.patchValue({
      id: xocdiaChatbox.id,
      loginname: xocdiaChatbox.loginname,
      message: xocdiaChatbox.message,
      types: xocdiaChatbox.types,
      created: xocdiaChatbox.created,
    });
  }

  previousState(): void {
    window.history.back();
  }

  save(): void {
    this.isSaving = true;
    const xocdiaChatbox = this.createFromForm();
    if (xocdiaChatbox.id !== undefined) {
      this.subscribeToSaveResponse(this.xocdiaChatboxService.update(xocdiaChatbox));
    } else {
      this.subscribeToSaveResponse(this.xocdiaChatboxService.create(xocdiaChatbox));
    }
  }

  private createFromForm(): IXocdiaChatbox {
    return {
      ...new XocdiaChatbox(),
      id: this.editForm.get(['id'])!.value,
      loginname: this.editForm.get(['loginname'])!.value,
      message: this.editForm.get(['message'])!.value,
      types: 3, // types = 1 for txcb, types = 2 for Tren Duoi, types = 3 for Xoc Dia
      created: this.editForm.get(['created'])!.value,
    };
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<IXocdiaChatbox>>): void {
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
