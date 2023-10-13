import { Component, OnInit, OnDestroy } from '@angular/core';
import { SystemConfigService } from './system-config.service';
import { Subject } from 'rxjs';
import { debounceTime } from 'rxjs/operators';
import { HttpErrorResponse, HttpResponse } from '@angular/common/http';
import { AccountService } from 'app/core/auth/account.service';
import { Authority } from './../../shared/constants/authority.constants';
import { TranslateService } from '@ngx-translate/core';
import { faCalendar } from '@fortawesome/free-solid-svg-icons';
import { FormBuilder, FormGroup } from '@angular/forms';
import * as moment from 'moment';
import { Moment } from 'moment/moment';
import { Account } from 'app/core/user/account.model';
import { Subscription } from 'rxjs';
import { JackpotSettingRecordService } from 'app/entities/jackpot-setting-record/jackpot-setting-record.service';
@Component({
  selector: 'jhi-system-config',
  templateUrl: './system-config.component.html',
  styleUrls: ['./system-config.component.scss'],
})
/* eslint-disable */
// flag = 0: TXCB
// flag = 1: Over/Under
// flag = 2: Xoc Dia
export class SystemConfigComponent implements OnInit, OnDestroy {
  coefficient = 1000;
  account: Account | null = null;
  authSubscription?: Subscription;
  listGame = [
    {
      title: 'Over/under Cân Bảng',
    },
    {
      title: 'Trên Dưới',
    },
    {
      title: 'Xóc Đĩa',
    },
  ];
  isMaintenance: boolean[];
  chatBotStatus: boolean[];
  gameBotStatus: boolean[];

  successMaintenanceMessage: string[];
  failedMaintenanceMessage: string[];
  private _successMaintenanceTXCB = new Subject<string>();
  private _failedMaintenanceTXCB = new Subject<string>();
  private _successMaintenanceOU = new Subject<string>();
  private _failedMaintenanceOU = new Subject<string>();
  private _successMaintenanceXD = new Subject<string>();
  private _failedMaintenanceXD = new Subject<string>();

  successChatBotMessage: string[];
  failedChatBotMessage: string[];
  private _successChatBotTXCB = new Subject<string>();
  private _failedChatBotTXCB = new Subject<string>();
  private _successChatBotOU = new Subject<string>();
  private _failedChatBotOU = new Subject<string>();
  private _successChatBotXD = new Subject<string>();
  private _failedChatBotXD = new Subject<string>();

  successGameBotMessage: string[];
  failedGameBotMessage: string[];
  private _successGameBotTXCB = new Subject<string>();
  private _failedGameBotTXCB = new Subject<string>();
  private _successGameBotOU = new Subject<string>();
  private _failedGameBotOU = new Subject<string>();
  private _successGameBotXD = new Subject<string>();
  private _failedGameBotXD = new Subject<string>();

  successUploadChatMessage: string[];
  failedUploadChatMessage: string[];
  private _successUploadChatTXCB = new Subject<string>();
  private _failedUploadChatTXCB = new Subject<string>();
  private _successUploadChatOU = new Subject<string>();
  private _failedUploadChatOU = new Subject<string>();
  private _successUploadChatXD = new Subject<string>();
  private _failedUploadChatXD = new Subject<string>();

  successUploadBotMessage: string[];
  failedUploadBotMessage: string[];
  private _successUploadBotTXCB = new Subject<string>();
  private _failedUploadBotTXCB = new Subject<string>();
  private _successUploadBotOU = new Subject<string>();
  private _failedUploadBotOU = new Subject<string>();
  private _successUploadBotXD = new Subject<string>();
  private _failedUploadBotXD = new Subject<string>();

  btnMaintenanceDisabled: boolean[];
  btnChatBotDisabled: boolean[];
  btnGameBotDisabled: boolean[];
  btnUploadChatDisabled: boolean[];
  btnUploadBotDisabled: boolean[];

  chatFile: File[];
  botFile: File[];

  showStatus: boolean;

  jackpotRandomSetting: string;
  successJackpotSettingMessage: string;
  failedJackpotSettingMessage: string;
  private _successJackpotSettingXD = new Subject<string>();
  private _failedJackpotSettingXD = new Subject<string>();

