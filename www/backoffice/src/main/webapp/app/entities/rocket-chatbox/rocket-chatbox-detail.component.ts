import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { IRocketChatbox } from 'app/shared/model/rocket-chatbox.model';

@Component({
  selector: 'jhi-rocket-chatbox-detail',
  templateUrl: './rocket-chatbox-detail.component.html',
})
export class RocketChatboxDetailComponent implements OnInit {
  rocketChatbox: IRocketChatbox | null = null;

  constructor(protected activatedRoute: ActivatedRoute) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ rocketChatbox }) => (this.rocketChatbox = rocketChatbox));
  }

  previousState(): void {
    window.history.back();
  }
}
