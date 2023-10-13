import { Component } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

import { IRocket } from 'app/shared/model/rocket.model';
import { RocketService } from './rocket.service';

@Component({
  templateUrl: './rocket-delete-dialog.component.html',
})
export class RocketDeleteDialogComponent {
  rocket?: IRocket;

  constructor(protected rocketService: RocketService, public activeModal: NgbActiveModal, protected eventManager: JhiEventManager) {}

  cancel(): void {
    this.activeModal.dismiss();
  }

  confirmDelete(id: number): void {
    this.rocketService.delete(id).subscribe(() => {
      this.eventManager.broadcast('rocketListModification');
      this.activeModal.close();
    });
  }
}