  jackpotStatusXD: boolean;
  faCalendar = faCalendar;
  jackpotBonusXD: string;
  btnJackpotStatusXDDisabled: boolean;
  successJackpotStatusXDMessage: string;
  failedJackpotStatusXDMessage: string;
  private _successJackpotStatusXD = new Subject<string>();
  private _failedJackpotStatusXD = new Subject<string>();

  successJackpotBonusXDMessage: string;
  failedJackpotBonusXDMessage: string;
  private _successJackpotBonusXD = new Subject<string>();
  private _failedJackpotBonusXD = new Subject<string>();
  filterForm: FormGroup;

  constructor(
    private systemConfigService: SystemConfigService,
    private accountService: AccountService,
    private translateService: TranslateService,
    private formBuilder: FormBuilder,
    private jackpotSettingRecordService: JackpotSettingRecordService
  ) {
    this.showStatus = false;

    this.isMaintenance = Array(this.listGame.length).fill(false);
    this.chatBotStatus = Array(this.listGame.length).fill(true);
    this.gameBotStatus = Array(this.listGame.length).fill(true);

    this.successMaintenanceMessage = Array(this.listGame.length).fill('');
    this.failedMaintenanceMessage = Array(this.listGame.length).fill('');

    this.successChatBotMessage = Array(this.listGame.length).fill('');
    this.failedChatBotMessage = Array(this.listGame.length).fill('');

    this.successGameBotMessage = Array(this.listGame.length).fill('');
    this.failedGameBotMessage = Array(this.listGame.length).fill('');

    this.successUploadChatMessage = Array(this.listGame.length).fill('');
    this.failedUploadChatMessage = Array(this.listGame.length).fill('');

    this.successUploadBotMessage = Array(this.listGame.length).fill('');
    this.failedUploadBotMessage = Array(this.listGame.length).fill('');

    this.btnMaintenanceDisabled = Array(this.listGame.length).fill(false);
    this.btnChatBotDisabled = Array(this.listGame.length).fill(false);
    this.btnGameBotDisabled = Array(this.listGame.length).fill(false);
    this.btnUploadChatDisabled = Array(this.listGame.length).fill(true);
    this.btnUploadBotDisabled = Array(this.listGame.length).fill(true);

    // jackpot Xoc Dia
    this.jackpotRandomSetting = '';
    this.jackpotStatusXD = true;
    this.successJackpotSettingMessage = '';
    this.failedJackpotSettingMessage = '';

    // jackpot Xoc Dia status and bonus
    this.jackpotBonusXD = '';
    this.btnJackpotStatusXDDisabled = false;
    this.successJackpotStatusXDMessage = '';
    this.failedJackpotStatusXDMessage = '';
    this.successJackpotBonusXDMessage = '';
    this.failedJackpotBonusXDMessage = '';
    this.filterForm = this.formBuilder.group({
      startDate: moment(new Date()),
      startTime: { hour: 0, minute: 0, second: 0 },
    });

    // eslint-disable-next-line @typescript-eslint/ban-ts-ignore
    // @ts-ignore
    this.chatFile = Array(this.listGame.length).fill(null);
    // eslint-disable-next-line @typescript-eslint/ban-ts-ignore
    // @ts-ignore
    this.botFile = Array(this.listGame.length).fill(null);
  }

