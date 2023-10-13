export interface IXocdiaChatbox {
  id?: number;
  loginname?: string;
  message?: string;
  types?: number;
  created?: string;
}

export class XocdiaChatbox implements IXocdiaChatbox {
  constructor(public id?: number, public loginname?: string, public message?: string, public types?: number, public created?: string) {}
}
