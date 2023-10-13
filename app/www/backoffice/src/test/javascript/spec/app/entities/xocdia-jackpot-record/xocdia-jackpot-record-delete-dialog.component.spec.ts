import { ComponentFixture, TestBed, inject, fakeAsync, tick } from '@angular/core/testing';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { of } from 'rxjs';
import { JhiEventManager } from 'ng-jhipster';

import { TaixiucbTestModule } from '../../../test.module';
import { MockEventManager } from '../../../helpers/mock-event-manager.service';
import { MockActiveModal } from '../../../helpers/mock-active-modal.service';
import { XocdiaJackpotRecordDeleteDialogComponent } from 'app/entities/xocdia-jackpot-record/xocdia-jackpot-record-delete-dialog.component';
import { XocdiaJackpotRecordService } from 'app/entities/xocdia-jackpot-record/xocdia-jackpot-record.service';

describe('Component Tests', () => {
  describe('XocdiaJackpotRecord Management Delete Component', () => {
    let comp: XocdiaJackpotRecordDeleteDialogComponent;
    let fixture: ComponentFixture<XocdiaJackpotRecordDeleteDialogComponent>;
    let service: XocdiaJackpotRecordService;
    let mockEventManager: MockEventManager;
    let mockActiveModal: MockActiveModal;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [XocdiaJackpotRecordDeleteDialogComponent],
      })
        .overrideTemplate(XocdiaJackpotRecordDeleteDialogComponent, '')
        .compileComponents();
      fixture = TestBed.createComponent(XocdiaJackpotRecordDeleteDialogComponent);
      comp = fixture.componentInstance;
      service = fixture.debugElement.injector.get(XocdiaJackpotRecordService);
      mockEventManager = TestBed.get(JhiEventManager);
      mockActiveModal = TestBed.get(NgbActiveModal);
    });

    describe('confirmDelete', () => {
      it('Should call delete service on confirmDelete', inject(
        [],
        fakeAsync(() => {
          // GIVEN
          spyOn(service, 'delete').and.returnValue(of({}));

          // WHEN
          comp.confirmDelete(123);
          tick();

          // THEN
          expect(service.delete).toHaveBeenCalledWith(123);
          expect(mockActiveModal.closeSpy).toHaveBeenCalled();
          expect(mockEventManager.broadcastSpy).toHaveBeenCalled();
        })
      ));

      it('Should not call delete service on clear', () => {
        // GIVEN
        spyOn(service, 'delete');

        // WHEN
        comp.cancel();

        // THEN
        expect(service.delete).not.toHaveBeenCalled();
        expect(mockActiveModal.dismissSpy).toHaveBeenCalled();
      });
    });
  });
});
