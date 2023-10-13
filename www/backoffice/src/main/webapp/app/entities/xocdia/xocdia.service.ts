import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';

import { SERVER_API_URL } from 'app/app.constants';
import { createRequestOption } from 'app/shared/util/request-util';
import { IXocdia } from 'app/shared/model/xocdia.model';
import { map } from 'rxjs/operators';
import * as moment from 'moment';

type EntityResponseType = HttpResponse<IXocdia>;
type EntityArrayResponseType = HttpResponse<IXocdia[]>;

@Injectable({ providedIn: 'root' })
export class XocdiaService {
  public resourceUrl = SERVER_API_URL + 'api/xocdias';

  constructor(protected http: HttpClient) {}

  create(xocdia: IXocdia): Observable<EntityResponseType> {
    const copy = this.convertDateFromClient(xocdia);
    return this.http
      .post<IXocdia>(this.resourceUrl, copy, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  update(xocdia: IXocdia): Observable<EntityResponseType> {
    const copy = this.convertDateFromClient(xocdia);
    return this.http
      .put<IXocdia>(this.resourceUrl, copy, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  find(id: number): Observable<EntityResponseType> {
    return this.http
      .get<IXocdia>(`${this.resourceUrl}/${id}`, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  query(req?: any): Observable<EntityArrayResponseType> {
    const options = createRequestOption(req);
    return this.http
      .get<IXocdia[]>(this.resourceUrl, { params: options, observe: 'response' })
      .pipe(map((res: EntityArrayResponseType) => this.convertDateArrayFromServer(res)));
  }

  delete(id: number): Observable<HttpResponse<{}>> {
    return this.http.delete(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }

  protected convertDateFromClient(xocdia: IXocdia): IXocdia {
    const copy: IXocdia = Object.assign({}, xocdia, {
      opentime: xocdia.opentime && xocdia.opentime.isValid() ? xocdia.opentime.toJSON() : undefined,
      endtime: xocdia.endtime && xocdia.endtime.isValid() ? xocdia.endtime.toJSON() : undefined,
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
      res.body.forEach((xocdia: IXocdia) => {
        xocdia.opentime = xocdia.opentime ? moment(xocdia.opentime) : undefined;
        xocdia.endtime = xocdia.endtime ? moment(xocdia.endtime) : undefined;
      });
    }
    return res;
  }
}
