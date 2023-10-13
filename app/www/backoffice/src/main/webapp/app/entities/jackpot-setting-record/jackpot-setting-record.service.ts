import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';

import { SERVER_API_URL } from 'app/app.constants';
import { createRequestOption } from 'app/shared/util/request-util';
import { IJackpotSettingRecord } from 'app/shared/model/jackpot-setting-record.model';

type EntityResponseType = HttpResponse<IJackpotSettingRecord>;
type EntityArrayResponseType = HttpResponse<IJackpotSettingRecord[]>;

@Injectable({ providedIn: 'root' })
export class JackpotSettingRecordService {
  public resourceUrl = SERVER_API_URL + 'api/jackpot/findjpsetting';

  constructor(protected http: HttpClient) {}

  create(jackpotSettingRecord: IJackpotSettingRecord): Observable<EntityResponseType> {
    return this.http.post<IJackpotSettingRecord>(this.resourceUrl, jackpotSettingRecord, { observe: 'response' });
  }

  update(jackpotSettingRecord: IJackpotSettingRecord): Observable<EntityResponseType> {
    return this.http.put<IJackpotSettingRecord>(this.resourceUrl, jackpotSettingRecord, { observe: 'response' });
  }

  find(id: number): Observable<EntityResponseType> {
    return this.http.get<IJackpotSettingRecord>(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }

  query(req?: any): Observable<EntityArrayResponseType> {
    const options = createRequestOption(req);
    return this.http.get<IJackpotSettingRecord[]>(this.resourceUrl, { params: options, observe: 'response' });
  }

  delete(id: number): Observable<HttpResponse<{}>> {
    return this.http.delete(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }

  findJPSetting(req?: any): Observable<EntityResponseType> {
    const options = createRequestOption(req);
    return this.http.get<any>(this.resourceUrl, { params: options, observe: 'response' });
  }
}
