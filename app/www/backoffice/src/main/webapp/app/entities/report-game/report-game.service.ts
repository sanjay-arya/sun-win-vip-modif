import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import * as moment from 'moment';

import { DATE_FORMAT } from 'app/shared/constants/input.constants';
import { SERVER_API_URL } from 'app/app.constants';
import { createRequestOption } from 'app/shared/util/request-util';
import { IReportGame } from 'app/shared/model/report-game.model';

type EntityResponseType = HttpResponse<IReportGame>;
type EntityArrayResponseType = HttpResponse<IReportGame[]>;

@Injectable({ providedIn: 'root' })
export class ReportGameService {
  public resourceUrl = SERVER_API_URL + 'api/report-games';

  constructor(protected http: HttpClient) {}

  create(reportGame: IReportGame): Observable<EntityResponseType> {
    const copy = this.convertDateFromClient(reportGame);
    return this.http
      .post<IReportGame>(this.resourceUrl, copy, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  update(reportGame: IReportGame): Observable<EntityResponseType> {
    const copy = this.convertDateFromClient(reportGame);
    return this.http
      .put<IReportGame>(this.resourceUrl, copy, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  find(id: number): Observable<EntityResponseType> {
    return this.http
      .get<IReportGame>(`${this.resourceUrl}/${id}`, { observe: 'response' })
      .pipe(map((res: EntityResponseType) => this.convertDateFromServer(res)));
  }

  query(req?: any): Observable<EntityArrayResponseType> {
    const options = createRequestOption(req);
    return this.http
      .get<IReportGame[]>(this.resourceUrl, { params: options, observe: 'response' })
      .pipe(map((res: EntityArrayResponseType) => this.convertDateArrayFromServer(res)));
  }

  delete(id: number): Observable<HttpResponse<{}>> {
    return this.http.delete(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }

  protected convertDateFromClient(reportGame: IReportGame): IReportGame {
    const copy: IReportGame = Object.assign({}, reportGame, {
      rdate: reportGame.rdate && reportGame.rdate.isValid() ? reportGame.rdate.format(DATE_FORMAT) : undefined,
    });
    return copy;
  }

  protected convertDateFromServer(res: EntityResponseType): EntityResponseType {
    if (res.body) {
      res.body.rdate = res.body.rdate ? moment(res.body.rdate) : undefined;
    }
    return res;
  }

  protected convertDateArrayFromServer(res: EntityArrayResponseType): EntityArrayResponseType {
    if (res.body) {
      res.body.forEach((reportGame: IReportGame) => {
        reportGame.rdate = reportGame.rdate ? moment(reportGame.rdate) : undefined;
      });
    }
    return res;
  }
}
