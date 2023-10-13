import { ComponentFixture, TestBed } from '@angular/core/testing';
import { of } from 'rxjs';
import { HttpHeaders, HttpResponse } from '@angular/common/http';

import { TaixiucbTestModule } from '../../../test.module';
import { RocketRankComponent } from 'app/entities/rocket-rank/rocket-rank.component';
import { RocketRankService } from 'app/entities/rocket-rank/rocket-rank.service';
import { RocketRank } from 'app/shared/model/rocket-rank.model';

describe('Component Tests', () => {
  describe('RocketRank Management Component', () => {
    let comp: RocketRankComponent;
    let fixture: ComponentFixture<RocketRankComponent>;
    let service: RocketRankService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [RocketRankComponent],
      })
        .overrideTemplate(RocketRankComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(RocketRankComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(RocketRankService);
    });

    it('Should call load all on init', () => {
      // GIVEN
      const headers = new HttpHeaders().append('link', 'link;link');
      spyOn(service, 'query').and.returnValue(
        of(
          new HttpResponse({
            body: [new RocketRank(123)],
            headers,
          })
        )
      );

      // WHEN
      comp.ngOnInit();

      // THEN
      expect(service.query).toHaveBeenCalled();
      expect(comp.rocketRanks && comp.rocketRanks[0]).toEqual(jasmine.objectContaining({ id: 123 }));
    });
  });
});
