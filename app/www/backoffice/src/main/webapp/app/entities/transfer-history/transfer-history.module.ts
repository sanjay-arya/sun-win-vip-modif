import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { TxcbSharedModule } from 'app/shared/shared.module';
import { TransferHistoryComponent } from './transfer-history.component';
import { TransferHistoryDetailComponent } from './transfer-history-detail.component';
import { TransferHistoryUpdateComponent } from './transfer-history-update.component';
import { TransferHistoryDeleteDialogComponent } from './transfer-history-delete-dialog.component';
import { transferHistoryRoute } from './transfer-history.route';

@NgModule({
  imports: [TxcbSharedModule, RouterModule.forChild(transferHistoryRoute)],
  declarations: [
    TransferHistoryComponent,
    TransferHistoryDetailComponent,
    TransferHistoryUpdateComponent,
    TransferHistoryDeleteDialogComponent,
  ],
  entryComponents: [TransferHistoryDeleteDialogComponent],
})
export class TaixiucbTransferHistoryModule {}
