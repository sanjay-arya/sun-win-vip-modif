package game.modules.slot.cmd.send.sexygirl;

import bitzero.server.extensions.data.BaseMsg;

import java.nio.ByteBuffer;

public class UpdatePotSexyGirlMsg extends BaseMsg {
    public long value10;
    public long value100;
    public long value1000;
    public byte x2room10 = 0;
    public byte x2room100 = 0;

    public UpdatePotSexyGirlMsg() {
        super((short)15002);
    }

    public byte[] createData() {
        ByteBuffer bf = this.makeBuffer();
        bf.putLong(this.value10);
        bf.putLong(this.value100);
        bf.putLong(this.value1000);
        bf.put(this.x2room10);
        bf.put(this.x2room100);
        return this.packBuffer(bf);
    }
}
