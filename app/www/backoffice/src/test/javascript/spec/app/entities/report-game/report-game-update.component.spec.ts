import { ComponentFixture, TestBed, fakeAsync, tick } from '@angular/core/testing';
import { HttpResponse } from '@angular/common/http';
import { FormBuilder } from '@angular/forms';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { ReportGameUpdateComponent } from 'app/entities/report-game/report-game-update.component';
import { ReportGameService } from 'app/entities/report-game/report-game.service';
import { ReportGame } from 'app/shared/model/report-game.model';

describe('Component Tests', () => {
  describe('ReportGame Management Update Component', () => {
    let comp: ReportGameUpdateComponent;
    let fixture: ComponentFixture<ReportGameUpdateComponent>;
    let service: ReportGameService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [ReportGameUpdateComponent],
        providers: [FormBuilder],
      })
        .overrideTemplate(ReportGameUpdateComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(ReportGameUpdateComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(ReportGameService);
    });

    describe('save', () => {
      it('Should call update service on save for existing entity', fakeAsync(() => {
        // GIVEN
        const entity = new ReportGame(123);
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
        const entity = new ReportGame();
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
