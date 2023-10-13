import { Component, OnInit, OnDestroy } from '@angular/core';
import { HttpHeaders, HttpResponse } from '@angular/common/http';
import { Subscription } from 'rxjs';
import { JhiEventManager, JhiParseLinks } from 'ng-jhipster';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

import { IXocdiaChatbox } from 'app/shared/model/xocdia-chatbox.model';

import { ITEMS_PER_PAGE } from 'app/shared/constants/pagination.constants';
import { XocdiaChatboxService } from './xocdia-chatbox.service';
import { XocdiaChatboxDeleteDialogComponent } from './xocdia-chatbox-delete-dialog.component';

@Component({
  selector: 'jhi-xocdia-chatbox',
  templateUrl: './xocdia-chatbox.component.html',
})
export class XocdiaChatboxComponent implements OnInit, OnDestroy {
  xocdiaChatboxes: IXocdiaChatbox[];
  eventSubscriber?: Subscription;
  itemsPerPage: number;
  links: any;
  page: number;
  predicate: string;
  ascending: boolean;

  constructor(
    protected xocdiaChatboxService: XocdiaChatboxService,
    protected eventManager: JhiEventManager,
    protected modalService: NgbModal,
    protected parseLinks: JhiParseLinks
  ) {
    this.xocdiaChatboxes = [];
    this.itemsPerPage = ITEMS_PER_PAGE;
    this.page = 0;
    this.links = {
      last: 0,
    };
    this.predicate = 'id';
    this.ascending = false;
  }

  loadAll(): void {
    this.xocdiaChatboxService
      .query({
        page: this.page,
        size: this.itemsPerPage,
        sort: this.sort(),
      })
      .subscribe((res: HttpResponse<IXocdiaChatbox[]>) => this.paginateXocdiaChatboxes(res.body, res.headers));
  }

  reset(): void {
    this.page = 0;
    this.xocdiaChatboxes = [];
    this.loadAll();
  }

  loadPage(page: number): void {
    this.page = page;
    this.loadAll();
  }

  ngOnInit(): void {
    this.loadAll();
    this.registerChangeInXocdiaChatboxes();
  }

  ngOnDestroy(): void {
    if (this.eventSubscriber) {
      this.eventManager.destroy(this.eventSubscriber);
    }
  }

  trackId(index: number, item: IXocdiaChatbox): number {
    // eslint-disable-next-line @typescript-eslint/no-unnecessary-type-assertion
    return item.id!;
  }

  registerChangeInXocdiaChatboxes(): void {
    this.eventSubscriber = this.eventManager.subscribe('xocdiaChatboxListModification', () => this.reset());
  }

  delete(xocdiaChatbox: IXocdiaChatbox): void {
    const modalRef = this.modalService.open(XocdiaChatboxDeleteDialogComponent, { size: 'lg', backdrop: 'static' });
    modalRef.componentInstance.xocdiaChatbox = xocdiaChatbox;
  }

  sort(): string[] {
    const result = [this.predicate + ',' + (this.ascending ? 'asc' : 'desc')];
    if (this.predicate !== 'id') {
      result.push('id');
    }
    return result;
  }

  protected paginateXocdiaChatboxes(data: IXocdiaChatbox[] | null, headers: HttpHeaders): void {
    const headersLink = headers.get('link');
    this.links = this.parseLinks.parse(headersLink ? headersLink : '');
    if (data) {
      for (let i = 0; i < data.length; i++) {
        this.xocdiaChatboxes.push(data[i]);
      }
    }
  }
}
