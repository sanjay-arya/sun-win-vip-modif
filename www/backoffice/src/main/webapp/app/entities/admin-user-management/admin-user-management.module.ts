import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { TxcbSharedModule } from 'app/shared/shared.module';
import { AdminUserManagementComponent } from './admin-user-management.component';
import { AdminUserManagementDetailComponent } from './admin-user-management-detail.component';
import { AdminUserManagementUpdateComponent } from './admin-user-management-update.component';
import { AdminUserManagementDeleteDialogComponent } from './admin-user-management-delete-dialog.component';
import { adminUserManagementRoute } from './admin-user-management.route';

@NgModule({
  imports: [TxcbSharedModule, RouterModule.forChild(adminUserManagementRoute)],
  declarations: [
    AdminUserManagementComponent,
    AdminUserManagementDetailComponent,
    AdminUserManagementUpdateComponent,
    AdminUserManagementDeleteDialogComponent,
  ],
  entryComponents: [AdminUserManagementDeleteDialogComponent],
})
export class AdminUserManagementModule {}
