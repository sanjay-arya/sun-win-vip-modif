import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';

import { SERVER_API_URL } from 'app/app.constants';
import { createRequestOption } from 'app/shared/util/request-util';
import { IXocdiaRank } from 'app/shared/model/xocdia-rank.model';

type EntityResponseType = HttpResponse<IXocdiaRank>;
type EntityArrayResponseType = HttpResponse<IXocdiaRank[]>;

@Injectable({ providedIn: 'root' })
export class XocdiaRankService {
  public resourceUrl = SERVER_API_URL + 'api/tx-ranks';

  constructor(protected http: HttpClient) {}

  create(txRank: IXocdiaRank): Observable<EntityResponseType> {
    return this.http.post<IXocdiaRank>(`${this.resourceUrl}?type=3`, txRank, { observe: 'response' });
  }

  update(txRank: IXocdiaRank): Observable<EntityResponseType> {
    return this.http.put<IXocdiaRank>(`${this.resourceUrl}?type=3`, txRank, { observe: 'response' });
  }

  find(id: number): Observable<EntityResponseType> {
    return this.http.get<IXocdiaRank>(`${this.resourceUrl}/${id}?type=3`, { observe: 'response' });
  }

  query(req?: any): Observable<EntityArrayResponseType> {
    const options = createRequestOption(req);
    return this.http.get<IXocdiaRank[]>(`${this.resourceUrl}?type=3`, { params: options, observe: 'response' });
  }

  delete(id: number): Observable<HttpResponse<{}>> {
    return this.http.delete(`${this.resourceUrl}/${id}?type=3`, { observe: 'response' });
  }
}
