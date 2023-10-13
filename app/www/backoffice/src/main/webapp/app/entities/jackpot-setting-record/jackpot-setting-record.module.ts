import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { TxcbSharedModule } from 'app/shared/shared.module';
import { JackpotSettingRecordComponent } from './jackpot-setting-record.component';
import { JackpotSettingRecordDetailComponent } from './jackpot-setting-record-detail.component';
import { JackpotSettingRecordUpdateComponent } from './jackpot-setting-record-update.component';
import { JackpotSettingRecordDeleteDialogComponent } from './jackpot-setting-record-delete-dialog.component';
import { jackpotSettingRecordRoute } from './jackpot-setting-record.route';

@NgModule({
  imports: [TxcbSharedModule, RouterModule.forChild(jackpotSettingRecordRoute)],
  declarations: [
    JackpotSettingRecordComponent,
    JackpotSettingRecordDetailComponent,
    JackpotSettingRecordUpdateComponent,
    JackpotSettingRecordDeleteDialogComponent,
  ],
  entryComponents: [JackpotSettingRecordDeleteDialogComponent],
})
export class TaixiucbJackpotSettingRecordModule {}
