import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { IChatbox } from 'app/shared/model/chatbox.model';

@Component({
  selector: 'jhi-chatbox-detail',
  templateUrl: './chatbox-detail.component.html',
})
export class ChatboxDetailComponent implements OnInit {
  chatbox: IChatbox | null = null;

  constructor(protected activatedRoute: ActivatedRoute) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ chatbox }) => (this.chatbox = chatbox));
  }

  previousState(): void {
    window.history.back();
  }
}
