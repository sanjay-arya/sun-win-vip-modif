import { Component, OnInit } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';

import { IChatbox, Chatbox } from 'app/shared/model/chatbox.model';
import { ChatboxService } from './chatbox.service';

@Component({
  selector: 'jhi-chatbox-update',
  templateUrl: './chatbox-update.component.html',
})
export class ChatboxUpdateComponent implements OnInit {
  isSaving = false;

  editForm = this.fb.group({
    id: [],
    loginname: [],
    message: [],
    types: [],
    created: [],
  });

  constructor(protected chatboxService: ChatboxService, protected activatedRoute: ActivatedRoute, private fb: FormBuilder) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ chatbox }) => {
      this.updateForm(chatbox);
    });
  }

  updateForm(chatbox: IChatbox): void {
    this.editForm.patchValue({
      id: chatbox.id,
      loginname: chatbox.loginname,
      message: chatbox.message,
      types: chatbox.types,
      created: chatbox.created,
    });
  }

  previousState(): void {
    window.history.back();
  }

  save(): void {
    this.isSaving = true;
    const chatbox = this.createFromForm();
    if (chatbox.id !== undefined) {
      this.subscribeToSaveResponse(this.chatboxService.update(chatbox));
    } else {
      this.subscribeToSaveResponse(this.chatboxService.create(chatbox));
    }
  }

  private createFromForm(): IChatbox {
    return {
      ...new Chatbox(),
      id: this.editForm.get(['id'])!.value,
      loginname: this.editForm.get(['loginname'])!.value,
      message: this.editForm.get(['message'])!.value,
      types: 1, // types = 1 for txcb, types = 2 for Tren Duoi, types = 3 for Xoc Dia
      created: this.editForm.get(['created'])!.value,
    };
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<IChatbox>>): void {
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
