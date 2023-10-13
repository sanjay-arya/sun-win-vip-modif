import { Component } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

import { IXocdia } from 'app/shared/model/xocdia.model';
import { XocdiaService } from './xocdia.service';

@Component({
  templateUrl: './xocdia-delete-dialog.component.html',
})
export class XocdiaDeleteDialogComponent {
  xocdia?: IXocdia;

  constructor(protected xocdiaService: XocdiaService, public activeModal: NgbActiveModal, protected eventManager: JhiEventManager) {}

  cancel(): void {
    this.activeModal.dismiss();
  }

  confirmDelete(id: number): void {
    this.xocdiaService.delete(id).subscribe(() => {
      this.eventManager.broadcast('xocdiaListModification');
      this.activeModal.close();
    });
  }
}
