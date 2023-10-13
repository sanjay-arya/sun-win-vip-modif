import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ActivatedRoute } from '@angular/router';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { XocdiaDetailComponent } from 'app/entities/xocdia/xocdia-detail.component';
import { Xocdia } from 'app/shared/model/xocdia.model';

describe('Component Tests', () => {
  describe('Xocdia Management Detail Component', () => {
    let comp: XocdiaDetailComponent;
    let fixture: ComponentFixture<XocdiaDetailComponent>;
    const route = ({ data: of({ xocdia: new Xocdia(123) }) } as any) as ActivatedRoute;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [XocdiaDetailComponent],
        providers: [{ provide: ActivatedRoute, useValue: route }],
      })
        .overrideTemplate(XocdiaDetailComponent, '')
        .compileComponents();
      fixture = TestBed.createComponent(XocdiaDetailComponent);
      comp = fixture.componentInstance;
    });

    describe('OnInit', () => {
      it('Should load xocdia on init', () => {
        // WHEN
        comp.ngOnInit();

        // THEN
        expect(comp.xocdia).toEqual(jasmine.objectContaining({ id: 123 }));
      });
    });
  });
});