  ngOnInit(): void {
    this.authSubscription = this.accountService.getAuthenticationState().subscribe(account => {
      this.account = account;
      this.showStatus = this.getShowStatus(account);
    });
    this.listGame.forEach((item, index) => {
      this.systemConfigService.getMaintenanceStatus(index + 1).subscribe(
        isMaintenance => {
          this.isMaintenance[index] = isMaintenance;
        },
        (error: HttpErrorResponse) => {
          alert(this.handleError(error));
        }
      );

      this.systemConfigService.getChatBotStatus(index + 1).subscribe(
        ret => {
          this.chatBotStatus[index] = ret.data;
        },
        (error: HttpErrorResponse) => {
          alert(this.handleError(error));
        }
      );

      this.systemConfigService.getGameBotStatus(index + 1).subscribe(
        ret => {
          this.gameBotStatus[index] = ret.data;
        },
        (error: HttpErrorResponse) => {
          alert(this.handleError(error));
        }
      );
      if (index === 0) {
        this._successMaintenanceTXCB.subscribe((message: any) => (this.successMaintenanceMessage[index] = message));
        this._successMaintenanceTXCB.pipe(debounceTime(10000)).subscribe(() => (this.successMaintenanceMessage[index] = ''));
        this._failedMaintenanceTXCB.subscribe((message: any) => (this.failedMaintenanceMessage[index] = message));
        this._failedMaintenanceTXCB.pipe(debounceTime(10000)).subscribe(() => (this.failedMaintenanceMessage[index] = ''));

        this._successChatBotTXCB.subscribe((message: any) => (this.successChatBotMessage[index] = message));
        this._successChatBotTXCB.pipe(debounceTime(10000)).subscribe(() => (this.successChatBotMessage[index] = ''));
        this._failedChatBotTXCB.subscribe((message: any) => (this.failedChatBotMessage[index] = message));
        this._failedChatBotTXCB.pipe(debounceTime(10000)).subscribe(() => (this.failedChatBotMessage[index] = ''));

        this._successGameBotTXCB.subscribe((message: any) => (this.successGameBotMessage[index] = message));
        this._successGameBotTXCB.pipe(debounceTime(10000)).subscribe(() => (this.successGameBotMessage[index] = ''));
        this._failedGameBotTXCB.subscribe((message: any) => (this.failedGameBotMessage[index] = message));
        this._failedGameBotTXCB.pipe(debounceTime(10000)).subscribe(() => (this.failedGameBotMessage[index] = ''));
      } else if (index === 1) {
        this._successMaintenanceOU.subscribe((message: any) => (this.successMaintenanceMessage[index] = message));
        this._successMaintenanceOU.pipe(debounceTime(10000)).subscribe(() => (this.successMaintenanceMessage[index] = ''));
        this._failedMaintenanceOU.subscribe((message: any) => (this.failedMaintenanceMessage[index] = message));
        this._failedMaintenanceOU.pipe(debounceTime(10000)).subscribe(() => (this.failedMaintenanceMessage[index] = ''));

        this._successChatBotOU.subscribe((message: any) => (this.successChatBotMessage[index] = message));
        this._successChatBotOU.pipe(debounceTime(10000)).subscribe(() => (this.successChatBotMessage[index] = ''));
        this._failedChatBotOU.subscribe((message: any) => (this.failedChatBotMessage[index] = message));
        this._failedChatBotOU.pipe(debounceTime(10000)).subscribe(() => (this.failedChatBotMessage[index] = ''));

        this._successGameBotOU.subscribe((message: any) => (this.successGameBotMessage[index] = message));
        this._successGameBotOU.pipe(debounceTime(10000)).subscribe(() => (this.successGameBotMessage[index] = ''));
        this._failedGameBotOU.subscribe((message: any) => (this.failedGameBotMessage[index] = message));
        this._failedGameBotOU.pipe(debounceTime(10000)).subscribe(() => (this.failedGameBotMessage[index] = ''));
      } else if (index === 2) {
        this._successMaintenanceXD.subscribe((message: any) => (this.successMaintenanceMessage[index] = message));
        this._successMaintenanceXD.pipe(debounceTime(10000)).subscribe(() => (this.successMaintenanceMessage[index] = ''));
        this._failedMaintenanceXD.subscribe((message: any) => (this.failedMaintenanceMessage[index] = message));
        this._failedMaintenanceXD.pipe(debounceTime(10000)).subscribe(() => (this.failedMaintenanceMessage[index] = ''));

        this._successChatBotXD.subscribe((message: any) => (this.successChatBotMessage[index] = message));
        this._successChatBotXD.pipe(debounceTime(10000)).subscribe(() => (this.successChatBotMessage[index] = ''));
        this._failedChatBotXD.subscribe((message: any) => (this.failedChatBotMessage[index] = message));
        this._failedChatBotXD.pipe(debounceTime(10000)).subscribe(() => (this.failedChatBotMessage[index] = ''));

        this._successGameBotXD.subscribe((message: any) => (this.successGameBotMessage[index] = message));
        this._successGameBotXD.pipe(debounceTime(10000)).subscribe(() => (this.successGameBotMessage[index] = ''));
        this._failedGameBotXD.subscribe((message: any) => (this.failedGameBotMessage[index] = message));
        this._failedGameBotXD.pipe(debounceTime(10000)).subscribe(() => (this.failedGameBotMessage[index] = ''));
      }
    });

    // Over/under
    this.listGame.forEach((item, index) => {
      if (index === 0) {
        // TXCB
        this._successUploadChatTXCB.subscribe((message: any) => (this.successUploadChatMessage[index] = message));
        this._successUploadChatTXCB.pipe(debounceTime(10000)).subscribe(() => (this.successUploadChatMessage[index] = ''));
        this._failedUploadChatTXCB.subscribe((message: any) => (this.failedUploadChatMessage[index] = message));
        this._failedUploadChatTXCB.pipe(debounceTime(10000)).subscribe(() => (this.failedUploadChatMessage[index] = ''));

        this._successUploadBotTXCB.subscribe((message: any) => (this.successUploadBotMessage[index] = message));
        this._successUploadBotTXCB.pipe(debounceTime(10000)).subscribe(() => (this.successUploadBotMessage[index] = ''));
        this._failedUploadBotTXCB.subscribe((message: any) => (this.failedUploadBotMessage[index] = message));
        this._failedUploadBotTXCB.pipe(debounceTime(10000)).subscribe(() => (this.failedUploadBotMessage[index] = ''));
      } else if (index === 1) {
        // Tren Duoi
        this._successUploadChatOU.subscribe((message: any) => (this.successUploadChatMessage[index] = message));
        this._successUploadChatOU.pipe(debounceTime(10000)).subscribe(() => (this.successUploadChatMessage[index] = ''));
        this._failedUploadChatOU.subscribe((message: any) => (this.failedUploadChatMessage[index] = message));
        this._failedUploadChatOU.pipe(debounceTime(10000)).subscribe(() => (this.failedUploadChatMessage[index] = ''));

        this._successUploadBotOU.subscribe((message: any) => (this.successUploadBotMessage[index] = message));
        this._successUploadBotOU.pipe(debounceTime(10000)).subscribe(() => (this.successUploadBotMessage[index] = ''));
        this._failedUploadBotOU.subscribe((message: any) => (this.failedUploadBotMessage[index] = message));
        this._failedUploadBotOU.pipe(debounceTime(10000)).subscribe(() => (this.failedUploadBotMessage[index] = ''));
      } else if (index === 2) {
        // Xoc Dia
        this._successUploadChatXD.subscribe((message: any) => (this.successUploadChatMessage[index] = message));
        this._successUploadChatXD.pipe(debounceTime(10000)).subscribe(() => (this.successUploadChatMessage[index] = ''));
        this._failedUploadChatXD.subscribe((message: any) => (this.failedUploadChatMessage[index] = message));
        this._failedUploadChatXD.pipe(debounceTime(10000)).subscribe(() => (this.failedUploadChatMessage[index] = ''));

        this._successUploadBotXD.subscribe((message: any) => (this.successUploadBotMessage[index] = message));
        this._successUploadBotXD.pipe(debounceTime(10000)).subscribe(() => (this.successUploadBotMessage[index] = ''));
        this._failedUploadBotXD.subscribe((message: any) => (this.failedUploadBotMessage[index] = message));
        this._failedUploadBotXD.pipe(debounceTime(10000)).subscribe(() => (this.failedUploadBotMessage[index] = ''));

        this._successJackpotSettingXD.subscribe((message: any) => (this.successJackpotSettingMessage = message));
        this._successJackpotSettingXD.pipe(debounceTime(10000)).subscribe(() => (this.successJackpotSettingMessage = ''));
        this._failedJackpotSettingXD.subscribe((message: any) => (this.failedJackpotSettingMessage = message));
        this._failedJackpotSettingXD.pipe(debounceTime(10000)).subscribe(() => (this.failedJackpotSettingMessage = ''));

        this._successJackpotStatusXD.subscribe((message: any) => (this.successJackpotStatusXDMessage = message));
        this._successJackpotStatusXD.pipe(debounceTime(10000)).subscribe(() => (this.successJackpotStatusXDMessage = ''));
        this._failedJackpotStatusXD.subscribe((message: any) => (this.failedJackpotStatusXDMessage = message));
        this._failedJackpotStatusXD.pipe(debounceTime(10000)).subscribe(() => (this.failedJackpotStatusXDMessage = ''));

        this._successJackpotBonusXD.subscribe((message: any) => (this.successJackpotBonusXDMessage = message));
        this._successJackpotBonusXD.pipe(debounceTime(1000000)).subscribe(() => (this.successJackpotBonusXDMessage = ''));
        this._failedJackpotBonusXD.subscribe((message: any) => (this.failedJackpotBonusXDMessage = message));
        this._failedJackpotBonusXD.pipe(debounceTime(1000000)).subscribe(() => (this.failedJackpotBonusXDMessage = ''));
      }
    });

    // jackpot Xoc Dia
    this.systemConfigService.getJackpotStatus().subscribe(
      res => {
        this.jackpotStatusXD = res;
      },
      (error: HttpErrorResponse) => {
        alert(this.handleError(error));
      }
    );

    this.systemConfigService.getJackpotBonus().subscribe(
      res => {
        if (res && res.length > 0) {
          const datetime = new Date(res[0]);
          this.jackpotBonusXD = this.numberWithCommas(res[1]);
          this.filterForm.controls.startDate.setValue(moment(new Date(datetime)));
          this.filterForm.controls.startTime.setValue({
            hour: datetime.getHours(),
            minute: datetime.getMinutes(),
            second: datetime.getSeconds(),
          });
        }
      },
      (error: HttpErrorResponse) => {
        alert(this.handleError(error));
      }
    );
    this.getJackpotSetting();
  }

