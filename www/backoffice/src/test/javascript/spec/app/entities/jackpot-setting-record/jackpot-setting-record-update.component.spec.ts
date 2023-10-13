import { ComponentFixture, TestBed, fakeAsync, tick } from '@angular/core/testing';
import { HttpResponse } from '@angular/common/http';
import { FormBuilder } from '@angular/forms';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { JackpotSettingRecordUpdateComponent } from 'app/entities/jackpot-setting-record/jackpot-setting-record-update.component';
import { JackpotSettingRecordService } from 'app/entities/jackpot-setting-record/jackpot-setting-record.service';
import { JackpotSettingRecord } from 'app/shared/model/jackpot-setting-record.model';

describe('Component Tests', () => {
  describe('JackpotSettingRecord Management Update Component', () => {
    let comp: JackpotSettingRecordUpdateComponent;
    let fixture: ComponentFixture<JackpotSettingRecordUpdateComponent>;
    let service: JackpotSettingRecordService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [JackpotSettingRecordUpdateComponent],
        providers: [FormBuilder],
      })
        .overrideTemplate(JackpotSettingRecordUpdateComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(JackpotSettingRecordUpdateComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(JackpotSettingRecordService);
    });

    describe('save', () => {
      it('Should call update service on save for existing entity', fakeAsync(() => {
        // GIVEN
        const entity = new JackpotSettingRecord(123);
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
        const entity = new JackpotSettingRecord();
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
