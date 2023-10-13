import { ComponentFixture, TestBed, fakeAsync, tick } from '@angular/core/testing';
import { HttpResponse } from '@angular/common/http';
import { FormBuilder } from '@angular/forms';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { RocketChatboxUpdateComponent } from 'app/entities/rocket-chatbox/rocket-chatbox-update.component';
import { RocketChatboxService } from 'app/entities/rocket-chatbox/rocket-chatbox.service';
import { RocketChatbox } from 'app/shared/model/rocket-chatbox.model';

describe('Component Tests', () => {
  describe('RocketChatbox Management Update Component', () => {
    let comp: RocketChatboxUpdateComponent;
    let fixture: ComponentFixture<RocketChatboxUpdateComponent>;
    let service: RocketChatboxService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [RocketChatboxUpdateComponent],
        providers: [FormBuilder],
      })
        .overrideTemplate(RocketChatboxUpdateComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(RocketChatboxUpdateComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(RocketChatboxService);
    });

    describe('save', () => {
      it('Should call update service on save for existing entity', fakeAsync(() => {
        // GIVEN
        const entity = new RocketChatbox(123);
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
        const entity = new RocketChatbox();
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
