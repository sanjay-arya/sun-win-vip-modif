import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ActivatedRoute } from '@angular/router';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { TxRankDetailComponent } from 'app/entities/tx-rank/tx-rank-detail.component';
import { TxRank } from 'app/shared/model/tx-rank.model';

describe('Component Tests', () => {
  describe('TxRank Management Detail Component', () => {
    let comp: TxRankDetailComponent;
    let fixture: ComponentFixture<TxRankDetailComponent>;
    const route = ({ data: of({ txRank: new TxRank(123) }) } as any) as ActivatedRoute;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [TxRankDetailComponent],
        providers: [{ provide: ActivatedRoute, useValue: route }],
      })
        .overrideTemplate(TxRankDetailComponent, '')
        .compileComponents();
      fixture = TestBed.createComponent(TxRankDetailComponent);
      comp = fixture.componentInstance;
    });

    describe('OnInit', () => {
      it('Should load txRank on init', () => {
        // WHEN
        comp.ngOnInit();

        // THEN
        expect(comp.txRank).toEqual(jasmine.objectContaining({ id: 123 }));
      });
    });
  });
});
