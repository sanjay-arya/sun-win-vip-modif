import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';

import { SERVER_API_URL } from 'app/app.constants';
import { createRequestOption } from 'app/shared/util/request-util';
import { IChatbox } from 'app/shared/model/chatbox.model';

type EntityResponseType = HttpResponse<IChatbox>;
type EntityArrayResponseType = HttpResponse<IChatbox[]>;

@Injectable({ providedIn: 'root' })
export class ChatboxService {
  public resourceUrl = SERVER_API_URL + 'api/chatboxes';
  public resourceUrlQuery = SERVER_API_URL + 'api/chatboxv2/1';

  constructor(protected http: HttpClient) {}

  create(chatbox: IChatbox): Observable<EntityResponseType> {
    return this.http.post<IChatbox>(this.resourceUrl, chatbox, { observe: 'response' });
  }

  update(chatbox: IChatbox): Observable<EntityResponseType> {
    return this.http.put<IChatbox>(this.resourceUrl, chatbox, { observe: 'response' });
  }

  find(id: number): Observable<EntityResponseType> {
    return this.http.get<IChatbox>(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }

  query(req?: any): Observable<EntityArrayResponseType> {
    const options = createRequestOption(req);
    return this.http.get<IChatbox[]>(this.resourceUrlQuery, { params: options, observe: 'response' });
  }

  delete(id: number): Observable<HttpResponse<{}>> {
    return this.http.delete(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }
}
