import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { ITxRank } from 'app/shared/model/tx-rank.model';

@Component({
  selector: 'jhi-tx-rank-detail',
  templateUrl: './tx-rank-detail.component.html',
})
export class TxRankDetailComponent implements OnInit {
  txRank: ITxRank | null = null;

  constructor(protected activatedRoute: ActivatedRoute) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ txRank }) => (this.txRank = txRank));
  }

  previousState(): void {
    window.history.back();
  }
}
