import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ActivatedRoute } from '@angular/router';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { XocdiaRankDetailComponent } from 'app/entities/xocdia-rank/xocdia-rank-detail.component';
import { XocdiaRank } from 'app/shared/model/xocdia-rank.model';

describe('Component Tests', () => {
  describe('XocdiaRank Management Detail Component', () => {
    let comp: XocdiaRankDetailComponent;
    let fixture: ComponentFixture<XocdiaRankDetailComponent>;
    const route = ({ data: of({ xocdiaRank: new XocdiaRank(123) }) } as any) as ActivatedRoute;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [XocdiaRankDetailComponent],
        providers: [{ provide: ActivatedRoute, useValue: route }],
      })
        .overrideTemplate(XocdiaRankDetailComponent, '')
        .compileComponents();
      fixture = TestBed.createComponent(XocdiaRankDetailComponent);
      comp = fixture.componentInstance;
    });

    describe('OnInit', () => {
      it('Should load xocdiaRank on init', () => {
        // WHEN
        comp.ngOnInit();

        // THEN
        expect(comp.xocdiaRank).toEqual(jasmine.objectContaining({ id: 123 }));
      });
    });
  });
});
