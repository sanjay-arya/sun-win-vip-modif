import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { TxcbSharedModule } from 'app/shared/shared.module';
import { XocdiaComponent } from './xocdia.component';
import { XocdiaDetailComponent } from './xocdia-detail.component';
import { XocdiaUpdateComponent } from './xocdia-update.component';
import { XocdiaDeleteDialogComponent } from './xocdia-delete-dialog.component';
import { xocdiaRoute } from './xocdia.route';

@NgModule({
  imports: [TxcbSharedModule, RouterModule.forChild(xocdiaRoute)],
  declarations: [XocdiaComponent, XocdiaDetailComponent, XocdiaUpdateComponent, XocdiaDeleteDialogComponent],
  entryComponents: [XocdiaDeleteDialogComponent],
})
export class TaixiucbXocdiaModule {}
