export interface ITxRank {
  id?: number;
  loginname?: string;
  amount?: number;
  type?: number;
}

export class TxRank implements ITxRank {
  constructor(public id?: number, public loginname?: string, public amount?: number, public type?: number) {}
}
