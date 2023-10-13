import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { TxcbSharedModule } from 'app/shared/shared.module';
import { RocketChatboxComponent } from './rocket-chatbox.component';
import { RocketChatboxDetailComponent } from './rocket-chatbox-detail.component';
import { RocketChatboxUpdateComponent } from './rocket-chatbox-update.component';
import { RocketChatboxDeleteDialogComponent } from './rocket-chatbox-delete-dialog.component';
import { rocketChatboxRoute } from './rocket-chatbox.route';

@NgModule({
  imports: [TxcbSharedModule, RouterModule.forChild(rocketChatboxRoute)],
  declarations: [RocketChatboxComponent, RocketChatboxDetailComponent, RocketChatboxUpdateComponent, RocketChatboxDeleteDialogComponent],
  entryComponents: [RocketChatboxDeleteDialogComponent],
})
export class TaixiucbRocketChatboxModule {}
