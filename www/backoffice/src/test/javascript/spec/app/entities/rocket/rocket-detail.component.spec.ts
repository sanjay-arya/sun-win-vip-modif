import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ActivatedRoute } from '@angular/router';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { RocketDetailComponent } from 'app/entities/rocket/rocket-detail.component';
import { Rocket } from 'app/shared/model/rocket.model';

describe('Component Tests', () => {
  describe('Rocket Management Detail Component', () => {
    let comp: RocketDetailComponent;
    let fixture: ComponentFixture<RocketDetailComponent>;
    const route = ({ data: of({ rocket: new Rocket(123) }) } as any) as ActivatedRoute;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [RocketDetailComponent],
        providers: [{ provide: ActivatedRoute, useValue: route }],
      })
        .overrideTemplate(RocketDetailComponent, '')
        .compileComponents();
      fixture = TestBed.createComponent(RocketDetailComponent);
      comp = fixture.componentInstance;
    });

    describe('OnInit', () => {
      it('Should load rocket on init', () => {
        // WHEN
        comp.ngOnInit();

        // THEN
        expect(comp.rocket).toEqual(jasmine.objectContaining({ id: 123 }));
      });
    });
  });
});
