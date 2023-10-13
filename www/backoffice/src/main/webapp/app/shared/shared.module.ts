import { NgModule } from '@angular/core';
import { TxcbSharedLibsModule } from './shared-libs.module';
import { FindLanguageFromKeyPipe } from './language/find-language-from-key.pipe';
import { AlertComponent } from './alert/alert.component';
import { AlertErrorComponent } from './alert/alert-error.component';
import { LoginModalComponent } from './login/login.component';
import { HasAnyAuthorityDirective } from './auth/has-any-authority.directive';
import { SaveAllDialogComponent } from './dialog/save-all/save-all.component';

@NgModule({
  imports: [TxcbSharedLibsModule],
  declarations: [
    FindLanguageFromKeyPipe,
    AlertComponent,
    AlertErrorComponent,
    LoginModalComponent,
    HasAnyAuthorityDirective,
    SaveAllDialogComponent,
  ],
  entryComponents: [LoginModalComponent, SaveAllDialogComponent],
  exports: [
    TxcbSharedLibsModule,
    FindLanguageFromKeyPipe,
    AlertComponent,
    AlertErrorComponent,
    LoginModalComponent,
    HasAnyAuthorityDirective,
    SaveAllDialogComponent,
  ],
})
export class TxcbSharedModule {}
