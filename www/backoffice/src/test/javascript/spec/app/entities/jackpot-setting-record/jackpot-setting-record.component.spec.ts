import { ComponentFixture, TestBed } from '@angular/core/testing';
import { of } from 'rxjs';
import { HttpHeaders, HttpResponse } from '@angular/common/http';
import { ActivatedRoute, convertToParamMap } from '@angular/router';

import { TaixiucbTestModule } from '../../../test.module';
import { JackpotSettingRecordComponent } from 'app/entities/jackpot-setting-record/jackpot-setting-record.component';
import { JackpotSettingRecordService } from 'app/entities/jackpot-setting-record/jackpot-setting-record.service';
import { JackpotSettingRecord } from 'app/shared/model/jackpot-setting-record.model';

describe('Component Tests', () => {
  describe('JackpotSettingRecord Management Component', () => {
    let comp: JackpotSettingRecordComponent;
    let fixture: ComponentFixture<JackpotSettingRecordComponent>;
    let service: JackpotSettingRecordService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [JackpotSettingRecordComponent],
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
        .overrideTemplate(JackpotSettingRecordComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(JackpotSettingRecordComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(JackpotSettingRecordService);
    });

    it('Should call load all on init', () => {
      // GIVEN
      const headers = new HttpHeaders().append('link', 'link;link');
      spyOn(service, 'query').and.returnValue(
        of(
          new HttpResponse({
            body: [new JackpotSettingRecord(123)],
            headers,
          })
        )
      );

      // WHEN
      comp.ngOnInit();

      // THEN
      expect(service.query).toHaveBeenCalled();
      expect(comp.jackpotSettingRecords && comp.jackpotSettingRecords[0]).toEqual(jasmine.objectContaining({ id: 123 }));
    });

    it('should load a page', () => {
      // GIVEN
      const headers = new HttpHeaders().append('link', 'link;link');
      spyOn(service, 'query').and.returnValue(
        of(
          new HttpResponse({
            body: [new JackpotSettingRecord(123)],
            headers,
          })
        )
      );

      // WHEN
      comp.loadPage(1);

      // THEN
      expect(service.query).toHaveBeenCalled();
      expect(comp.jackpotSettingRecords && comp.jackpotSettingRecords[0]).toEqual(jasmine.objectContaining({ id: 123 }));
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
