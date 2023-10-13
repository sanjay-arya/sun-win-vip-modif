import { Component, OnInit } from '@angular/core';
import { SERVER_API_URL } from '../../app.constants';

@Component({
  selector: 'jhi-docs',
  templateUrl: './docs.component.html',
  styleUrls: ['docs.scss'],
})
export class DocsComponent implements OnInit {
  ngOnInit(): void {
    // eslint-disable-next-line @typescript-eslint/ban-ts-ignore
    // @ts-ignore
    const swaggerIframe = document.getElementById('swagger-iframe').contentWindow;
    swaggerIframe.serveApi = SERVER_API_URL;
  }
}
