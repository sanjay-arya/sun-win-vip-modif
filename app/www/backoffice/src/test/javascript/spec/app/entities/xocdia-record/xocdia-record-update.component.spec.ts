import { ComponentFixture, TestBed, fakeAsync, tick } from '@angular/core/testing';
import { HttpResponse } from '@angular/common/http';
import { FormBuilder } from '@angular/forms';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { XocdiaRecordUpdateComponent } from 'app/entities/xocdia-record/xocdia-record-update.component';
import { XocdiaRecordService } from 'app/entities/xocdia-record/xocdia-record.service';
import { XocdiaRecord } from 'app/shared/model/xocdia-record.model';

describe('Component Tests', () => {
  describe('XocdiaRecord Management Update Component', () => {
    let comp: XocdiaRecordUpdateComponent;
    let fixture: ComponentFixture<XocdiaRecordUpdateComponent>;
    let service: XocdiaRecordService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [XocdiaRecordUpdateComponent],
        providers: [FormBuilder],
      })
        .overrideTemplate(XocdiaRecordUpdateComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(XocdiaRecordUpdateComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(XocdiaRecordService);
    });

    describe('save', () => {
      it('Should call update service on save for existing entity', fakeAsync(() => {
        // GIVEN
        const entity = new XocdiaRecord(123);
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
        const entity = new XocdiaRecord();
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
