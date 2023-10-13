import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { TxcbSharedModule } from 'app/shared/shared.module';
import { TxRankComponent } from './tx-rank.component';
import { TxRankDetailComponent } from './tx-rank-detail.component';
import { TxRankUpdateComponent } from './tx-rank-update.component';
import { TxRankDeleteDialogComponent } from './tx-rank-delete-dialog.component';
import { txRankRoute } from './tx-rank.route';

@NgModule({
  imports: [TxcbSharedModule, RouterModule.forChild(txRankRoute)],
  declarations: [TxRankComponent, TxRankDetailComponent, TxRankUpdateComponent, TxRankDeleteDialogComponent],
  entryComponents: [TxRankDeleteDialogComponent],
})
export class TaixiucbTxRankModule {}
