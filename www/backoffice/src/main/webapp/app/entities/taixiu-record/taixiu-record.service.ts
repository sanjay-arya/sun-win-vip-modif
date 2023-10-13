import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import * as moment from 'moment';

import { SERVER_API_URL } from 'app/app.constants';
import { createRequestOption } from 'app/shared/util/request-util';
import { ITaixiuRecord } from 'app/shared/model/taixiu-record.model';

type EntityResponseType = HttpResponse<ITaixiuRecord>;
type EntityArrayResponseType = HttpResponse<ITaixiuRecord[]>;

@Injectable({ providedIn: 'root' })
export class TaixiuRecordService {
  public resourceUrl = SERVER_API_URL + 'api/taixiu-records';

  constructor(protected http: HttpClient) {}

  create(taixiuRecord: ITaixiuRecord): Observable<EntityResponseType> {
    const copy = this.convertDateFromClient(taixiuRecord);
    return this.http
      .post<ITaixiuRecord>(this.resourceUrl, copy, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  update(taixiuRecord: ITaixiuRecord): Observable<EntityResponseType> {
    const copy = this.convertDateFromClient(taixiuRecord);
    return this.http
      .put<ITaixiuRecord>(this.resourceUrl, copy, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  find(id: number): Observable<EntityResponseType> {
    return this.http
      .get<ITaixiuRecord>(`${this.resourceUrl}/${id}`, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  query(req?: any): Observable<EntityArrayResponseType> {
    
    const options = createRequestOption(req);
    return this.http
      .get<ITaixiuRecord[]>(this.resourceUrl, { params: options, observe: 'response' })
      .pipe(map((res: EntityArrayResponseType) => this.convertDateArrayFromServer(res)));
  }

  delete(id: number): Observable<HttpResponse<{}>> {
    return this.http.delete(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }

  protected convertDateFromClient(taixiuRecord: ITaixiuRecord): ITaixiuRecord {
    const copy: ITaixiuRecord = Object.assign({}, taixiuRecord, {
      bettime: taixiuRecord.bettime && taixiuRecord.bettime.isValid() ? taixiuRecord.bettime.toJSON() : undefined,
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
      res.body.forEach((taixiuRecord: ITaixiuRecord) => {
        taixiuRecord.bettime = taixiuRecord.bettime ? moment(taixiuRecord.bettime) : undefined;
      });
    }
    return res;
  }
}
