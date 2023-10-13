import { Moment } from 'moment';
export interface IRocket {
  id?: number;
  opentime?: Moment;
  endtime?: Moment;
  status?: number;
  result?: string;
}

export class Rocket implements IRocket {
  constructor(public id?: number, public opentime?: Moment, public endtime?: Moment, public status?: number, public result?: string) {}
}
