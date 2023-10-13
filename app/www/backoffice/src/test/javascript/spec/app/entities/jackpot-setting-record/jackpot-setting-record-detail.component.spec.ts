import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ActivatedRoute } from '@angular/router';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { JackpotSettingRecordDetailComponent } from 'app/entities/jackpot-setting-record/jackpot-setting-record-detail.component';
import { JackpotSettingRecord } from 'app/shared/model/jackpot-setting-record.model';

describe('Component Tests', () => {
  describe('JackpotSettingRecord Management Detail Component', () => {
    let comp: JackpotSettingRecordDetailComponent;
    let fixture: ComponentFixture<JackpotSettingRecordDetailComponent>;
    const route = ({ data: of({ jackpotSettingRecord: new JackpotSettingRecord(123) }) } as any) as ActivatedRoute;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [JackpotSettingRecordDetailComponent],
        providers: [{ provide: ActivatedRoute, useValue: route }],
      })
        .overrideTemplate(JackpotSettingRecordDetailComponent, '')
        .compileComponents();
      fixture = TestBed.createComponent(JackpotSettingRecordDetailComponent);
      comp = fixture.componentInstance;
    });

    describe('OnInit', () => {
      it('Should load jackpotSettingRecord on init', () => {
        // WHEN
        comp.ngOnInit();

        // THEN
        expect(comp.jackpotSettingRecord).toEqual(jasmine.objectContaining({ id: 123 }));
      });
    });
  });
});
