import { ComponentFixture, TestBed } from '@angular/core/testing';
import { of } from 'rxjs';
import { HttpHeaders, HttpResponse } from '@angular/common/http';
import { ActivatedRoute, convertToParamMap } from '@angular/router';

import { TaixiucbTestModule } from '../../../test.module';
import { XocdiaJackpotRecordComponent } from 'app/entities/xocdia-jackpot-record/xocdia-jackpot-record.component';
import { XocdiaJackpotRecordService } from 'app/entities/xocdia-jackpot-record/xocdia-jackpot-record.service';
import { XocdiaJackpotRecord } from 'app/shared/model/xocdia-jackpot-record.model';

describe('Component Tests', () => {
  describe('XocdiaJackpotRecord Management Component', () => {
    let comp: XocdiaJackpotRecordComponent;
    let fixture: ComponentFixture<XocdiaJackpotRecordComponent>;
    let service: XocdiaJackpotRecordService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [XocdiaJackpotRecordComponent],
        providers: [
          {
            provide: ActivatedRoute,
            useValue: {
              data: of({
                defaultSort: 'id,asc',
              }),
              queryParamMap: of(
                convertToParamMap({
                  page: '1',
                  size: '1',
                  sort: 'id,desc',
                })
              ),
            },
          },
        ],
      })
        .overrideTemplate(XocdiaJackpotRecordComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(XocdiaJackpotRecordComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(XocdiaJackpotRecordService);
    });

    it('Should call load all on init', () => {
      // GIVEN
      const headers = new HttpHeaders().append('link', 'link;link');
      spyOn(service, 'query').and.returnValue(
        of(
          new HttpResponse({
            body: [new XocdiaJackpotRecord(123)],
            headers,
          })
        )
      );

      // WHEN
      comp.ngOnInit();

      // THEN
      expect(service.query).toHaveBeenCalled();
      expect(comp.xocdiaJackpotRecords && comp.xocdiaJackpotRecords[0]).toEqual(jasmine.objectContaining({ id: 123 }));
    });

    it('should load a page', () => {
      // GIVEN
      const headers = new HttpHeaders().append('link', 'link;link');
      spyOn(service, 'query').and.returnValue(
        of(
          new HttpResponse({
            body: [new XocdiaJackpotRecord(123)],
            headers,
          })
        )
      );

      // WHEN
      comp.loadPage(1);

      // THEN
      expect(service.query).toHaveBeenCalled();
      expect(comp.xocdiaJackpotRecords && comp.xocdiaJackpotRecords[0]).toEqual(jasmine.objectContaining({ id: 123 }));
    });

    it('should calculate the sort attribute for an id', () => {
      // WHEN
      comp.ngOnInit();
      const result = comp.sort();

      // THEN
      expect(result).toEqual(['id,desc']);
    });

    it('should calculate the sort attribute for a non-id attribute', () => {
      // INIT
      comp.ngOnInit();

      // GIVEN
      comp.predicate = 'name';

      // WHEN
      const result = comp.sort();

      // THEN
      expect(result).toEqual(['name,desc', 'id']);
    });
  });
});
