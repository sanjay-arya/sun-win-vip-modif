import { Moment } from 'moment';

export interface ITaixiu {
  id?: number;
  opentime?: Moment;
  endtime?: Moment;
  status?: number;
  result?: string;
}

export class Taixiu implements ITaixiu {
  constructor(public id?: number, public opentime?: Moment, public endtime?: Moment, public status?: number, public result?: string) {}
}
