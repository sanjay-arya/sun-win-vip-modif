import { ComponentFixture, TestBed, fakeAsync, tick } from '@angular/core/testing';
import { HttpResponse } from '@angular/common/http';
import { FormBuilder } from '@angular/forms';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { TxRankUpdateComponent } from 'app/entities/tx-rank/tx-rank-update.component';
import { TxRankService } from 'app/entities/tx-rank/tx-rank.service';
import { TxRank } from 'app/shared/model/tx-rank.model';

describe('Component Tests', () => {
  describe('TxRank Management Update Component', () => {
    let comp: TxRankUpdateComponent;
    let fixture: ComponentFixture<TxRankUpdateComponent>;
    let service: TxRankService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [TxRankUpdateComponent],
        providers: [FormBuilder],
      })
        .overrideTemplate(TxRankUpdateComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(TxRankUpdateComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(TxRankService);
    });

    describe('save', () => {
      it('Should call update service on save for existing entity', fakeAsync(() => {
        // GIVEN
        const entity = new TxRank(123);
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
        const entity = new TxRank();
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
