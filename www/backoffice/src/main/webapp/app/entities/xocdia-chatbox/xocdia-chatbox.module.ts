import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { TxcbSharedModule } from 'app/shared/shared.module';
import { XocdiaChatboxComponent } from './xocdia-chatbox.component';
import { XocdiaChatboxDetailComponent } from './xocdia-chatbox-detail.component';
import { XocdiaChatboxUpdateComponent } from './xocdia-chatbox-update.component';
import { XocdiaChatboxDeleteDialogComponent } from './xocdia-chatbox-delete-dialog.component';
import { xocdiaChatboxRoute } from './xocdia-chatbox.route';

@NgModule({
  imports: [TxcbSharedModule, RouterModule.forChild(xocdiaChatboxRoute)],
  declarations: [XocdiaChatboxComponent, XocdiaChatboxDetailComponent, XocdiaChatboxUpdateComponent, XocdiaChatboxDeleteDialogComponent],
  entryComponents: [XocdiaChatboxDeleteDialogComponent],
})
export class TaixiucbXocdiaChatboxModule {}
