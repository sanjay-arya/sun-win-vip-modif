export interface IRocketRank {
  id?: number;
  loginname?: string;
  amount?: number;
  type?: number;
}

export class RocketRank implements IRocketRank {
  constructor(public id?: number, public loginname?: string, public amount?: number, public type?: number) {}
}
