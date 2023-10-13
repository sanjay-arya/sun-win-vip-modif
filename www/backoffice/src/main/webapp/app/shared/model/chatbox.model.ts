export interface IChatbox {
  id?: number;
  loginname?: string;
  message?: string;
  types?: number;
  created?: string;
}

export class Chatbox implements IChatbox {
  constructor(public id?: number, public loginname?: string, public message?: string, public types?: number, public created?: string) {}
}
