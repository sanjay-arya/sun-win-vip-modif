import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ActivatedRoute } from '@angular/router';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { RocketRateDetailComponent } from 'app/entities/rocket-rate/rocket-rate-detail.component';
import { RocketRate } from 'app/shared/model/rocket-rate.model';

describe('Component Tests', () => {
  describe('RocketRate Management Detail Component', () => {
    let comp: RocketRateDetailComponent;
    let fixture: ComponentFixture<RocketRateDetailComponent>;
    const route = ({ data: of({ rocketRate: new RocketRate(123) }) } as any) as ActivatedRoute;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [RocketRateDetailComponent],
        providers: [{ provide: ActivatedRoute, useValue: route }],
      })
        .overrideTemplate(RocketRateDetailComponent, '')
        .compileComponents();
      fixture = TestBed.createComponent(RocketRateDetailComponent);
      comp = fixture.componentInstance;
    });

    describe('OnInit', () => {
      it('Should load rocketRate on init', () => {
        // WHEN
        comp.ngOnInit();

        // THEN
        expect(comp.rocketRate).toEqual(jasmine.objectContaining({ id: 123 }));
      });
    });
  });
});
