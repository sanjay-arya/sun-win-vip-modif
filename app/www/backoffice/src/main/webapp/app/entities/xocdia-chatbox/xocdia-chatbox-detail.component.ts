import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { IXocdiaChatbox } from 'app/shared/model/xocdia-chatbox.model';

@Component({
  selector: 'jhi-xocdia-chatbox-detail',
  templateUrl: './xocdia-chatbox-detail.component.html',
})
export class XocdiaChatboxDetailComponent implements OnInit {
  xocdiaChatbox: IXocdiaChatbox | null = null;

  constructor(protected activatedRoute: ActivatedRoute) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ xocdiaChatbox }) => (this.xocdiaChatbox = xocdiaChatbox));
  }

  previousState(): void {
    window.history.back();
  }
}
