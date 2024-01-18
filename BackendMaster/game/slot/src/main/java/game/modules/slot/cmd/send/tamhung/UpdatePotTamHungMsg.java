/*
 * Decompiled with CFR 0.144.
 * 
 * Could not load the following classes:
 *  bitzero.server.extensions.data.BaseMsg
 */
package game.modules.slot.cmd.send.tamhung;

import bitzero.server.extensions.data.BaseMsg;

import java.nio.ByteBuffer;

public class UpdatePotTamHungMsg
extends BaseMsg {
    public long value10;
    public long value100;
    public long value1000;
    public byte x2room10 = 0;
    public byte x2room100 = 0;

    public UpdatePotTamHungMsg() {
        super((short)14002);
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

