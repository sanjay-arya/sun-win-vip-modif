import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ActivatedRoute } from '@angular/router';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { XocdiaChatboxDetailComponent } from 'app/entities/xocdia-chatbox/xocdia-chatbox-detail.component';
import { XocdiaChatbox } from 'app/shared/model/xocdia-chatbox.model';

describe('Component Tests', () => {
  describe('XocdiaChatbox Management Detail Component', () => {
    let comp: XocdiaChatboxDetailComponent;
    let fixture: ComponentFixture<XocdiaChatboxDetailComponent>;
    const route = ({ data: of({ xocdiaChatbox: new XocdiaChatbox(123) }) } as any) as ActivatedRoute;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [XocdiaChatboxDetailComponent],
        providers: [{ provide: ActivatedRoute, useValue: route }],
      })
        .overrideTemplate(XocdiaChatboxDetailComponent, '')
        .compileComponents();
      fixture = TestBed.createComponent(XocdiaChatboxDetailComponent);
      comp = fixture.componentInstance;
    });

    describe('OnInit', () => {
      it('Should load xocdiaChatbox on init', () => {
        // WHEN
        comp.ngOnInit();

        // THEN
        expect(comp.xocdiaChatbox).toEqual(jasmine.objectContaining({ id: 123 }));
      });
    });
  });
});
