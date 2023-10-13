import { Moment } from 'moment';
export interface IXocdia {
  id?: number;
  opentime?: Moment;
  endtime?: Moment;
  status?: number;
  result?: string;
}

export class Xocdia implements IXocdia {
  constructor(public id?: number, public opentime?: Moment, public endtime?: Moment, public status?: number, public result?: string) {}
}
