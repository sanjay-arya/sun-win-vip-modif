import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { TxcbSharedModule } from 'app/shared/shared.module';
import { XocdiaJackpotRecordComponent } from './xocdia-jackpot-record.component';
import { XocdiaJackpotRecordDetailComponent } from './xocdia-jackpot-record-detail.component';
import { XocdiaJackpotRecordUpdateComponent } from './xocdia-jackpot-record-update.component';
import { XocdiaJackpotRecordDeleteDialogComponent } from './xocdia-jackpot-record-delete-dialog.component';
import { xocdiaJackpotRecordRoute } from './xocdia-jackpot-record.route';

@NgModule({
  imports: [TxcbSharedModule, RouterModule.forChild(xocdiaJackpotRecordRoute)],
  declarations: [
    XocdiaJackpotRecordComponent,
    XocdiaJackpotRecordDetailComponent,
    XocdiaJackpotRecordUpdateComponent,
    XocdiaJackpotRecordDeleteDialogComponent,
  ],
  entryComponents: [XocdiaJackpotRecordDeleteDialogComponent],
})
export class TaixiucbXocdiaJackpotRecordModule {}
