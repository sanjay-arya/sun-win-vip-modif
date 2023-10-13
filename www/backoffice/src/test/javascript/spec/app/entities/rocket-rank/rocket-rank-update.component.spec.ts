import { ComponentFixture, TestBed, fakeAsync, tick } from '@angular/core/testing';
import { HttpResponse } from '@angular/common/http';
import { FormBuilder } from '@angular/forms';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { RocketRankUpdateComponent } from 'app/entities/rocket-rank/rocket-rank-update.component';
import { RocketRankService } from 'app/entities/rocket-rank/rocket-rank.service';
import { RocketRank } from 'app/shared/model/rocket-rank.model';

describe('Component Tests', () => {
  describe('RocketRank Management Update Component', () => {
    let comp: RocketRankUpdateComponent;
    let fixture: ComponentFixture<RocketRankUpdateComponent>;
    let service: RocketRankService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [RocketRankUpdateComponent],
        providers: [FormBuilder],
      })
        .overrideTemplate(RocketRankUpdateComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(RocketRankUpdateComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(RocketRankService);
    });

    describe('save', () => {
      it('Should call update service on save for existing entity', fakeAsync(() => {
        // GIVEN
        const entity = new RocketRank(123);
        spyOn(service, 'update').and.returnValue(of(new HttpResponse({ body: entity })));
        comp.updateForm(entity);
        // WHEN
        comp.save();
        tick(); // simulate async

        // THEN
        expect(service.update).toHaveBeenCalledWith(entity);
        expect(comp.isSaving).toEqual(false);
      }));

      it('Should call create service on save for new entity', fakeAsync(() => {
        // GIVEN
        const entity = new RocketRank();
        spyOn(service, 'create').and.returnValue(of(new HttpResponse({ body: entity })));
        comp.updateForm(entity);
        // WHEN
        comp.save();
        tick(); // simulate async

        // THEN
        expect(service.create).toHaveBeenCalledWith(entity);
        expect(comp.isSaving).toEqual(false);
      }));
    });
  });
});
