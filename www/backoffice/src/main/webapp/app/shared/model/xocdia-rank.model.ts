export interface IXocdiaRank {
  id?: number;
  loginname?: string;
  amount?: number;
  type?: number;
}

export class XocdiaRank implements IXocdiaRank {
  constructor(public id?: number, public loginname?: string, public amount?: number, public type?: number) {}
}
