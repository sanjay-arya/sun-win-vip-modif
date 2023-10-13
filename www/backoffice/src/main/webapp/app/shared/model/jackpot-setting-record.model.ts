import { Moment } from 'moment';
export interface IJackpotSettingRecord {
  id?: number;
  createdBy?: string;
  createdDate?: Moment;
  value?: string;
}

export class JackpotSettingRecord implements IJackpotSettingRecord {
  constructor(public id?: number, public createdBy?: string, public createdDate?: Moment, public value?: string) {}
}
