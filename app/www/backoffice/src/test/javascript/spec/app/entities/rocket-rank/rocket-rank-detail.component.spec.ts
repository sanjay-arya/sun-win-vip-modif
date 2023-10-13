import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ActivatedRoute } from '@angular/router';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { RocketRankDetailComponent } from 'app/entities/rocket-rank/rocket-rank-detail.component';
import { RocketRank } from 'app/shared/model/rocket-rank.model';

describe('Component Tests', () => {
  describe('RocketRank Management Detail Component', () => {
    let comp: RocketRankDetailComponent;
    let fixture: ComponentFixture<RocketRankDetailComponent>;
    const route = ({ data: of({ rocketRank: new RocketRank(123) }) } as any) as ActivatedRoute;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [RocketRankDetailComponent],
        providers: [{ provide: ActivatedRoute, useValue: route }],
      })
        .overrideTemplate(RocketRankDetailComponent, '')
        .compileComponents();
      fixture = TestBed.createComponent(RocketRankDetailComponent);
      comp = fixture.componentInstance;
    });

    describe('OnInit', () => {
      it('Should load rocketRank on init', () => {
        // WHEN
        comp.ngOnInit();

        // THEN
        expect(comp.rocketRank).toEqual(jasmine.objectContaining({ id: 123 }));
      });
    });
  });
});
