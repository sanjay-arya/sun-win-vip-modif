import { Component } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

import { IRocketRate } from 'app/shared/model/rocket-rate.model';
import { RocketRateService } from './rocket-rate.service';

@Component({
  templateUrl: './rocket-rate-delete-dialog.component.html',
})
export class RocketRateDeleteDialogComponent {
  rocketRate?: IRocketRate;

  constructor(
    protected rocketRateService: RocketRateService,
    public activeModal: NgbActiveModal,
    protected eventManager: JhiEventManager
  ) {}

  cancel(): void {
    this.activeModal.dismiss();
  }

  confirmDelete(id: number): void {
    this.rocketRateService.delete(id).subscribe(() => {
      this.eventManager.broadcast('rocketRateListModification');
      this.activeModal.close();
    });
  }
}