  ngOnDestroy(): void {
    if (this.authSubscription) {
      this.authSubscription.unsubscribe();
    }
  }

  changeMaintenanceStatus(flag: number, status: boolean): void {
    if (this.btnMaintenanceDisabled[flag]) return;
    this.btnMaintenanceDisabled[flag] = true;
    this.systemConfigService.setMaintenanceStatus(flag + 1, String(status)).subscribe(
      ret => {
        if (flag === 0) {
          this._successMaintenanceTXCB.next(ret.message);
        } else if (flag === 1) {
          this._successMaintenanceOU.next(ret.message);
        } else if (flag === 2) {
          this._successMaintenanceXD.next(ret.message);
        }
        this.isMaintenance[flag] = !this.isMaintenance[flag];
        this.btnMaintenanceDisabled[flag] = false;
      },
      (error: HttpErrorResponse) => {
        if (flag === 0) {
          this._failedMaintenanceTXCB.next(this.handleError(error));
        } else if (flag === 1) {
          this._failedMaintenanceOU.next(this.handleError(error));
        } else if (flag === 2) {
          this._failedMaintenanceXD.next(this.handleError(error));
        }
        this.btnMaintenanceDisabled[flag] = false;
      }
    );
  }

  changeChatBotStatus(flag: number): void {
    if (this.btnChatBotDisabled[flag]) return;
    this.btnChatBotDisabled[flag] = true;
    this.systemConfigService.setChatBotStatus(flag + 1).subscribe(
      res => {
        if (flag === 0) {
          this._successChatBotTXCB.next(res.message);
        } else if (flag === 1) {
          this._successChatBotOU.next(res.message);
        } else if (flag === 2) {
          this._successChatBotXD.next(res.message);
        }
        this.chatBotStatus[flag] = !this.chatBotStatus[flag];
        this.btnChatBotDisabled[flag] = false;
      },
      (error: HttpErrorResponse) => {
        if (flag === 0) {
          this._failedChatBotTXCB.next(this.handleError(error));
        } else if (flag === 1) {
          this._failedChatBotOU.next(this.handleError(error));
        } else if (flag === 2) {
          this._failedChatBotXD.next(this.handleError(error));
        }
        this.btnChatBotDisabled[flag] = false;
      }
    );
  }

