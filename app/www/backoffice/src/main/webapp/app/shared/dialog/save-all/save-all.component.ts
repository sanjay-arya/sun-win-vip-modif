import { IRocketRate } from './../../model/rocket-rate.model';
import { Component } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

// import { IRocketRate } from 'app/shared/model/rocket-rate.model';

@Component({
  templateUrl: './save-all.component.html',
})
export class SaveAllDialogComponent {
  rocketRate?: IRocketRate;

  constructor(public activeModal: NgbActiveModal, protected eventManager: JhiEventManager) {}

  cancel(): void {
    this.activeModal.dismiss();
  }

  confirmSave(): void {
    this.activeModal.close(true);
  }
}
