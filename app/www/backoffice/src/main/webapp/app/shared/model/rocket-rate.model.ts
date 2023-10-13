export interface IRocketRate {
  id?: number;
  typed?: number;
  pick?: number;
  rate?: number;
}

export class RocketRate implements IRocketRate {
  constructor(public id?: number, public typed?: number, public pick?: number, public rate?: number) {}
}
