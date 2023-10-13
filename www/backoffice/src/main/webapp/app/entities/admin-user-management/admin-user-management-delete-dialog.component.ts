import { UserService } from './../../core/user/user.service';
import { User } from './../../core/user/user.model';
import { Component } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

@Component({
  selector: 'jhi-user-mgmt-delete-dialog',
  templateUrl: './admin-user-management-delete-dialog.component.html',
})
export class AdminUserManagementDeleteDialogComponent {
  user?: User;

  constructor(private userService: UserService, public activeModal: NgbActiveModal, private eventManager: JhiEventManager) {}

  cancel(): void {
    this.activeModal.dismiss();
  }

  confirmDelete(login: string): void {
    this.userService.delete(login).subscribe(() => {
      this.eventManager.broadcast('adminUserListModification');
      this.activeModal.close();
    });
  }
}
