export class Account {
  constructor(
    public activated: boolean,
    public authorities: string[],
    public fullName: string,
    public minAmount: number,
    public maxAmiunt: number,
    public langKey: string,
    public login: string,
    public imageUrl: string
  ) {}
}
