import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { TxcbSharedModule } from 'app/shared/shared.module';
import { TaixiuRecordComponent } from './taixiu-record.component';
import { TaixiuRecordDetailComponent } from './taixiu-record-detail.component';
import { TaixiuRecordUpdateComponent } from './taixiu-record-update.component';
import { TaixiuRecordDeleteDialogComponent } from './taixiu-record-delete-dialog.component';
import { taixiuRecordRoute } from './taixiu-record.route';

@NgModule({
  imports: [TxcbSharedModule, RouterModule.forChild(taixiuRecordRoute)],
  declarations: [TaixiuRecordComponent, TaixiuRecordDetailComponent, TaixiuRecordUpdateComponent, TaixiuRecordDeleteDialogComponent],
  entryComponents: [TaixiuRecordDeleteDialogComponent],
})
export class TxcbTaixiuRecordModule {}
