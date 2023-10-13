import { Moment } from 'moment';

export interface ITaixiuRecord {
  id?: number;
  taixiuId?: number;
  userId?: number;
  loginname?: string;
  betamount?: number;
  winamount?: number;
  typed?: number;
  status?: number;
  bettime?: Moment;
  result?: string;
  description?: string;
  refundamount?: number;
  ip?: string;
}

export class TaixiuRecord implements ITaixiuRecord {
  constructor(
    public id?: number,
    public taixiuId?: number,
    public userId?: number,
    public loginname?: string,
    public betamount?: number,
    public winamount?: number,
    public typed?: number,
    public status?: number,
    public bettime?: Moment,
    public result?: string,
    public description?: string,
    public refundamount?: number,
    public ip?: string
  ) {}
}
