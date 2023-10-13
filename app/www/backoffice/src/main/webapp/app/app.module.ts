import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import './vendor';
import { TxcbSharedModule } from 'app/shared/shared.module';
import { TxcbCoreModule } from 'app/core/core.module';
import { TxcbAppRoutingModule } from './app-routing.module';
import { TxcbHomeModule } from './home/home.module';
import { TxcbEntityModule } from './entities/entity.module';
// jhipster-needle-angular-add-module-import JHipster will add new module here
import { MainComponent } from './layouts/main/main.component';
import { NavbarComponent } from './layouts/navbar/navbar.component';
import { FooterComponent } from './layouts/footer/footer.component';
import { PageRibbonComponent } from './layouts/profiles/page-ribbon.component';
import { ActiveMenuDirective } from './layouts/navbar/active-menu.directive';
import { ErrorComponent } from './layouts/error/error.component';
import { SidebarComponent } from './layouts/sidebar/sidebar.component';

@NgModule({
  imports: [
    BrowserModule,
    TxcbSharedModule,
    TxcbCoreModule,
    TxcbHomeModule,
    // jhipster-needle-angular-add-module JHipster will add new module here
    TxcbEntityModule,
    TxcbAppRoutingModule,
  ],
  declarations: [
    MainComponent,
    NavbarComponent,
    ErrorComponent,
    PageRibbonComponent,
    ActiveMenuDirective,
    FooterComponent,
    SidebarComponent,
  ],
  bootstrap: [MainComponent],
})
export class TxcbAppModule {}
