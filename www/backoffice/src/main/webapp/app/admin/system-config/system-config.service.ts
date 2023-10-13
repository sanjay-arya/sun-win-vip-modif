import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { SERVER_API_URL } from 'app/app.constants';
import { Observable } from 'rxjs';

export interface BaseResponse<T> {
  cmd: number;
  status: number;
  message: string;
  data: T;
}

type EntityResponseType = HttpResponse<any>;
@Injectable({
  providedIn: 'root',
})
export class SystemConfigService {
  constructor(private http: HttpClient) {}

  getMaintenanceStatus(gameType: number): Observable<boolean> {
    return this.http.get<boolean>(`${SERVER_API_URL}api/config/maintain`, {
      params: {
        gametype: String(gameType),
      },
    });
  }

  setMaintenanceStatus(gameType: number, status: string): Observable<BaseResponse<boolean>> {
    return this.http.post<BaseResponse<boolean>>(`${SERVER_API_URL}api/config/maintain`, null, {
      params: {
        activeBot: String(status),
        gametype: String(gameType),
      },
    });
  }

  getChatBotStatus(gameType: number): Observable<BaseResponse<boolean>> {
    return this.http.post<BaseResponse<boolean>>(`${SERVER_API_URL}api/config/get-status-bot-chat`, null, {
      params: {
        gametype: String(gameType),
      },
    });
  }

  setChatBotStatus(gameType: number): Observable<BaseResponse<boolean>> {
    return this.http.post<BaseResponse<boolean>>(`${SERVER_API_URL}api/config/active-bot-chat`, null, {
      params: {
        gametype: String(gameType),
      },
    });
  }

  getGameBotStatus(gameType: number): Observable<BaseResponse<boolean>> {
    return this.http.post<BaseResponse<boolean>>(`${SERVER_API_URL}api/config/get-status-bot-game`, null, {
      params: {
        gametype: String(gameType),
      },
    });
  }

  setGameBotStatus(gameType: number): Observable<BaseResponse<boolean>> {
    return this.http.post<BaseResponse<boolean>>(`${SERVER_API_URL}api/config/active-bot`, null, {
      params: {
        gametype: String(gameType),
      },
    });
  }

  postChatFile(gameType: number, file: File): Observable<BaseResponse<boolean>> {
    const formData: FormData = new FormData();
    formData.append('files', file, file.name);
    return this.http.post<BaseResponse<boolean>>(`${SERVER_API_URL}api/config/upload-bot-chat`, formData, {
      params: {
        gametype: String(gameType),
      },
    });
  }

  postBotFile(gameType: number, file: File): Observable<BaseResponse<boolean>> {
    const formData: FormData = new FormData();
    formData.append('files', file, file.name);
    return this.http.post<BaseResponse<boolean>>(`${SERVER_API_URL}api/config/upload-bot-game`, formData, {
      params: {
        gametype: String(gameType),
      },
    });
  }

  downloadFile(type: number): Observable<any> {
    return this.http.get(`${SERVER_API_URL}api/config/download`, {
      responseType: 'blob',
      observe: 'response' as 'body',
      params: {
        gametype: String(type),
      },
    });
  }

  setXDJackpotSetting(jackpotSetting: string): Observable<EntityResponseType> {
    return this.http.post<string>(`${SERVER_API_URL}api/jackpot/add`, jackpotSetting, { observe: 'response' });
  }

  saveXDJackpotSetting(jackpotSetting: any): Observable<EntityResponseType> {
    return this.http.post<string>(`${SERVER_API_URL}api/jackpot/savesetting`, jackpotSetting, { observe: 'response' });
  }

  getJackpotStatus(): Observable<boolean> {
    return this.http.get<boolean>(`${SERVER_API_URL}api/jackpot/jpstatus`);
  }

  setJackpotStatus(jackpotStatus: string): Observable<boolean> {
    return this.http.get<boolean>(`${SERVER_API_URL}api/jackpot/setjpstatus`, {
      params: {
        jp: jackpotStatus,
      },
    });
  }

  getJackpotBonus(): Observable<any> {
    return this.http.get<boolean>(`${SERVER_API_URL}api/jackpot/getbonus`);
  }

  setJackpotBonus(bonusAmount: string, bonusTime: string): Observable<boolean> {
    return this.http.get<boolean>(`${SERVER_API_URL}api/jackpot/setbonus`, {
      params: {
        amount: bonusAmount,
        time: bonusTime,
      },
    });
  }
}
