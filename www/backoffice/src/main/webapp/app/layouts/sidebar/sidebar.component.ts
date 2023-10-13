import { Authority } from './../../shared/constants/authority.constants';
import { Component, EventEmitter, OnInit, Output } from '@angular/core';
import { VERSION } from 'app/app.constants';
import { LoginService } from 'app/core/login/login.service';
import { JhiLanguageService } from 'ng-jhipster';
import { SessionStorageService } from 'ngx-webstorage';
import { AccountService } from 'app/core/auth/account.service';
import { LoginModalService } from 'app/core/login/login-modal.service';
import { ProfileService } from 'app/layouts/profiles/profile.service';
import { LANGUAGES } from 'app/core/language/language.constants';
import { SIDE_BAR } from 'app/shared/constants/sidebar.constants';
import { ISidebarModel } from 'app/shared/model/sidebar.model';
import { UserService } from 'app/core/user/user.service';
import { Router } from '@angular/router';
/* eslint-disable */
@Component({
  selector: 'jhi-sidebar',
  templateUrl: './sidebar.component.html',
  styleUrls: ['./sidebar.component.scss'],
})
export class SidebarComponent implements OnInit {
  inProduction?: boolean;
  languages = LANGUAGES;
  sideBar = SIDE_BAR;
  swaggerEnabled?: boolean;
  version: string;
  collapsed: boolean;
  @Output() collapsedSideBar: EventEmitter<boolean>;
  authorities: any;
  sideBarActive: any;

  constructor(
    private loginService: LoginService,
    private languageService: JhiLanguageService,
    private sessionStorage: SessionStorageService,
    private accountService: AccountService,
    private loginModalService: LoginModalService,
    private profileService: ProfileService,
    private userService: UserService,
    private router: Router
  ) {
    this.version = VERSION ? (VERSION.toLowerCase().startsWith('v') ? VERSION : 'v' + VERSION) : '';
    this.collapsed = false;
    this.collapsedSideBar = new EventEmitter();
  }

  ngOnInit(): void {
    this.profileService.getProfileInfo().subscribe(profileInfo => {
      this.inProduction = profileInfo.inProduction;
      this.swaggerEnabled = profileInfo.swaggerEnabled;
    });
    this.accountService.getAuthenticationState().subscribe(account => {
      this.authorities = account?.authorities;
      if (this.authorities && this.authorities.length > 0) {
        this.setMenu(this.authorities, true);
      } else {
        this.setMenu(this.authorities, false);
      }
    });
  }

  toggleSideBar(): void {
    if (this.sideBarActive) {
      this.sideBarActive.forEach((item: ISidebarModel) => {
        item.collapsed = true;
      });
      this.collapsed = !this.collapsed;
      this.collapsedSideBar.emit(this.collapsed);
    }
  }

  toggleMenu(index: number): void {
    this.collapsed = false;
    this.collapsedSideBar.emit(this.collapsed);
    this.sideBarActive[index].collapsed = !this.sideBarActive[index].collapsed;
  }

  setMenu(authorities: string[], auth: boolean): void {
    this.sideBarActive = [];
    if (auth) {
      const listRoles: number[] = [];
      authorities.forEach(item => {
        switch (item) {
          case Authority.ADMIN:
            listRoles.push(0);
            break;
          case Authority.USER:
            listRoles.push(1);
            break;
          case Authority.MKT:
            listRoles.push(2);
            break;
          case Authority.CS:
            listRoles.push(3);
            break;
          default:
            break;
        }
      });
      this.sideBar.forEach(menu => {
        menu['subMenuActive'] = menu.subMenu.filter(sub => listRoles.some(r => sub.roles.includes(r)));
        if (menu['subMenuActive'].length > 0) {
          menu.subMenu.forEach(submenu => {
            submenu['subMenu2Active'] = submenu.subMenu2?.filter(sub2 => listRoles.some(r => sub2.roles.includes(r)));
            const flag = submenu.subMenu2?.find(sub2 => `/${sub2.routerLink}` === this.router.url);
            if (flag) {
              submenu['active'] = true;
            } else {
              submenu['active'] = false;
            }
          });
          this.sideBarActive.push(menu);
        }
      });
    } else {
      this.sideBar.forEach(menu => {
        menu['subMenuActive'] = [];
        this.sideBarActive.push(menu);
      });
    }
    // this.sideBarActive = this.sideBar.filter((menu: ISidebarModel) => menu['subMenuActive'].length > 0);
  }

  toggleSubMenu(idx: number, idxSub: number) {
    if (this.sideBarActive[idx].subMenuActive[idxSub].routerLink) {
      this.router.navigate([this.sideBarActive[idx].subMenuActive[idxSub].routerLink]);
      this.sideBarActive.map((menu: any) => {
        menu.subMenuActive.map((item: any) => {
          item.active = false;
        });
      });
      this.sideBarActive[idx].subMenuActive[idxSub].active = true;
    } else {
      this.sideBarActive[idx].subMenuActive[idxSub].collapsed = !this.sideBarActive[idx].subMenuActive[idxSub].collapsed;
    }
  }

  toggleMenuSection(idx: number, idxSub: number) {
    this.sideBarActive.map((menu: any) => {
      menu.subMenuActive.map((item: any) => {
        item.active = false;
      });
    });
    this.sideBarActive[idx].subMenuActive[idxSub].active = true;
  }
}
