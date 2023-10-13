import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import * as moment from 'moment';

import { SERVER_API_URL } from 'app/app.constants';
import { createRequestOption } from 'app/shared/util/request-util';
import { ITaixiu } from 'app/shared/model/taixiu.model';

type EntityResponseType = HttpResponse<ITaixiu>;
type EntityArrayResponseType = HttpResponse<ITaixiu[]>;

@Injectable({ providedIn: 'root' })
export class TaixiuService {
  public resourceUrl = SERVER_API_URL + 'api/taixius';

  constructor(protected http: HttpClient) {}

  create(taixiu: ITaixiu): Observable<EntityResponseType> {
    const copy = this.convertDateFromClient(taixiu);
    return this.http
      .post<ITaixiu>(this.resourceUrl, copy, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  update(taixiu: ITaixiu): Observable<EntityResponseType> {
    const copy = this.convertDateFromClient(taixiu);
    return this.http
      .put<ITaixiu>(this.resourceUrl, copy, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  find(id: number): Observable<EntityResponseType> {
    return this.http
      .get<ITaixiu>(`${this.resourceUrl}/${id}`, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  query(req?: any): Observable<EntityArrayResponseType> {
    const options = createRequestOption(req);
    return this.http
      .get<ITaixiu[]>(this.resourceUrl, { params: options, observe: 'response' })
      .pipe(map((res: EntityArrayResponseType) => this.convertDateArrayFromServer(res)));
  }

  delete(id: number): Observable<HttpResponse<{}>> {
    return this.http.delete(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }

  protected convertDateFromClient(taixiu: ITaixiu): ITaixiu {
    const copy: ITaixiu = Object.assign({}, taixiu, {
      opentime: taixiu.opentime && taixiu.opentime.isValid() ? taixiu.opentime.toJSON() : undefined,
      endtime: taixiu.endtime && taixiu.endtime.isValid() ? taixiu.endtime.toJSON() : undefined,
    });
    return copy;
  }

  protected convertDateFromServer(res: EntityResponseType): EntityResponseType {
    if (res.body) {
      res.body.opentime = res.body.opentime ? moment(res.body.opentime) : undefined;
      res.body.endtime = res.body.endtime ? moment(res.body.endtime) : undefined;
    }
    return res;
  }

  protected convertDateArrayFromServer(res: EntityArrayResponseType): EntityArrayResponseType {
    if (res.body) {
      res.body.forEach((taixiu: ITaixiu) => {
        taixiu.opentime = taixiu.opentime ? moment(taixiu.opentime) : undefined;
        taixiu.endtime = taixiu.endtime ? moment(taixiu.endtime) : undefined;
      });
    }
    return res;
  }
}
