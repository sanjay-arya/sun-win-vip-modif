export interface IUser {
  id?: any;
  login?: string;
  balance?: number;
  fullName?: string,
  minAmount?: number,
  maxAmount?: number,
  activated?: boolean;
  langKey?: string;
  authorities?: string[];
  createdBy?: string;
  createdDate?: Date;
  lastModifiedBy?: string;
  lastModifiedDate?: Date;
  password?: string;
}

export class User implements IUser {
  constructor(
    public id?: any,
    public login?: string,
    public balance?: number,
    public fullName?: string,
    public minAmount?: number,
    public maxAmount?: number,
    public activated?: boolean,
    public langKey?: string,
    public authorities?: string[],
    public createdBy?: string,
    public createdDate?: Date,
    public lastModifiedBy?: string,
    public lastModifiedDate?: Date,
    public password?: string
  ) {}
}
