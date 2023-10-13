import { ComponentFixture, TestBed, fakeAsync, tick } from '@angular/core/testing';
import { HttpResponse } from '@angular/common/http';
import { FormBuilder } from '@angular/forms';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { ChatboxUpdateComponent } from 'app/entities/chatbox/chatbox-update.component';
import { ChatboxService } from 'app/entities/chatbox/chatbox.service';
import { Chatbox } from 'app/shared/model/chatbox.model';

describe('Component Tests', () => {
  describe('Chatbox Management Update Component', () => {
    let comp: ChatboxUpdateComponent;
    let fixture: ComponentFixture<ChatboxUpdateComponent>;
    let service: ChatboxService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [ChatboxUpdateComponent],
        providers: [FormBuilder],
      })
        .overrideTemplate(ChatboxUpdateComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(ChatboxUpdateComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(ChatboxService);
    });

    describe('save', () => {
      it('Should call update service on save for existing entity', fakeAsync(() => {
        // GIVEN
        const entity = new Chatbox(123);
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
        const entity = new Chatbox();
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
