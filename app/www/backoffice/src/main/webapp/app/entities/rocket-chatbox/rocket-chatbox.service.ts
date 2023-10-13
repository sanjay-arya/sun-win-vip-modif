import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';

import { SERVER_API_URL } from 'app/app.constants';
import { createRequestOption } from 'app/shared/util/request-util';
import { IRocketChatbox } from 'app/shared/model/rocket-chatbox.model';

type EntityResponseType = HttpResponse<IRocketChatbox>;
type EntityArrayResponseType = HttpResponse<IRocketChatbox[]>;

@Injectable({ providedIn: 'root' })
export class RocketChatboxService {
  public resourceUrl = SERVER_API_URL + 'api/chatboxes';
  public resourceUrlQuery = SERVER_API_URL + 'api/chatboxv2/2';

  constructor(protected http: HttpClient) {}

  create(rocketChatbox: IRocketChatbox): Observable<EntityResponseType> {
    return this.http.post<IRocketChatbox>(this.resourceUrl, rocketChatbox, { observe: 'response' });
  }

  update(rocketChatbox: IRocketChatbox): Observable<EntityResponseType> {
    return this.http.put<IRocketChatbox>(this.resourceUrl, rocketChatbox, { observe: 'response' });
  }

  find(id: number): Observable<EntityResponseType> {
    return this.http.get<IRocketChatbox>(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }

  query(req?: any): Observable<EntityArrayResponseType> {
    const options = createRequestOption(req);
    return this.http.get<IRocketChatbox[]>(this.resourceUrlQuery, { params: options, observe: 'response' });
  }

  delete(id: number): Observable<HttpResponse<{}>> {
    return this.http.delete(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }
}
