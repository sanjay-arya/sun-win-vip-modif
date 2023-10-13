import { Component } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

import { IXocdiaChatbox } from 'app/shared/model/xocdia-chatbox.model';
import { XocdiaChatboxService } from './xocdia-chatbox.service';

@Component({
  templateUrl: './xocdia-chatbox-delete-dialog.component.html',
})
export class XocdiaChatboxDeleteDialogComponent {
  xocdiaChatbox?: IXocdiaChatbox;

  constructor(
    protected xocdiaChatboxService: XocdiaChatboxService,
    public activeModal: NgbActiveModal,
    protected eventManager: JhiEventManager
  ) {}

  cancel(): void {
    this.activeModal.dismiss();
  }

  confirmDelete(id: number): void {
    this.xocdiaChatboxService.delete(id).subscribe(() => {
      this.eventManager.broadcast('xocdiaChatboxListModification');
      this.activeModal.close();
    });
  }
}
