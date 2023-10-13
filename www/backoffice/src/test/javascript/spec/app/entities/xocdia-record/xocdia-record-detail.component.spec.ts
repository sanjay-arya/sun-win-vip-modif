import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ActivatedRoute } from '@angular/router';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { XocdiaRecordDetailComponent } from 'app/entities/xocdia-record/xocdia-record-detail.component';
import { XocdiaRecord } from 'app/shared/model/xocdia-record.model';

describe('Component Tests', () => {
  describe('XocdiaRecord Management Detail Component', () => {
    let comp: XocdiaRecordDetailComponent;
    let fixture: ComponentFixture<XocdiaRecordDetailComponent>;
    const route = ({ data: of({ xocdiaRecord: new XocdiaRecord(123) }) } as any) as ActivatedRoute;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [XocdiaRecordDetailComponent],
        providers: [{ provide: ActivatedRoute, useValue: route }],
      })
        .overrideTemplate(XocdiaRecordDetailComponent, '')
        .compileComponents();
      fixture = TestBed.createComponent(XocdiaRecordDetailComponent);
      comp = fixture.componentInstance;
    });

    describe('OnInit', () => {
      it('Should load xocdiaRecord on init', () => {
        // WHEN
        comp.ngOnInit();

        // THEN
        expect(comp.xocdiaRecord).toEqual(jasmine.objectContaining({ id: 123 }));
      });
    });
  });
});
