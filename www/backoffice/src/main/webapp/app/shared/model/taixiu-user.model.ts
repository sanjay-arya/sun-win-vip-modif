import { Moment } from 'moment';

export interface ITaixiuUser {
  id?: number;
  loginname?: string;
  active?: number;
  minbet?: number;
  maxbet?: number;
  created?: Moment;
}

export class TaixiuUser implements ITaixiuUser {
  constructor(
    public id?: number,
    public loginname?: string,
    public active?: number,
    public minbet?: number,
    public maxbet?: number,
    public created?: Moment
  ) {}
}
