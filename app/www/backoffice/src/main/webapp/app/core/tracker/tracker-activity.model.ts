export class TrackerActivity {
  constructor(
    public id: number,
    public cd: number,
    public ut: number,
    public ux: number,
    public at: number,
    public ax: number,
    public rs: number[],
    public cmd: number
  ) {}
}
