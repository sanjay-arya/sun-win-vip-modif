import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ActivatedRoute } from '@angular/router';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { XocdiaJackpotRecordDetailComponent } from 'app/entities/xocdia-jackpot-record/xocdia-jackpot-record-detail.component';
import { XocdiaJackpotRecord } from 'app/shared/model/xocdia-jackpot-record.model';

describe('Component Tests', () => {
  describe('XocdiaJackpotRecord Management Detail Component', () => {
    let comp: XocdiaJackpotRecordDetailComponent;
    let fixture: ComponentFixture<XocdiaJackpotRecordDetailComponent>;
    const route = ({ data: of({ xocdiaJackpotRecord: new XocdiaJackpotRecord(123) }) } as any) as ActivatedRoute;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [XocdiaJackpotRecordDetailComponent],
        providers: [{ provide: ActivatedRoute, useValue: route }],
      })
        .overrideTemplate(XocdiaJackpotRecordDetailComponent, '')
        .compileComponents();
      fixture = TestBed.createComponent(XocdiaJackpotRecordDetailComponent);
      comp = fixture.componentInstance;
    });

    describe('OnInit', () => {
      it('Should load xocdiaJackpotRecord on init', () => {
        // WHEN
        comp.ngOnInit();

        // THEN
        expect(comp.xocdiaJackpotRecord).toEqual(jasmine.objectContaining({ id: 123 }));
      });
    });
  });
});
