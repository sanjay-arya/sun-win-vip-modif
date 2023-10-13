import { Component, OnInit, OnDestroy } from '@angular/core';
import { HttpHeaders, HttpResponse } from '@angular/common/http';
import { Subscription } from 'rxjs';
import { JhiEventManager, JhiParseLinks } from 'ng-jhipster';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

import { IChatbox } from 'app/shared/model/chatbox.model';

import { ITEMS_PER_PAGE } from 'app/shared/constants/pagination.constants';
import { ChatboxService } from './chatbox.service';
import { ChatboxDeleteDialogComponent } from './chatbox-delete-dialog.component';

@Component({
  selector: 'jhi-chatbox',
  templateUrl: './chatbox.component.html',
})
export class ChatboxComponent implements OnInit, OnDestroy {
  chatboxes: IChatbox[];
  eventSubscriber?: Subscription;
  itemsPerPage: number;
  links: any;
  page: number;
  predicate: string;
  ascending: boolean;

  constructor(
    protected chatboxService: ChatboxService,
    protected eventManager: JhiEventManager,
    protected modalService: NgbModal,
    protected parseLinks: JhiParseLinks
  ) {
    this.chatboxes = [];
    this.itemsPerPage = ITEMS_PER_PAGE;
    this.page = 0;
    this.links = {
      last: 0,
    };
    this.predicate = 'id';
    this.ascending = false;
  }

  loadAll(): void {
    this.chatboxService
      .query({
        page: this.page,
        size: this.itemsPerPage,
        sort: this.sort(),
      })
      .subscribe((res: HttpResponse<IChatbox[]>) => this.paginateChatboxes(res.body, res.headers));
  }

  reset(): void {
    this.page = 0;
    this.chatboxes = [];
    this.loadAll();
  }

  loadPage(page: number): void {
    this.page = page;
    this.loadAll();
  }

  ngOnInit(): void {
    this.loadAll();
    this.registerChangeInChatboxes();
  }

  ngOnDestroy(): void {
    if (this.eventSubscriber) {
      this.eventManager.destroy(this.eventSubscriber);
    }
  }

  trackId(index: number, item: IChatbox): number {
    // eslint-disable-next-line @typescript-eslint/no-unnecessary-type-assertion
    return item.id!;
  }

  registerChangeInChatboxes(): void {
    this.eventSubscriber = this.eventManager.subscribe('chatboxListModification', () => this.reset());
  }

  delete(chatbox: IChatbox): void {
    const modalRef = this.modalService.open(ChatboxDeleteDialogComponent, { size: 'lg', backdrop: 'static' });
    modalRef.componentInstance.chatbox = chatbox;
  }

  sort(): string[] {
    const result = [this.predicate + ',' + (this.ascending ? 'asc' : 'desc')];
    if (this.predicate !== 'id') {
      result.push('id');
    }
    return result;
  }

  protected paginateChatboxes(data: IChatbox[] | null, headers: HttpHeaders): void {
    const headersLink = headers.get('link');
    this.links = this.parseLinks.parse(headersLink ? headersLink : '');
    if (data) {
      for (let i = 0; i < data.length; i++) {
        this.chatboxes.push(data[i]);
      }
    }
  }
}
