import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { TxcbSharedModule } from 'app/shared/shared.module';
import { RocketRankComponent } from './rocket-rank.component';
import { RocketRankDetailComponent } from './rocket-rank-detail.component';
import { RocketRankUpdateComponent } from './rocket-rank-update.component';
import { RocketRankDeleteDialogComponent } from './rocket-rank-delete-dialog.component';
import { rocketRankRoute } from './rocket-rank.route';

@NgModule({
  imports: [TxcbSharedModule, RouterModule.forChild(rocketRankRoute)],
  declarations: [RocketRankComponent, RocketRankDetailComponent, RocketRankUpdateComponent, RocketRankDeleteDialogComponent],
  entryComponents: [RocketRankDeleteDialogComponent],
})
export class TaixiucbRocketRankModule {}
