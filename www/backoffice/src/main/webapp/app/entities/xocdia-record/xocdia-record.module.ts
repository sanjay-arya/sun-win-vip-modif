import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { TxcbSharedModule } from 'app/shared/shared.module';
import { XocdiaRecordComponent } from './xocdia-record.component';
import { XocdiaRecordDetailComponent } from './xocdia-record-detail.component';
import { XocdiaRecordUpdateComponent } from './xocdia-record-update.component';
import { XocdiaRecordDeleteDialogComponent } from './xocdia-record-delete-dialog.component';
import { xocdiaRecordRoute } from './xocdia-record.route';

@NgModule({
  imports: [TxcbSharedModule, RouterModule.forChild(xocdiaRecordRoute)],
  declarations: [XocdiaRecordComponent, XocdiaRecordDetailComponent, XocdiaRecordUpdateComponent, XocdiaRecordDeleteDialogComponent],
  entryComponents: [XocdiaRecordDeleteDialogComponent],
})
export class TaixiucbXocdiaRecordModule {}
