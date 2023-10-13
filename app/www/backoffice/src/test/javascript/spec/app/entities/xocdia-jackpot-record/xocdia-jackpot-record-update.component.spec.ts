import { ComponentFixture, TestBed, fakeAsync, tick } from '@angular/core/testing';
import { HttpResponse } from '@angular/common/http';
import { FormBuilder } from '@angular/forms';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { XocdiaJackpotRecordUpdateComponent } from 'app/entities/xocdia-jackpot-record/xocdia-jackpot-record-update.component';
import { XocdiaJackpotRecordService } from 'app/entities/xocdia-jackpot-record/xocdia-jackpot-record.service';
import { XocdiaJackpotRecord } from 'app/shared/model/xocdia-jackpot-record.model';

describe('Component Tests', () => {
  describe('XocdiaJackpotRecord Management Update Component', () => {
    let comp: XocdiaJackpotRecordUpdateComponent;
    let fixture: ComponentFixture<XocdiaJackpotRecordUpdateComponent>;
    let service: XocdiaJackpotRecordService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [XocdiaJackpotRecordUpdateComponent],
        providers: [FormBuilder],
      })
        .overrideTemplate(XocdiaJackpotRecordUpdateComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(XocdiaJackpotRecordUpdateComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(XocdiaJackpotRecordService);
    });

    describe('save', () => {
      it('Should call update service on save for existing entity', fakeAsync(() => {
        // GIVEN
        const entity = new XocdiaJackpotRecord(123);
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
        const entity = new XocdiaJackpotRecord();
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
