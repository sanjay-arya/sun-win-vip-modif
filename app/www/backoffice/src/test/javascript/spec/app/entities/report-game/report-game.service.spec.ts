import { TestBed, getTestBed } from '@angular/core/testing';
import { HttpClientTestingModule, HttpTestingController } from '@angular/common/http/testing';
import * as moment from 'moment';
import { DATE_FORMAT } from 'app/shared/constants/input.constants';
import { ReportGameService } from 'app/entities/report-game/report-game.service';
import { IReportGame, ReportGame } from 'app/shared/model/report-game.model';

describe('Service Tests', () => {
  describe('ReportGame Service', () => {
    let injector: TestBed;
    let service: ReportGameService;
    let httpMock: HttpTestingController;
    let elemDefault: IReportGame;
    let expectedResult: IReportGame | IReportGame[] | boolean | null;
    let currentDate: moment.Moment;

    beforeEach(() => {
      TestBed.configureTestingModule({
        imports: [HttpClientTestingModule],
      });
      expectedResult = null;
      injector = getTestBed();
      service = injector.get(ReportGameService);
      httpMock = injector.get(HttpTestingController);
      currentDate = moment();

      elemDefault = new ReportGame(0, currentDate, 0, 0, 0, 0, 0, 0, 0, 0, 0);
    });

    describe('Service methods', () => {
      it('should find an element', () => {
        const returnedFromService = Object.assign(
          {
            rdate: currentDate.format(DATE_FORMAT),
          },
          elemDefault
        );

        service.find(123).subscribe(resp => (expectedResult = resp.body));

        const req = httpMock.expectOne({ method: 'GET' });
        req.flush(returnedFromService);
        expect(expectedResult).toMatchObject(elemDefault);
      });

      it('should create a ReportGame', () => {
        const returnedFromService = Object.assign(
          {
            id: 0,
            rdate: currentDate.format(DATE_FORMAT),
          },
          elemDefault
        );

        const expected = Object.assign(
          {
            rdate: currentDate,
          },
          returnedFromService
        );

        service.create(new ReportGame()).subscribe(resp => (expectedResult = resp.body));

        const req = httpMock.expectOne({ method: 'POST' });
        req.flush(returnedFromService);
        expect(expectedResult).toMatchObject(expected);
      });

      it('should update a ReportGame', () => {
        const returnedFromService = Object.assign(
          {
            rdate: currentDate.format(DATE_FORMAT),
            sicboBet: 1,
            sicboWin: 1,
            sedieBet: 1,
            sedieWin: 1,
            rocketBet: 1,
            rocketWin: 1,
            sicboFee: 1,
            sedieFee: 1,
            rocketFee: 1,
          },
          elemDefault
        );

        const expected = Object.assign(
          {
            rdate: currentDate,
          },
          returnedFromService
        );

        service.update(expected).subscribe(resp => (expectedResult = resp.body));

        const req = httpMock.expectOne({ method: 'PUT' });
        req.flush(returnedFromService);
        expect(expectedResult).toMatchObject(expected);
      });

      it('should return a list of ReportGame', () => {
        const returnedFromService = Object.assign(
          {
            rdate: currentDate.format(DATE_FORMAT),
            sicboBet: 1,
            sicboWin: 1,
            sedieBet: 1,
            sedieWin: 1,
            rocketBet: 1,
            rocketWin: 1,
            sicboFee: 1,
            sedieFee: 1,
            rocketFee: 1,
          },
          elemDefault
        );

        const expected = Object.assign(
          {
            rdate: currentDate,
          },
          returnedFromService
        );

        service.query().subscribe(resp => (expectedResult = resp.body));

        const req = httpMock.expectOne({ method: 'GET' });
        req.flush([returnedFromService]);
        httpMock.verify();
        expect(expectedResult).toContainEqual(expected);
      });

      it('should delete a ReportGame', () => {
        service.delete(123).subscribe(resp => (expectedResult = resp.ok));

        const req = httpMock.expectOne({ method: 'DELETE' });
        req.flush({ status: 200 });
        expect(expectedResult);
      });
    });

    afterEach(() => {
      httpMock.verify();
    });
  });
});
