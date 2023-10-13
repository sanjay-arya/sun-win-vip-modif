import { Moment } from 'moment';

export interface IReportGame {
  id?: number;
  rdate?: Moment;
  sicboBet?: number;
  sicboWin?: number;
  sedieBet?: number;
  sedieWin?: number;
  rocketBet?: number;
  rocketWin?: number;
  sicboFee?: number;
  sedieFee?: number;
  rocketFee?: number;
}

export class ReportGame implements IReportGame {
  constructor(
    public id?: number,
    public rdate?: Moment,
    public sicboBet?: number,
    public sicboWin?: number,
    public sedieBet?: number,
    public sedieWin?: number,
    public rocketBet?: number,
    public rocketWin?: number,
    public sicboFee?: number,
    public sedieFee?: number,
    public rocketFee?: number
  ) {}
}
