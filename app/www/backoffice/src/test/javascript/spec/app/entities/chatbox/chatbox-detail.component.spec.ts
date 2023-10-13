import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ActivatedRoute } from '@angular/router';
import { of } from 'rxjs';

import { TaixiucbTestModule } from '../../../test.module';
import { ChatboxDetailComponent } from 'app/entities/chatbox/chatbox-detail.component';
import { Chatbox } from 'app/shared/model/chatbox.model';

describe('Component Tests', () => {
  describe('Chatbox Management Detail Component', () => {
    let comp: ChatboxDetailComponent;
    let fixture: ComponentFixture<ChatboxDetailComponent>;
    const route = ({ data: of({ chatbox: new Chatbox(123) }) } as any) as ActivatedRoute;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [TaixiucbTestModule],
        declarations: [ChatboxDetailComponent],
        providers: [{ provide: ActivatedRoute, useValue: route }],
      })
        .overrideTemplate(ChatboxDetailComponent, '')
        .compileComponents();
      fixture = TestBed.createComponent(ChatboxDetailComponent);
      comp = fixture.componentInstance;
    });

    describe('OnInit', () => {
      it('Should load chatbox on init', () => {
        // WHEN
        comp.ngOnInit();

        // THEN
        expect(comp.chatbox).toEqual(jasmine.objectContaining({ id: 123 }));
      });
    });
  });
});
