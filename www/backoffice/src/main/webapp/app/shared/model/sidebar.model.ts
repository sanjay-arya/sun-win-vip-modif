import { IconProp } from '@fortawesome/fontawesome-svg-core';

export interface ISidebarModel {
  id: string;
  title: string;
  translate: string;
  icon: IconProp;
  routerLink: string;
  collapsed: boolean;
  subMenu: ISideBarSubMenuInterface[];
}

export interface ISideBarSubMenuInterface {
  id: string;
  title: string;
  translate: string;
  icon: IconProp;
  routerLink: string;
  roles: number[];
  collapsed?: boolean;
  subMenu2?: ISideBarSubMenu2Interface[];
}
export interface ISideBarSubMenu2Interface {
  title: string;
  translate: string;
  icon: IconProp;
  routerLink: string;
  roles: number[];
}
