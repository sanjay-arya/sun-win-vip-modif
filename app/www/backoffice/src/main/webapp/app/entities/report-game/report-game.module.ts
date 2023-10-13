import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { TxcbSharedModule } from 'app/shared/shared.module';
import { ReportGameComponent } from './report-game.component';
import { ReportGameDetailComponent } from './report-game-detail.component';
import { ReportGameUpdateComponent } from './report-game-update.component';
import { ReportGameDeleteDialogComponent } from './report-game-delete-dialog.component';
import { reportGameRoute } from './report-game.route';

@NgModule({
  imports: [TxcbSharedModule, RouterModule.forChild(reportGameRoute)],
  declarations: [ReportGameComponent, ReportGameDetailComponent, ReportGameUpdateComponent, ReportGameDeleteDialogComponent],
  entryComponents: [ReportGameDeleteDialogComponent],
})
export class TaixiucbReportGameModule {}
