import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';

import { SERVER_API_URL } from 'app/app.constants';
import { createRequestOption } from 'app/shared/util/request-util';
import { IRocketRate } from 'app/shared/model/rocket-rate.model';

type EntityResponseType = HttpResponse<IRocketRate>;
type EntityArrayResponseType = HttpResponse<IRocketRate[]>;

@Injectable({ providedIn: 'root' })
export class RocketRateService {
  public resourceUrl = SERVER_API_URL + 'api/rocket-rates';

  constructor(protected http: HttpClient) {}

  create(rocketRate: IRocketRate): Observable<EntityResponseType> {
    return this.http.post<IRocketRate>(this.resourceUrl, rocketRate, { observe: 'response' });
  }

  update(rocketRate: IRocketRate): Observable<EntityResponseType> {
    return this.http.put<IRocketRate>(this.resourceUrl, rocketRate, { observe: 'response' });
  }

  find(id: number): Observable<EntityResponseType> {
    return this.http.get<IRocketRate>(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }

  query(req?: any): Observable<EntityArrayResponseType> {
    const options = createRequestOption(req);
    return this.http.get<IRocketRate[]>(this.resourceUrl, { params: options, observe: 'response' });
  }

  delete(id: number): Observable<HttpResponse<{}>> {
    return this.http.delete(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }
}