  changeGameBotStatus(flag: number): void {
    if (this.btnGameBotDisabled[flag]) return;
    this.btnGameBotDisabled[flag] = true;
    this.systemConfigService.setGameBotStatus(flag + 1).subscribe(
      res => {
        if (flag === 0) {
          this._successGameBotTXCB.next(res.message);
        } else if (flag === 1) {
          this._successGameBotOU.next(res.message);
        } else if (flag === 2) {
          this._successGameBotXD.next(res.message);
        }
        this.gameBotStatus[flag] = !this.gameBotStatus[flag];
        this.btnGameBotDisabled[flag] = false;
      },
      (error: HttpErrorResponse) => {
        if (flag === 0) {
          this._failedGameBotTXCB.next(this.handleError(error));
        } else if (flag === 1) {
          this._failedGameBotOU.next(this.handleError(error));
        } else if (flag === 2) {
          this._failedGameBotXD.next(this.handleError(error));
        }
        this.btnGameBotDisabled[flag] = false;
      }
    );
  }

  handleChatFile(flag: number, target: any): void {
    // eslint-disable-next-line @typescript-eslint/ban-ts-ignore
    // @ts-ignore
    this.chatFile[flag] = null;
    this.chatFile[flag] = target.files.item(0);
    if (!this.chatFile[flag]) {
      this.btnUploadChatDisabled[flag] = true;
      if (flag === 0) {
        this._failedGameBotTXCB.next(this.translateService.instant('system-config.messages.error.chooseFile'));
      } else if (flag === 1) {
        this._failedGameBotOU.next(this.translateService.instant('system-config.messages.error.chooseFile'));
      } else if (flag === 2) {
        this._failedGameBotXD.next(this.translateService.instant('system-config.messages.error.chooseFile'));
      }
    } else {
      this.btnUploadChatDisabled[flag] = false;
      if (flag === 0) {
        this._successUploadChatTXCB.next(this.translateService.instant('system-config.messages.success.chooseFile'));
      } else if (flag === 1) {
        this._successUploadChatOU.next(this.translateService.instant('system-config.messages.success.chooseFile'));
      } else if (flag === 2) {
        this._successUploadChatXD.next(this.translateService.instant('system-config.messages.success.chooseFile'));
      }
    }
  }

