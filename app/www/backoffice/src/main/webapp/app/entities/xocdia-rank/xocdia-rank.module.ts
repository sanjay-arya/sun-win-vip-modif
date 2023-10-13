import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { TxcbSharedModule } from 'app/shared/shared.module';
import { XocdiaRankComponent } from './xocdia-rank.component';
import { XocdiaRankDetailComponent } from './xocdia-rank-detail.component';
import { XocdiaRankUpdateComponent } from './xocdia-rank-update.component';
import { XocdiaRankDeleteDialogComponent } from './xocdia-rank-delete-dialog.component';
import { xocdiaRankRoute } from './xocdia-rank.route';

@NgModule({
  imports: [TxcbSharedModule, RouterModule.forChild(xocdiaRankRoute)],
  declarations: [XocdiaRankComponent, XocdiaRankDetailComponent, XocdiaRankUpdateComponent, XocdiaRankDeleteDialogComponent],
  entryComponents: [XocdiaRankDeleteDialogComponent],
})
export class TaixiucbXocdiaRankModule {}
