import { ComponentFixture, TestBed, fakeAsync, tick } from '@angular/core/testing';
import { HttpResponse } from '@angular/common/http';
import { FormBuilder } from '@angular/forms';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { RocketRateUpdateComponent } from 'app/entities/rocket-rate/rocket-rate-update.component';
import { RocketRateService } from 'app/entities/rocket-rate/rocket-rate.service';
import { RocketRate } from 'app/shared/model/rocket-rate.model';

describe('Component Tests', () => {
  describe('RocketRate Management Update Component', () => {
    let comp: RocketRateUpdateComponent;
    let fixture: ComponentFixture<RocketRateUpdateComponent>;
    let service: RocketRateService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [RocketRateUpdateComponent],
        providers: [FormBuilder],
      })
        .overrideTemplate(RocketRateUpdateComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(RocketRateUpdateComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(RocketRateService);
    });

    describe('save', () => {
      it('Should call update service on save for existing entity', fakeAsync(() => {
        // GIVEN
        const entity = new RocketRate(123);
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
        const entity = new RocketRate();
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
