import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';

import { SERVER_API_URL } from 'app/app.constants';
import { createRequestOption } from 'app/shared/util/request-util';
import { IXocdiaChatbox } from 'app/shared/model/xocdia-chatbox.model';

type EntityResponseType = HttpResponse<IXocdiaChatbox>;
type EntityArrayResponseType = HttpResponse<IXocdiaChatbox[]>;

@Injectable({ providedIn: 'root' })
export class XocdiaChatboxService {
  public resourceUrl = SERVER_API_URL + 'api/chatboxes';
  public resourceUrlQuery = SERVER_API_URL + 'api/chatboxv2/3';

  constructor(protected http: HttpClient) {}

  create(chatbox: IXocdiaChatbox): Observable<EntityResponseType> {
    return this.http.post<IXocdiaChatbox>(this.resourceUrl, chatbox, { observe: 'response' });
  }

  update(chatbox: IXocdiaChatbox): Observable<EntityResponseType> {
    return this.http.put<IXocdiaChatbox>(this.resourceUrl, chatbox, { observe: 'response' });
  }

  find(id: number): Observable<EntityResponseType> {
    return this.http.get<IXocdiaChatbox>(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }

  query(req?: any): Observable<EntityArrayResponseType> {
    const options = createRequestOption(req);
    return this.http.get<IXocdiaChatbox[]>(this.resourceUrlQuery, { params: options, observe: 'response' });
  }

  delete(id: number): Observable<HttpResponse<{}>> {
    return this.http.delete(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }
}
