import { Moment } from 'moment';

export interface ITransferHistory {
  id?: number;
  amount?: number;
  created?: Moment;
  action?: number;
  current_balance?: number;
  username?: string;
  orderId?: string;
  transId?: string;
}

export class TransferHistory implements ITransferHistory {
  constructor(
    public id?: number,
    public amount?: number,
    public created?: Moment,
    public action?: number,
    public current_balance?: number,
    public username?: string,
    public orderId?: string,
    public transId?: string
  ) {}
}
