import { Component } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

import { IReportGame } from 'app/shared/model/report-game.model';
import { ReportGameService } from './report-game.service';

@Component({
  templateUrl: './report-game-delete-dialog.component.html',
})
export class ReportGameDeleteDialogComponent {
  reportGame?: IReportGame;

  constructor(
    protected reportGameService: ReportGameService,
    public activeModal: NgbActiveModal,
    protected eventManager: JhiEventManager
  ) {}

  cancel(): void {
    this.activeModal.dismiss();
  }

  confirmDelete(id: number): void {
    this.reportGameService.delete(id).subscribe(() => {
      this.eventManager.broadcast('reportGameListModification');
      this.activeModal.close();
    });
  }
}
