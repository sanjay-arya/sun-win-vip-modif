import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';

import { SERVER_API_URL } from 'app/app.constants';
import { createRequestOption } from 'app/shared/util/request-util';
import { ITxRank } from 'app/shared/model/tx-rank.model';

type EntityResponseType = HttpResponse<ITxRank>;
type EntityArrayResponseType = HttpResponse<ITxRank[]>;

@Injectable({ providedIn: 'root' })
export class TxRankService {
  public resourceUrl = SERVER_API_URL + 'api/tx-ranks';

  constructor(protected http: HttpClient) {}

  create(txRank: ITxRank): Observable<EntityResponseType> {
    return this.http.post<ITxRank>(`${this.resourceUrl}?type=1`, txRank, { observe: 'response' });
  }

  update(txRank: ITxRank): Observable<EntityResponseType> {
    return this.http.put<ITxRank>(`${this.resourceUrl}?type=1`, txRank, { observe: 'response' });
  }

  find(id: number): Observable<EntityResponseType> {
    return this.http.get<ITxRank>(`${this.resourceUrl}/${id}?type=1`, { observe: 'response' });
  }

  query(req?: any): Observable<EntityArrayResponseType> {
    const options = createRequestOption(req);
    return this.http.get<ITxRank[]>(`${this.resourceUrl}?type=1`, { params: options, observe: 'response' });
  }

  delete(id: number): Observable<HttpResponse<{}>> {
    return this.http.delete(`${this.resourceUrl}/${id}?type=1`, { observe: 'response' });
  }
}
