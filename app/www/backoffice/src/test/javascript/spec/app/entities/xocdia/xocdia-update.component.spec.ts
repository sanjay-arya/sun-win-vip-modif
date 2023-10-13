import { ComponentFixture, TestBed, fakeAsync, tick } from '@angular/core/testing';
import { HttpResponse } from '@angular/common/http';
import { FormBuilder } from '@angular/forms';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { XocdiaUpdateComponent } from 'app/entities/xocdia/xocdia-update.component';
import { XocdiaService } from 'app/entities/xocdia/xocdia.service';
import { Xocdia } from 'app/shared/model/xocdia.model';

describe('Component Tests', () => {
  describe('Xocdia Management Update Component', () => {
    let comp: XocdiaUpdateComponent;
    let fixture: ComponentFixture<XocdiaUpdateComponent>;
    let service: XocdiaService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [XocdiaUpdateComponent],
        providers: [FormBuilder],
      })
        .overrideTemplate(XocdiaUpdateComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(XocdiaUpdateComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(XocdiaService);
    });

    describe('save', () => {
      it('Should call update service on save for existing entity', fakeAsync(() => {
        // GIVEN
        const entity = new Xocdia(123);
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
        const entity = new Xocdia();
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
