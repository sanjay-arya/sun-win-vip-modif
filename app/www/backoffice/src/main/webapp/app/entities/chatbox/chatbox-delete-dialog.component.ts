import { Component } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

import { IChatbox } from 'app/shared/model/chatbox.model';
import { ChatboxService } from './chatbox.service';

@Component({
  templateUrl: './chatbox-delete-dialog.component.html',
})
export class ChatboxDeleteDialogComponent {
  chatbox?: IChatbox;

  constructor(protected chatboxService: ChatboxService, public activeModal: NgbActiveModal, protected eventManager: JhiEventManager) {}

  cancel(): void {
    this.activeModal.dismiss();
  }

  confirmDelete(id: number): void {
    this.chatboxService.delete(id).subscribe(() => {
      this.eventManager.broadcast('chatboxListModification');
      this.activeModal.close();
    });
  }
}
