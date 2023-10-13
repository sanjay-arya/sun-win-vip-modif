import { Component, OnInit, OnDestroy } from '@angular/core';
import { HttpHeaders, HttpResponse } from '@angular/common/http';
import { Subscription } from 'rxjs';
import { JhiEventManager, JhiParseLinks } from 'ng-jhipster';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

import { IRocketChatbox } from 'app/shared/model/rocket-chatbox.model';

import { ITEMS_PER_PAGE } from 'app/shared/constants/pagination.constants';
import { RocketChatboxService } from './rocket-chatbox.service';
import { RocketChatboxDeleteDialogComponent } from './rocket-chatbox-delete-dialog.component';

@Component({
  selector: 'jhi-rocket-chatbox',
  templateUrl: './rocket-chatbox.component.html',
})
export class RocketChatboxComponent implements OnInit, OnDestroy {
  rocketChatboxes: IRocketChatbox[];
  eventSubscriber?: Subscription;
  itemsPerPage: number;
  links: any;
  page: number;
  predicate: string;
  ascending: boolean;

  constructor(
    protected rocketChatboxService: RocketChatboxService,
    protected eventManager: JhiEventManager,
    protected modalService: NgbModal,
    protected parseLinks: JhiParseLinks
  ) {
    this.rocketChatboxes = [];
    this.itemsPerPage = ITEMS_PER_PAGE;
    this.page = 0;
    this.links = {
      last: 0,
    };
    this.predicate = 'id';
    this.ascending = false;
  }

  loadAll(): void {
    this.rocketChatboxService
      .query({
        page: this.page,
        size: this.itemsPerPage,
        sort: this.sort(),
      })
      .subscribe((res: HttpResponse<IRocketChatbox[]>) => this.paginateRocketChatboxes(res.body, res.headers));
  }

  reset(): void {
    this.page = 0;
    this.rocketChatboxes = [];
    this.loadAll();
  }

  loadPage(page: number): void {
    this.page = page;
    this.loadAll();
  }

  ngOnInit(): void {
    this.loadAll();
    this.registerChangeInRocketChatboxes();
  }

  ngOnDestroy(): void {
    if (this.eventSubscriber) {
      this.eventManager.destroy(this.eventSubscriber);
    }
  }

  trackId(index: number, item: IRocketChatbox): number {
    // eslint-disable-next-line @typescript-eslint/no-unnecessary-type-assertion
    return item.id!;
  }

  registerChangeInRocketChatboxes(): void {
    this.eventSubscriber = this.eventManager.subscribe('rocketChatboxListModification', () => this.reset());
  }

  delete(rocketChatbox: IRocketChatbox): void {
    const modalRef = this.modalService.open(RocketChatboxDeleteDialogComponent, { size: 'lg', backdrop: 'static' });
    modalRef.componentInstance.rocketChatbox = rocketChatbox;
  }

  sort(): string[] {
    const result = [this.predicate + ',' + (this.ascending ? 'asc' : 'desc')];
    if (this.predicate !== 'id') {
      result.push('id');
    }
    return result;
  }

  protected paginateRocketChatboxes(data: IRocketChatbox[] | null, headers: HttpHeaders): void {
    const headersLink = headers.get('link');
    this.links = this.parseLinks.parse(headersLink ? headersLink : '');
    if (data) {
      for (let i = 0; i < data.length; i++) {
        this.rocketChatboxes.push(data[i]);
      }
    }
  }
}
