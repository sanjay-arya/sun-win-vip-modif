import { Component } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

import { IRocketChatbox } from 'app/shared/model/rocket-chatbox.model';
import { RocketChatboxService } from './rocket-chatbox.service';

@Component({
  templateUrl: './rocket-chatbox-delete-dialog.component.html',
})
export class RocketChatboxDeleteDialogComponent {
  rocketChatbox?: IRocketChatbox;

  constructor(
    protected rocketChatboxService: RocketChatboxService,
    public activeModal: NgbActiveModal,
    protected eventManager: JhiEventManager
  ) {}

  cancel(): void {
    this.activeModal.dismiss();
  }

  confirmDelete(id: number): void {
    this.rocketChatboxService.delete(id).subscribe(() => {
      this.eventManager.broadcast('rocketChatboxListModification');
      this.activeModal.close();
    });
  }
}
