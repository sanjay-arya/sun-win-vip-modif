import { ComponentFixture, TestBed, fakeAsync, tick } from '@angular/core/testing';
import { HttpResponse } from '@angular/common/http';
import { FormBuilder } from '@angular/forms';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { XocdiaRankUpdateComponent } from 'app/entities/xocdia-rank/xocdia-rank-update.component';
import { XocdiaRankService } from 'app/entities/xocdia-rank/xocdia-rank.service';
import { XocdiaRank } from 'app/shared/model/xocdia-rank.model';

describe('Component Tests', () => {
  describe('XocdiaRank Management Update Component', () => {
    let comp: XocdiaRankUpdateComponent;
    let fixture: ComponentFixture<XocdiaRankUpdateComponent>;
    let service: XocdiaRankService;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [XocdiaRankUpdateComponent],
        providers: [FormBuilder],
      })
        .overrideTemplate(XocdiaRankUpdateComponent, '')
        .compileComponents();

      fixture = TestBed.createComponent(XocdiaRankUpdateComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(XocdiaRankService);
    });

    describe('save', () => {
      it('Should call update service on save for existing entity', fakeAsync(() => {
        // GIVEN
        const entity = new XocdiaRank(123);
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
        const entity = new XocdiaRank();
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
