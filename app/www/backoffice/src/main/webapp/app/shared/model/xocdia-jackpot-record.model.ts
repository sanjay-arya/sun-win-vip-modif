import { Moment } from 'moment';
export interface IXocdiaJackpotRecord {
  id?: number;
  gameId?: number;
  // loginname?: string;
  amount?: number;
  created?: Moment;
}

export class XocdiaJackpotRecord implements IXocdiaJackpotRecord {
  constructor(
    public id?: number,
    public gameId?: number,
    // public loginname?: string,
    public amount?: number,
    public created?: Moment
  ) {}
}
