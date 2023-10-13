import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ActivatedRoute } from '@angular/router';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { RocketChatboxDetailComponent } from 'app/entities/rocket-chatbox/rocket-chatbox-detail.component';
import { RocketChatbox } from 'app/shared/model/rocket-chatbox.model';

describe('Component Tests', () => {
  describe('RocketChatbox Management Detail Component', () => {
    let comp: RocketChatboxDetailComponent;
    let fixture: ComponentFixture<RocketChatboxDetailComponent>;
    const route = ({ data: of({ rocketChatbox: new RocketChatbox(123) }) } as any) as ActivatedRoute;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [RocketChatboxDetailComponent],
        providers: [{ provide: ActivatedRoute, useValue: route }],
      })
        .overrideTemplate(RocketChatboxDetailComponent, '')
        .compileComponents();
      fixture = TestBed.createComponent(RocketChatboxDetailComponent);
      comp = fixture.componentInstance;
    });

    describe('OnInit', () => {
      it('Should load rocketChatbox on init', () => {
        // WHEN
        comp.ngOnInit();

        // THEN
        expect(comp.rocketChatbox).toEqual(jasmine.objectContaining({ id: 123 }));
      });
    });
  });
});
