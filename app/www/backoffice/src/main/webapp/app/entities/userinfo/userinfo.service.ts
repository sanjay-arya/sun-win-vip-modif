import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';

import { SERVER_API_URL } from 'app/app.constants';
import { createRequestOption } from 'app/shared/util/request-util';
import { IUserinfo } from 'app/shared/model/userinfo.model';

type EntityResponseType = HttpResponse<IUserinfo>;
type EntityArrayResponseType = HttpResponse<IUserinfo[]>;

@Injectable({ providedIn: 'root' })
export class UserinfoService {
  public resourceUrl = SERVER_API_URL + 'api/userinfos';

  constructor(protected http: HttpClient) {}

  find(id: number): Observable<EntityResponseType> {
    return this.http.get<IUserinfo>(`${this.resourceUrl}/${id}`, { observe: 'response' });
  }

  query(req?: any): Observable<EntityArrayResponseType> {
    const options = createRequestOption(req);
    return this.http.get<IUserinfo[]>(this.resourceUrl, { params: options, observe: 'response' });
  }
}