  submitChatFile(flag: number): void {
    this.systemConfigService.postChatFile(flag + 1, this.chatFile[flag]).subscribe(
      ret => {
        if (flag === 0) {
          this._successUploadChatTXCB.next(ret.message);
        } else if (flag === 1) {
          this._successUploadChatOU.next(ret.message);
        } else if (flag === 2) {
          this._successUploadChatXD.next(ret.message);
        }
        this.btnUploadChatDisabled[flag] = true;
      },
      (error: HttpErrorResponse) => {
        if (flag === 0) {
          this._failedUploadChatTXCB.next(this.handleError(error));
        } else if (flag === 1) {
          this._failedUploadChatOU.next(this.handleError(error));
        } else if (flag === 2) {
          this._failedUploadChatXD.next(this.handleError(error));
        }
        this.btnUploadChatDisabled[flag] = true;
      }
    );
  }

  handleBotFile(flag: number, target: any): void {
    // eslint-disable-next-line @typescript-eslint/ban-ts-ignore
    // @ts-ignore
    this.botFile[flag] = null;
    this.botFile[flag] = target.files.item(0);
    if (!this.botFile[flag]) {
      this.btnUploadBotDisabled[flag] = true;
      if (flag === 0) {
        this._failedUploadBotTXCB.next(this.translateService.instant('system-config.messages.error.chooseFile'));
      } else if (flag === 1) {
        this._failedUploadBotOU.next(this.translateService.instant('system-config.messages.error.chooseFile'));
      } else if (flag === 2) {
        this._failedUploadBotXD.next(this.translateService.instant('system-config.messages.error.chooseFile'));
      }
    } else {
      this.btnUploadBotDisabled[flag] = false;
      if (flag === 0) {
        this._successUploadBotTXCB.next(this.translateService.instant('system-config.messages.success.chooseFile'));
      } else if (flag === 1) {
        this._successUploadBotOU.next(this.translateService.instant('system-config.messages.success.chooseFile'));
      } else if (flag === 2) {
        this._successUploadBotXD.next(this.translateService.instant('system-config.messages.success.chooseFile'));
      }
    }
  }

  submitBotFile(flag: number): void {
    this.systemConfigService.postBotFile(flag + 1, this.botFile[flag]).subscribe(
      ret => {
        if (flag === 0) {
          this._successUploadBotTXCB.next(ret.message);
        } else if (flag === 1) {
          this._successUploadBotOU.next(ret.message);
        } else if (flag === 2) {
          this._successUploadBotXD.next(ret.message);
        }
        this.btnUploadBotDisabled[flag] = true;
      },
      (error: HttpErrorResponse) => {
        if (flag === 0) {
          this._failedUploadBotTXCB.next(this.handleError(error));
        } else if (flag === 1) {
          this._failedUploadBotOU.next(this.handleError(error));
        } else if (flag === 2) {
          this._failedUploadBotXD.next(this.handleError(error));
        }
        this.btnUploadBotDisabled[flag] = true;
      }
    );
  }

  getShowStatus(account: any): boolean {
    if (account && account.authorities && account.authorities.length > 0 && account.authorities.includes(Authority.ADMIN)) {
      return true;
    }
    return false;
  }

