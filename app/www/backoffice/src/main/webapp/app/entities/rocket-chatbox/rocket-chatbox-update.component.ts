import { Component, OnInit } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';

import { IRocketChatbox, RocketChatbox } from 'app/shared/model/rocket-chatbox.model';
import { RocketChatboxService } from './rocket-chatbox.service';

@Component({
  selector: 'jhi-rocket-chatbox-update',
  templateUrl: './rocket-chatbox-update.component.html',
})
export class RocketChatboxUpdateComponent implements OnInit {
  isSaving = false;

  editForm = this.fb.group({
    id: [],
    loginname: [],
    message: [],
    types: [],
    created: [],
  });

  constructor(protected rocketChatboxService: RocketChatboxService, protected activatedRoute: ActivatedRoute, private fb: FormBuilder) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ rocketChatbox }) => {
      this.updateForm(rocketChatbox);
    });
  }

  updateForm(rocketChatbox: IRocketChatbox): void {
    this.editForm.patchValue({
      id: rocketChatbox.id,
      loginname: rocketChatbox.loginname,
      message: rocketChatbox.message,
      types: rocketChatbox.types,
      created: rocketChatbox.created,
    });
  }

  previousState(): void {
    window.history.back();
  }

  save(): void {
    this.isSaving = true;
    const rocketChatbox = this.createFromForm();
    if (rocketChatbox.id !== undefined) {
      this.subscribeToSaveResponse(this.rocketChatboxService.update(rocketChatbox));
    } else {
      this.subscribeToSaveResponse(this.rocketChatboxService.create(rocketChatbox));
    }
  }

  private createFromForm(): IRocketChatbox {
    return {
      ...new RocketChatbox(),
      id: this.editForm.get(['id'])!.value,
      loginname: this.editForm.get(['loginname'])!.value,
      message: this.editForm.get(['message'])!.value,
      types: 2, // types = 1 for txcb, types = 2 for Tren Duoi, types = 3 for Xoc Dia
      created: this.editForm.get(['created'])!.value,
    };
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<IRocketChatbox>>): void {
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
