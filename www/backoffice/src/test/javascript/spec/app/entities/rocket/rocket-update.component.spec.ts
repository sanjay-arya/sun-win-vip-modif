import { ComponentFixture, TestBed, fakeAsync, tick } from '@angular/core/testing';
import { HttpResponse } from '@angular/common/http';
import { FormBuilder } from '@angular/forms';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { RocketUpdateComponent } from 'app/entities/rocket/rocket-update.component';
import { RocketService } from 'app/entities/rocket/rocket.service';
import { Rocket } from 'app/shared/model/rocket.model';

describe('Component Tests', () => {
  describe('Rocket Management Update Component', () => {
    let comp: RocketUpdateComponent;
    let fixture: ComponentFixture<RocketUpdateComponent>;
    let service: RocketService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [RocketUpdateComponent],
        providers: [FormBuilder],
      })
        .overrideTemplate(RocketUpdateComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(RocketUpdateComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(RocketService);
    });

    describe('save', () => {
      it('Should call update service on save for existing entity', fakeAsync(() => {
        // GIVEN
        const entity = new Rocket(123);
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
        const entity = new Rocket();
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
