import { Moment } from 'moment';
export interface IXocdiaRecord {
  id?: number;
  xocdiaId?: number;
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

export class XocdiaRecord implements IXocdiaRecord {
  constructor(
    public id?: number,
    public xocdiaId?: number,
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
