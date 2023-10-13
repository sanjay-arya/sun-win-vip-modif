import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { TxcbSharedModule } from 'app/shared/shared.module';
import { ChatboxComponent } from './chatbox.component';
import { ChatboxDetailComponent } from './chatbox-detail.component';
import { ChatboxUpdateComponent } from './chatbox-update.component';
import { ChatboxDeleteDialogComponent } from './chatbox-delete-dialog.component';
import { chatboxRoute } from './chatbox.route';

@NgModule({
  imports: [TxcbSharedModule, RouterModule.forChild(chatboxRoute)],
  declarations: [ChatboxComponent, ChatboxDetailComponent, ChatboxUpdateComponent, ChatboxDeleteDialogComponent],
  entryComponents: [ChatboxDeleteDialogComponent],
})
export class TxcbChatboxModule {}
