import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';

import { SERVER_API_URL } from 'app/app.constants';
import { createRequestOption } from 'app/shared/util/request-util';
import { IXocdiaJackpotRecord } from 'app/shared/model/xocdia-jackpot-record.model';

type EntityResponseType = HttpResponse<IXocdiaJackpotRecord>;
type EntityArrayResponseType = HttpResponse<IXocdiaJackpotRecord[]>;

@Injectable({ providedIn: 'root' })
export class XocdiaJackpotRecordService {
  public resourceUrl = SERVER_API_URL + 'api/jackpot/findall';

  constructor(protected http: HttpClient) {}

  create(xocdiaJackpotRecord: IXocdiaJackpotRecord): Observable<EntityResponseType> {
    return this.http.post<IXocdiaJackpotRecord>(this.resourceUrl, xocdiaJackpotRecord, { observe: 'response' });
  }

  update(xocdiaJackpotRecord: IXocdiaJackpotRecord): Observable<EntityResponseType> {
    return this.http.put<IXocdiaJackpotRecord>(this.resourceUrl, xocdiaJackpotRecord, { observe: 'response' });
  }

  find(id: number): Observable<EntityResponseType> {
    return this.http.get<IXocdiaJackpotRecord>(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }

  query(req?: any): Observable<EntityArrayResponseType> {
    const options = createRequestOption(req);
    return this.http.get<IXocdiaJackpotRecord[]>(this.resourceUrl, { params: options, observe: 'response' });
  }

  delete(id: number): Observable<HttpResponse<{}>> {
    return this.http.delete(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }
}
