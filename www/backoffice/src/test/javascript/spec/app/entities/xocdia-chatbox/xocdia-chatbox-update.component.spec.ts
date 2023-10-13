import { ComponentFixture, TestBed, fakeAsync, tick } from '@angular/core/testing';
import { HttpResponse } from '@angular/common/http';
import { FormBuilder } from '@angular/forms';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { XocdiaChatboxUpdateComponent } from 'app/entities/xocdia-chatbox/xocdia-chatbox-update.component';
import { XocdiaChatboxService } from 'app/entities/xocdia-chatbox/xocdia-chatbox.service';
import { XocdiaChatbox } from 'app/shared/model/xocdia-chatbox.model';

describe('Component Tests', () => {
  describe('XocdiaChatbox Management Update Component', () => {
    let comp: XocdiaChatboxUpdateComponent;
    let fixture: ComponentFixture<XocdiaChatboxUpdateComponent>;
    let service: XocdiaChatboxService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [XocdiaChatboxUpdateComponent],
        providers: [FormBuilder],
      })
        .overrideTemplate(XocdiaChatboxUpdateComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(XocdiaChatboxUpdateComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(XocdiaChatboxService);
    });

    describe('save', () => {
      it('Should call update service on save for existing entity', fakeAsync(() => {
        // GIVEN
        const entity = new XocdiaChatbox(123);
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
        const entity = new XocdiaChatbox();
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
