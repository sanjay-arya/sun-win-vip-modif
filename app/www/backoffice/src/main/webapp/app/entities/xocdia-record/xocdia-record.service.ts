import { map } from 'rxjs/operators';
import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';

import { SERVER_API_URL } from 'app/app.constants';
import { createRequestOption } from 'app/shared/util/request-util';
import { IXocdiaRecord } from 'app/shared/model/xocdia-record.model';
// import { createRequestOption } from './../../shared/util/request-util';
// import { IXocdiaRecord } from './../../shared/model/xocdia-record.model';
// import { SERVER_API_URL } from './../../app.constants';

import * as moment from 'moment';

type EntityResponseType = HttpResponse<IXocdiaRecord>;
type EntityArrayResponseType = HttpResponse<IXocdiaRecord[]>;

@Injectable({ providedIn: 'root' })
export class XocdiaRecordService {
  public resourceUrl = SERVER_API_URL + 'api/xocdia-records';

  constructor(protected http: HttpClient) {}

  create(xocdiaRecord: IXocdiaRecord): Observable<EntityResponseType> {
    const copy = this.convertDateFromClient(xocdiaRecord);
    return this.http
      .post<IXocdiaRecord>(this.resourceUrl, copy, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  update(xocdiaRecord: IXocdiaRecord): Observable<EntityResponseType> {
    const copy = this.convertDateFromClient(xocdiaRecord);
    return this.http
      .put<IXocdiaRecord>(this.resourceUrl, copy, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  find(id: number): Observable<EntityResponseType> {
    return this.http
      .get<IXocdiaRecord>(`${this.resourceUrl}/${id}`, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  query(req?: any): Observable<EntityArrayResponseType> {
    const options = createRequestOption(req);
    return this.http
      .get<IXocdiaRecord[]>(this.resourceUrl, { params: options, observe: 'response' })
      .pipe(map((res: EntityArrayResponseType) => this.convertDateArrayFromServer(res)));
  }

  delete(id: number): Observable<HttpResponse<{}>> {
    return this.http.delete(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }

  protected convertDateFromClient(xocdiaRecord: IXocdiaRecord): IXocdiaRecord {
    const copy: IXocdiaRecord = Object.assign({}, xocdiaRecord, {
      bettime: xocdiaRecord.bettime && xocdiaRecord.bettime.isValid() ? xocdiaRecord.bettime.toJSON() : undefined,
    });
    return copy;
  }

  protected convertDateFromServer(res: EntityResponseType): EntityResponseType {
    if (res.body) {
      res.body.bettime = res.body.bettime ? moment(res.body.bettime) : undefined;
    }
    return res;
  }

  protected convertDateArrayFromServer(res: EntityArrayResponseType): EntityArrayResponseType {
    if (res.body) {
      res.body.forEach((xocdiaRecord: IXocdiaRecord) => {
        xocdiaRecord.bettime = xocdiaRecord.bettime ? moment(xocdiaRecord.bettime) : undefined;
      });
    }
    return res;
  }
}