  handleError(error: HttpErrorResponse): string {
    if (error.status === 403) {
      return 'Chưa được cấp quyền';
    }
    return error.statusText;
  }

  downloadFile(flagGame: number, flagType: number): void {
    let gametype = 0;
    if (flagGame === 0 && flagType === 0) {
      gametype = 2; // Chat TXCB
    } else if (flagGame === 0 && flagType === 1) {
      gametype = 1; // Bot TXCB
    } else if (flagGame === 1 && flagType === 0) {
      gametype = 4; // Chat Tren Duoi
    } else if (flagGame === 1 && flagType === 1) {
      gametype = 3; // Bot Tren Duoi
    } else if (flagGame === 2 && flagType === 0) {
      gametype = 6; // Chat Xoc Dia
    } else if (flagGame === 2 && flagType === 1) {
      gametype = 5; // Bot Xoc Dia
    }
    this.systemConfigService.downloadFile(gametype).subscribe(
      res => {
        this.saveFile(res, gametype);
        setTimeout(() => {
          this.showMessageByGameType(gametype, this.translateService.instant('system-config.messages.success.downloadFile'), 1);
        }, 500);
      },
      (error: HttpErrorResponse) => {
        this.showMessageByGameType(gametype, this.translateService.instant('system-config.messages.error.downloadFile'), 0);
      }
    );
  }

  saveFile(res: any, gametype: number) {
    let fileName = 'file.txt';
    switch (gametype) {
      case 1:
        fileName = 'botTXCB.txt';
        break;
      case 2:
        fileName = 'chatTXCB.txt';
        break;
      case 3:
        fileName = 'botTrenDuoi.txt';
        break;
      case 4:
        fileName = 'chatTrenDuoi.txt';
        break;
      case 5:
        fileName = 'botXocDia.txt';
        break;
      case 6:
        fileName = 'chatXocDia.txt';
        break;
      default:
        break;
    }
    if (res.body) {
      let blob = new Blob([res.body]);
      var url = window.URL.createObjectURL(blob);
      var anchor = document.createElement('a');
      anchor.download = fileName;
      anchor.href = url;
      anchor.click();
    } else {
    }
  }

  showMessageByGameType(gametype: number, msg: string, type: number) {
    switch (gametype) {
      case 1:
        if (type === 1) {
          this._successUploadBotTXCB.next(msg);
        } else {
          this._failedUploadBotTXCB.next(msg);
        }
        break;
      case 2:
        if (type === 1) {
          this._successUploadChatTXCB.next(msg);
        } else {
          this._failedUploadChatTXCB.next(msg);
        }
        break;
      case 3:
        if (type === 1) {
          this._successUploadBotOU.next(msg);
        } else {
          this._failedUploadBotOU.next(msg);
        }
        break;
      case 4:
        if (type === 1) {
          this._successUploadChatOU.next(msg);
        } else {
          this._failedUploadChatOU.next(msg);
        }
        break;
      case 5:
        if (type === 1) {
          this._successUploadBotXD.next(msg);
        } else {
          this._failedUploadBotXD.next(msg);
        }
        break;
      case 6:
        if (type === 1) {
          this._successUploadChatXD.next(msg);
        } else {
          this._failedUploadChatXD.next(msg);
        }
        break;
      default:
        break;
    }
  }

  submitJackpotSetting() {
    if (!this.jackpotRandomSetting) return;
    const newlist = this.validateJackpotInput(this.jackpotRandomSetting);
    if (!newlist) {
      return;
    }
    this.systemConfigService.setXDJackpotSetting(newlist).subscribe(
      res => {
        if (res && res.body && res.body.status === 0) {
          this._successJackpotSettingXD.next('Update successfully');
          const objSetting = {
            createdBy: this.account?.login,
            createdDate: new Date().toISOString(),
            value: newlist,
          };
          this.systemConfigService.saveXDJackpotSetting(objSetting).subscribe(
            res => {
              if (res) {
                console.log('Saved jackpot setting');
              }
            },
            error => {
              console.log('Jackpot setting save failed', error);
            }
          );
        } else {
          this._failedJackpotSettingXD.next('An error occurred');
        }
      },
      (error: HttpErrorResponse) => {
        this._failedJackpotSettingXD.next(this.handleError(error));
      }
    );
  }

