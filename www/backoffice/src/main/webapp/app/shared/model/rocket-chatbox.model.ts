export interface IRocketChatbox {
  id?: number;
  loginname?: string;
  message?: string;
  types?: number;
  created?: string;
}

export class RocketChatbox implements IRocketChatbox {
  constructor(public id?: number, public loginname?: string, public message?: string, public types?: number, public created?: string) {}
}
