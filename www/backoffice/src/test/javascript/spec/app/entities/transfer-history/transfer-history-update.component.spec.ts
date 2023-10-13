import { ComponentFixture, TestBed, fakeAsync, tick } from '@angular/core/testing';
import { HttpResponse } from '@angular/common/http';
import { FormBuilder } from '@angular/forms';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { TransferHistoryUpdateComponent } from 'app/entities/transfer-history/transfer-history-update.component';
import { TransferHistoryService } from 'app/entities/transfer-history/transfer-history.service';
import { TransferHistory } from 'app/shared/model/transfer-history.model';

describe('Component Tests', () => {
  describe('TransferHistory Management Update Component', () => {
    let comp: TransferHistoryUpdateComponent;
    let fixture: ComponentFixture<TransferHistoryUpdateComponent>;
    let service: TransferHistoryService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [TransferHistoryUpdateComponent],
        providers: [FormBuilder],
      })
        .overrideTemplate(TransferHistoryUpdateComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(TransferHistoryUpdateComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(TransferHistoryService);
    });

    describe('save', () => {
      it('Should call update service on save for existing entity', fakeAsync(() => {
        // GIVEN
        const entity = new TransferHistory(123);
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
        const entity = new TransferHistory();
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