  validateJackpotInput(jackpotSettings: string): any {
    jackpotSettings = jackpotSettings.replace(/,/g, '');
    let list = jackpotSettings.split(';').filter(item => item !== '');
    if (list.filter(item => isNaN(Number(item))).length > 0) {
      this._failedJackpotSettingXD.next('Nhập sai định dạng, vui lòng kiểm tra lại!');
      return false;
    }
    let newlist = '';
    list.map(item => {
      item = String(Number(item) * this.coefficient);
      newlist += `${item};`;
    });
    newlist = newlist.slice(0, -1);
    return newlist;
  }

  convertStorageJPSetting(listString: string) {
    const newlistString = listString.split(';').filter((item: any) => item !== '');
    let newlist = '';
    newlistString.map((num: any, index: number) => {
      newlist += this.numberWithCommas(Number(num) / this.coefficient);
      if (index != newlistString.length - 1) {
        newlist += ';';
      }
    });
    return newlist;
  }

  updateMoneyKeyUp(ev: any) {
    const list = ev.split(';').filter((item: any) => item !== '');
    let newJP = '';
    list.map((item: any, index: number) => {
      const getMoneyRegx = item.replace(/[,]/g, '');
      let newItem = this.numberWithCommas(Number(getMoneyRegx));
      if (newItem !== '') {
        newJP += index === list.length - 1 ? `${newItem}` : `${newItem};`;
      }
    });
    this.jackpotRandomSetting = newJP;
  }

  numberWithCommas(x: number): string {
    const num = Number(x).toFixed(0);
    return num
      .toString()
      .replace(/\D/g, '')
      .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
  }

  changeJackpotStatus(flag: boolean): void {
    if (this.btnJackpotStatusXDDisabled) return;
    this.btnJackpotStatusXDDisabled = true;
    this.systemConfigService.setJackpotStatus(String(flag)).subscribe(
      res => {
        this._successJackpotStatusXD.next(res ? 'Jackpot actived' : 'Jackpot inactived');
        this.jackpotStatusXD = !this.jackpotStatusXD;
        this.btnJackpotStatusXDDisabled = false;
      },
      (error: HttpErrorResponse) => {
        this._failedJackpotStatusXD.next(this.handleError(error));
        this.btnJackpotStatusXDDisabled = false;
      }
    );
  }

  updateMoneyKeyUpBonus(ev: any) {
    const getMoneyRegx = ev.replace(/[,]/g, '');
    this.jackpotBonusXD = this.numberWithCommas(Number(getMoneyRegx));
  }

  onSubmitBonus(filter: { startDate: Moment; startTime: { hour: number; minute: number; second: number } }): void {
    const start = moment(
      new Date(
        filter.startDate.year(),
        filter.startDate.month(),
        filter.startDate.date(),
        filter.startTime.hour,
        filter.startTime.minute,
        filter.startTime.second,
        0
      )
    );
    const amount = this.jackpotBonusXD.replace(/[,]/g, '');
    const time = start.toISOString(true).split('+')[0];
    this.systemConfigService.setJackpotBonus(amount, time).subscribe(
      res => {
        if (res) {
          this._successJackpotBonusXD.next(this.translateService.instant('system-config.messages.success.jackpotBonus'));
        } else {
          this._failedJackpotBonusXD.next(this.translateService.instant('system-config.messages.error.jackpotBonus'));
        }
      },
      (error: HttpErrorResponse) => {
        this.handleError(error);
      }
    );
  }

  getJackpotSetting() {
    this.jackpotSettingRecordService
      .findJPSetting({
        page: 0,
        size: 5,
        sort: ['id,desc'],
      })
      .subscribe(
        (res: HttpResponse<any>) => {
          if (res && res.body && res.body['content'] && res.body['content'].length > 0) {
            const firstData = res.body.content[0].value;
            const listValue = firstData.split(';');
            let newValue = '';
            listValue.forEach((num: string, idx: number) => {
              const number = Number(num) / this.coefficient;
              if (idx !== listValue.length - 1) {
                newValue += `${this.numberWithCommas(Number(number))};`;
              } else {
                newValue += `${this.numberWithCommas(Number(number))}`;
              }
            });
            this.jackpotRandomSetting = newValue;
          } else {
            this.jackpotRandomSetting = '';
          }
        },
        () => {
          console.log('Can not get jackpot setting bonus');
          alert('An error occurred. Please try again!');
        }
      );
  }
}
