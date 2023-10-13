export interface IUserinfo {
  id?: number;
  loginname?: string;
  pwd?: string;
  usertype?: number;
  status?: number;
}

export class Userinfo implements IUserinfo {
  constructor(public id?: number, public loginname?: string, public pwd?: string, public usertype?: number, public status?: number) {}
}
