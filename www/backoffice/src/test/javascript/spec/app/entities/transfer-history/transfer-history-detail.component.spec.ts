import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ActivatedRoute } from '@angular/router';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { TransferHistoryDetailComponent } from 'app/entities/transfer-history/transfer-history-detail.component';
import { TransferHistory } from 'app/shared/model/transfer-history.model';

describe('Component Tests', () => {
  describe('TransferHistory Management Detail Component', () => {
    let comp: TransferHistoryDetailComponent;
    let fixture: ComponentFixture<TransferHistoryDetailComponent>;
    const route = ({ data: of({ transferHistory: new TransferHistory(123) }) } as any) as ActivatedRoute;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [TransferHistoryDetailComponent],
        providers: [{ provide: ActivatedRoute, useValue: route }],
      })
        .overrideTemplate(TransferHistoryDetailComponent, '')
        .compileComponents();
      fixture = TestBed.createComponent(TransferHistoryDetailComponent);
      comp = fixture.componentInstance;
    });

    describe('OnInit', () => {
      it('Should load transferHistory on init', () => {
        // WHEN
        comp.ngOnInit();

        // THEN
        expect(comp.transferHistory).toEqual(jasmine.objectContaining({ id: 123 }));
      });
    });
  });
});
