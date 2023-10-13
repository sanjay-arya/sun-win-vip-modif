import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { IXocdia } from 'app/shared/model/xocdia.model';

@Component({
  selector: 'jhi-xocdia-detail',
  templateUrl: './xocdia-detail.component.html',
})
export class XocdiaDetailComponent implements OnInit {
  xocdia: IXocdia | null = null;

  constructor(protected activatedRoute: ActivatedRoute) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ xocdia }) => (this.xocdia = xocdia));
  }

  previousState(): void {
    window.history.back();
  }
}
