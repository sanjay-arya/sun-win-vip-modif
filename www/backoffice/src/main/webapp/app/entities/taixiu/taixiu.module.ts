import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { TxcbSharedModule } from 'app/shared/shared.module';
import { TaixiuComponent } from './taixiu.component';
import { TaixiuDetailComponent } from './taixiu-detail.component';
import { TaixiuUpdateComponent } from './taixiu-update.component';
import { TaixiuDeleteDialogComponent } from './taixiu-delete-dialog.component';
import { taixiuRoute } from './taixiu.route';

@NgModule({
  imports: [TxcbSharedModule, RouterModule.forChild(taixiuRoute)],
  declarations: [TaixiuComponent, TaixiuDetailComponent, TaixiuUpdateComponent, TaixiuDeleteDialogComponent],
  entryComponents: [TaixiuDeleteDialogComponent],
})
export class TxcbTaixiuModule {}
