import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ActivatedRoute } from '@angular/router';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { ReportGameDetailComponent } from 'app/entities/report-game/report-game-detail.component';
import { ReportGame } from 'app/shared/model/report-game.model';

describe('Component Tests', () => {
  describe('ReportGame Management Detail Component', () => {
    let comp: ReportGameDetailComponent;
    let fixture: ComponentFixture<ReportGameDetailComponent>;
    const route = ({ data: of({ reportGame: new ReportGame(123) }) } as any) as ActivatedRoute;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [ReportGameDetailComponent],
        providers: [{ provide: ActivatedRoute, useValue: route }],
      })
        .overrideTemplate(ReportGameDetailComponent, '')
        .compileComponents();
      fixture = TestBed.createComponent(ReportGameDetailComponent);
      comp = fixture.componentInstance;
    });

    describe('OnInit', () => {
      it('Should load reportGame on init', () => {
        // WHEN
        comp.ngOnInit();

        // THEN
        expect(comp.reportGame).toEqual(jasmine.objectContaining({ id: 123 }));
      });
    });
  });
});
