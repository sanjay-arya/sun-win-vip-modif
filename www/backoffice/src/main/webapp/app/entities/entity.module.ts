import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

@NgModule({
  imports: [
    RouterModule.forChild([
      {
        path: 'taixiu',
        loadChildren: () => import('./taixiu/taixiu.module').then(m => m.TxcbTaixiuModule),
      },
      {
        path: 'taixiu-record',
        loadChildren: () => import('./taixiu-record/taixiu-record.module').then(m => m.TxcbTaixiuRecordModule),
      },
      {
        path: 'userinfo',
        loadChildren: () => import('./userinfo/userinfo.module').then(m => m.TxcbUserinfoModule),
      },
      {
        path: 'chatbox',
        loadChildren: () => import('./chatbox/chatbox.module').then(m => m.TxcbChatboxModule),
      },
      {
        path: 'tx-rank',
        loadChildren: () => import('./tx-rank/tx-rank.module').then(m => m.TaixiucbTxRankModule),
      },
      {
        path: 'system-config',
        loadChildren: () => import('../admin/system-config/system-config.module').then(m => m.SystemConfigModule),
      },
      {
        path: 'admin-user-management',
        loadChildren: () => import('./admin-user-management/admin-user-management.module').then(m => m.AdminUserManagementModule),
      },
      {
        path: 'rocket-rank',
        loadChildren: () => import('./rocket-rank/rocket-rank.module').then(m => m.TaixiucbRocketRankModule),
      },
      {
        path: 'rocket',
        loadChildren: () => import('./rocket/rocket.module').then(m => m.TaixiucbRocketModule),
      },
      {
        path: 'rocket-chatbox',
        loadChildren: () => import('./rocket-chatbox/rocket-chatbox.module').then(m => m.TaixiucbRocketChatboxModule),
      },
      {
        path: 'rocket-rate',
        loadChildren: () => import('./rocket-rate/rocket-rate.module').then(m => m.TaixiucbRocketRateModule),
      },
      {
        path: 'xocdia',
        loadChildren: () => import('./xocdia/xocdia.module').then(m => m.TaixiucbXocdiaModule),
      },
      {
        path: 'xocdia-record',
        loadChildren: () => import('./xocdia-record/xocdia-record.module').then(m => m.TaixiucbXocdiaRecordModule),
      },
      {
        path: 'xocdia-rank',
        loadChildren: () => import('./xocdia-rank/xocdia-rank.module').then(m => m.TaixiucbXocdiaRankModule),
      },
      {
        path: 'xocdia-chatbox',
        loadChildren: () => import('./xocdia-chatbox/xocdia-chatbox.module').then(m => m.TaixiucbXocdiaChatboxModule),
      },
      {
        path: 'xocdia-jackpot-record',
        loadChildren: () => import('./xocdia-jackpot-record/xocdia-jackpot-record.module').then(m => m.TaixiucbXocdiaJackpotRecordModule),
      },
      {
        path: 'jackpot-setting-record',
        loadChildren: () =>
          import('./jackpot-setting-record/jackpot-setting-record.module').then(m => m.TaixiucbJackpotSettingRecordModule),
      },
      {
        path: 'transfer-history',
        loadChildren: () => import('./transfer-history/transfer-history.module').then(m => m.TaixiucbTransferHistoryModule),
      },
      {
        path: 'transaction-history',
        loadChildren: () => import('./transaction-history/transaction-history.module').then(m => m.TaixiucbTransactionHistoryModule),
      },
      {
        path: 'report-game',
        loadChildren: () => import('./report-game/report-game.module').then(m => m.TaixiucbReportGameModule),
      },
      /* jhipster-needle-add-entity-route - JHipster will add entity modules routes here */
    ]),
  ],
})
export class TxcbEntityModule {}
