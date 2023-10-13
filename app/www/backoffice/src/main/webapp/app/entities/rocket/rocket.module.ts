import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { TxcbSharedModule } from 'app/shared/shared.module';
import { RocketComponent } from './rocket.component';
import { RocketDetailComponent } from './rocket-detail.component';
import { RocketUpdateComponent } from './rocket-update.component';
import { RocketDeleteDialogComponent } from './rocket-delete-dialog.component';
import { rocketRoute } from './rocket.route';

@NgModule({
  imports: [TxcbSharedModule, RouterModule.forChild(rocketRoute)],
  declarations: [RocketComponent, RocketDetailComponent, RocketUpdateComponent, RocketDeleteDialogComponent],
  entryComponents: [RocketDeleteDialogComponent],
})
export class TaixiucbRocketModule {}
