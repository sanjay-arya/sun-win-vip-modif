import { Moment } from 'moment';

export interface ITransactionHistory {
  id?: number;
  amount?: number;
  created?: Moment;
  action?: number;
  current_balance?: number;
  username?: string;
}

export class TransactionHistory implements ITransactionHistory {
  constructor(
    public id?: number,
    public amount?: number,
    public created?: Moment,
    public action?: number,
    public current_balance?: number,
    public username?: string
  ) {}
}
