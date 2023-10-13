import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import { TxcbSharedModule } from 'app/shared/shared.module';

import { SystemConfigComponent } from './system-config.component';

import { systemConfigRoute } from './system-config.route';


@NgModule({
  imports: [TxcbSharedModule, RouterModule.forChild(systemConfigRoute)],
  declarations: [SystemConfigComponent],
})
export class SystemConfigModule {}
