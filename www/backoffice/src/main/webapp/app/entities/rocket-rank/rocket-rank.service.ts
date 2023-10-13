import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';

import { SERVER_API_URL } from 'app/app.constants';
import { createRequestOption } from 'app/shared/util/request-util';
import { IRocketRank } from 'app/shared/model/rocket-rank.model';

type EntityResponseType = HttpResponse<IRocketRank>;
type EntityArrayResponseType = HttpResponse<IRocketRank[]>;

@Injectable({ providedIn: 'root' })
export class RocketRankService {
  public resourceUrl = SERVER_API_URL + 'api/tx-ranks';

  constructor(protected http: HttpClient) {}

  create(rocketRank: IRocketRank): Observable<EntityResponseType> {
    return this.http.post<IRocketRank>(`${this.resourceUrl}?type=2`, rocketRank, { observe: 'response' });
  }

  update(rocketRank: IRocketRank): Observable<EntityResponseType> {
    return this.http.put<IRocketRank>(`${this.resourceUrl}?type=2`, rocketRank, { observe: 'response' });
  }

  find(id: number): Observable<EntityResponseType> {
    return this.http.get<IRocketRank>(`${this.resourceUrl}/${id}?type=2`, { observe: 'response' });
  }

  query(req?: any): Observable<EntityArrayResponseType> {
    const options = createRequestOption(req);
    return this.http.get<IRocketRank[]>(`${this.resourceUrl}?type=2`, { params: options, observe: 'response' });
  }

  delete(id: number): Observable<HttpResponse<{}>> {
    return this.http.delete(`${this.resourceUrl}/${id}?type=2`, { observe: 'response' });
  }
}
