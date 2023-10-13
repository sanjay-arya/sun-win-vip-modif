import { Component } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

import { ITaixiu } from 'app/shared/model/taixiu.model';
import { TaixiuService } from './taixiu.service';

@Component({
  templateUrl: './taixiu-delete-dialog.component.html',
})
export class TaixiuDeleteDialogComponent {
  taixiu?: ITaixiu;

  constructor(protected taixiuService: TaixiuService, public activeModal: NgbActiveModal, protected eventManager: JhiEventManager) {}

  cancel(): void {
    this.activeModal.dismiss();
  }

  confirmDelete(id: number): void {
    this.taixiuService.delete(id).subscribe(() => {
      this.eventManager.broadcast('taixiuListModification');
      this.activeModal.close();
    });
  }
}
