import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { ITransferHistory } from 'app/shared/model/transfer-history.model';

@Component({
  selector: 'jhi-transfer-history-detail',
  templateUrl: './transfer-history-detail.component.html',
})
export class TransferHistoryDetailComponent implements OnInit {
  transferHistory: ITransferHistory | null = null;

  constructor(protected activatedRoute: ActivatedRoute) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ transferHistory }) => (this.transferHistory = transferHistory));
  }

  previousState(): void {
    window.history.back();
  }
}
