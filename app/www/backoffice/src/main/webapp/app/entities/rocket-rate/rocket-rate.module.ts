import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { TxcbSharedModule } from 'app/shared/shared.module';
import { RocketRateComponent } from './rocket-rate.component';
import { RocketRateDetailComponent } from './rocket-rate-detail.component';
import { RocketRateUpdateComponent } from './rocket-rate-update.component';
import { RocketRateDeleteDialogComponent } from './rocket-rate-delete-dialog.component';
import { rocketRateRoute } from './rocket-rate.route';

@NgModule({
  imports: [TxcbSharedModule, RouterModule.forChild(rocketRateRoute)],
  declarations: [RocketRateComponent, RocketRateDetailComponent, RocketRateUpdateComponent, RocketRateDeleteDialogComponent],
  entryComponents: [RocketRateDeleteDialogComponent],
})
export class TaixiucbRocketRateModule {}
