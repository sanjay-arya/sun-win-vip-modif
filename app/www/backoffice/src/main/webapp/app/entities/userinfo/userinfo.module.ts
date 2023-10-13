import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { TxcbSharedModule } from 'app/shared/shared.module';
import { UserinfoComponent } from './userinfo.component';
import { UserinfoDetailComponent } from './userinfo-detail.component';
import { userinfoRoute } from './userinfo.route';

@NgModule({
  imports: [TxcbSharedModule, RouterModule.forChild(userinfoRoute)],
  declarations: [UserinfoComponent, UserinfoDetailComponent],
})
export class TxcbUserinfoModule {}
