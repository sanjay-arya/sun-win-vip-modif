import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import * as moment from 'moment';

import { SERVER_API_URL } from 'app/app.constants';
import { createRequestOption } from 'app/shared/util/request-util';
import { IRocket } from 'app/shared/model/rocket.model';

type EntityResponseType = HttpResponse<IRocket>;
type EntityArrayResponseType = HttpResponse<IRocket[]>;

@Injectable({ providedIn: 'root' })
export class RocketService {
  public resourceUrl = SERVER_API_URL + 'api/rockets';

  constructor(protected http: HttpClient) {}

  create(rocket: IRocket): Observable<EntityResponseType> {
    const copy = this.convertDateFromClient(rocket);
    return this.http
      .post<IRocket>(this.resourceUrl, copy, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  update(rocket: IRocket): Observable<EntityResponseType> {
    const copy = this.convertDateFromClient(rocket);
    return this.http
      .put<IRocket>(this.resourceUrl, copy, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  find(id: number): Observable<EntityResponseType> {
    return this.http
      .get<IRocket>(`${this.resourceUrl}/${id}`, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  query(req?: any): Observable<EntityArrayResponseType> {
    const options = createRequestOption(req);
    return this.http
      .get<IRocket[]>(this.resourceUrl, { params: options, observe: 'response' })
      .pipe(map((res: EntityArrayResponseType) => this.convertDateArrayFromServer(res)));
  }

  delete(id: number): Observable<HttpResponse<{}>> {
    return this.http.delete(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }

  protected convertDateFromClient(rocket: IRocket): IRocket {
    const copy: IRocket = Object.assign({}, rocket, {
      opentime: rocket.opentime && rocket.opentime.isValid() ? rocket.opentime.toJSON() : undefined,
      endtime: rocket.endtime && rocket.endtime.isValid() ? rocket.endtime.toJSON() : undefined,
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
      res.body.forEach((rocket: IRocket) => {
        rocket.opentime = rocket.opentime ? moment(rocket.opentime) : undefined;
        rocket.endtime = rocket.endtime ? moment(rocket.endtime) : undefined;
      });
    }
    return res;
  }
}
