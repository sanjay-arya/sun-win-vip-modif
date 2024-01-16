package game.modules.slot;

import bitzero.server.BitZeroServer;
import bitzero.server.core.BZEventParam;
import bitzero.server.core.BZEventType;
import bitzero.server.core.IBZEvent;
import bitzero.server.core.IBZEventParam;
import bitzero.server.entities.User;
import bitzero.server.exceptions.BZException;
import bitzero.server.extensions.data.BaseMsg;
import bitzero.server.extensions.data.DataCmd;
import bitzero.util.common.business.Debug;
import com.vinplay.dal.service.impl.CacheServiceImpl;
import com.vinplay.vbee.common.enums.Games;
import com.vinplay.vbee.common.exceptions.KeyNotFoundException;
import com.vinplay.vbee.common.models.slot.SlotFreeSpin;
import com.vinplay.vbee.common.utils.CommonUtils;
import game.BotJackpotTimer.BotJackPotChiemtinhTimer;
import game.modules.slot.cmd.rev.audition.MinimizeAuditionCmd;
import game.modules.slot.cmd.rev.chiemtinh.*;
import game.modules.slot.cmd.send.chiemtinh.ChiemtinhInfoMsg;
import game.modules.slot.room.ChiemTinhRoom;
import game.modules.slot.utils.SlotUtils;

import java.io.PrintWriter;
import java.io.StringWriter;
import java.util.concurrent.TimeUnit;
import java.util.logging.Level;
import java.util.logging.Logger;

public class ChiemTinhModule
extends SlotModule {
    private long referenceId = 1L;
    private String fullLines = "1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25";
    private Runnable pokeGoX2Task = new X2Task();
//    private Runnable pokeGoX2Task = new X2Task(this);

    private static String slot11IconWildJackpotFund = "SlotChiemTinh_Jackpot_Fund";
    private static String slot11IconWildMinigameFund = "SlotChiemTinh_Minigame_Fund";

    public final String keyBotJackpotSlot11IconWild = "Bot_SlotChiemTinh_time";

    public ChiemTinhModule() {
        this.gameName = Games.CHIEM_TINH.getName();
    }

    private static ChiemTinhModule _instance;
    public static ChiemTinhModule getInstance(){
        return _instance;
    }

    public void init() {
        super.init();
        long[] funds = new long[3];
        int[] initPotValues = {500000,5000000,50000000};
        long[] fundsJackPot = new long[3];
        long[] fundMiniGame = new long[3];

        long[] timeJackPot = new long[3];
        try {
            this.pots = this.service.getPots(this.gameName);
            Debug.trace(this.gameName + " POTS: " + CommonUtils.arrayLongToString(this.pots));
            funds = this.service.getFunds(this.gameName);
            Debug.trace(this.gameName + ": " + CommonUtils.arrayLongToString(funds));

            fundsJackPot = this.service.getFunds(slot11IconWildJackpotFund);
            Debug.trace("Slot11IconWild FUNDS JACKPOT: " + CommonUtils.arrayLongToString(fundsJackPot));

            fundMiniGame = this.service.getFunds(slot11IconWildMinigameFund);
            Debug.trace("Slot11IconWild FUNDS Minigame: " + CommonUtils.arrayLongToString(fundMiniGame));

            timeJackPot = this.service.getFunds(keyBotJackpotSlot11IconWild);
            Debug.trace("Slot11IconWild TIME JACKPOT: " + CommonUtils.arrayLongToString(timeJackPot));
        }
        catch (Exception e) {
            Debug.trace("Init " + this.gameName + " error ", e);
        }
        this.rooms.put(this.gameName + "_vin_10", new ChiemTinhRoom(this, (byte)0, this.gameName + "_vin_10", (short)1,
                this.pots[0], funds[0], 10, initPotValues[0],
                fundsJackPot[0],slot11IconWildJackpotFund+ "_vin_10",
                fundMiniGame[0],slot11IconWildMinigameFund + "_vin_10"));
        this.rooms.put(this.gameName + "_vin_100", new ChiemTinhRoom(this, (byte)1, this.gameName + "_vin_100", (short)1,
                this.pots[1], funds[1], 100, initPotValues[1],
                fundsJackPot[1],slot11IconWildJackpotFund+ "_vin_100",
                fundMiniGame[1],slot11IconWildMinigameFund + "_vin_100"));
        this.rooms.put(this.gameName + "_vin_1000", new ChiemTinhRoom(this, (byte)2, this.gameName + "_vin_1000", (short)1,
                this.pots[2], funds[2], 1000, initPotValues[2],
                fundsJackPot[2],slot11IconWildJackpotFund+ "_vin_1000",
                fundMiniGame[2],slot11IconWildMinigameFund + "_vin_1000"));
        Debug.trace("INIT " + this.gameName + " DONE");
        this.referenceId = this.slotService.getLastReferenceId(this.gameName);
        Debug.trace("START " + this.gameName + " REFERENCE ID= " + this.referenceId);
        CacheServiceImpl sv = new CacheServiceImpl();
        try {
            sv.removeKey(this.gameName + "_last_day_x2");
        } catch (KeyNotFoundException e2) {
            Debug.trace("KEY NOT FOUND");
        }
        int lastDayFinish = SlotUtils.getLastDayX2(this.gameName);
        this.ngayX2 = SlotUtils.calculateTimePokeGoX2AsString(this.gameName, SlotUtils.getX2Days(this.gameName), lastDayFinish);
        int nextX2Time = SlotUtils.calculateTimePokeGoX2(this.gameName, SlotUtils.getX2Days(this.gameName), lastDayFinish);
        Debug.trace(this.gameName + " Ngay X2: " + this.ngayX2 + ", remain time = " + nextX2Time);
        /*if (nextX2Time >= 0) {
            BitZeroServer.getInstance().getTaskScheduler().schedule(this.pokeGoX2Task, nextX2Time, TimeUnit.SECONDS);
        } else {
            this.startX2();
        }*/
        this.getParentExtension().addEventListener(BZEventType.USER_DISCONNECT, this);
//        BitZeroServer.getInstance().getTaskScheduler().scheduleAtFixedRate(this.gameLoopTask, 10, 1, TimeUnit.SECONDS);

        BitZeroServer.getInstance().getTaskScheduler().scheduleAtFixedRate(new BotJackPotChiemtinhTimer(timeJackPot, this), 10, 5, TimeUnit.SECONDS);

//        List<String> bots = BotMinigame.getBots(10, "vin");
//        ChiemTinhRoom room = (ChiemTinhRoom)this.rooms.get(String.valueOf(this.gameName) + "_vin_10");
//        for(int i = 0;i<10000;i++) {
//            room.play("vuonquang1123", this.fullLines);
//        }
        _instance = this;
    }

    @Override
    public long getBaseBetting(byte roomId) {

        switch (roomId) {
            case 0: {
                return 10L;
            }
            case 1: {
                return 100L;
            }
            case 2: {
                return 1000L;
            }
            case 3: {
                return 1000L;
            }
            case 4: {
                return 100L;
            }
            case 5: {
                return 1000L;
            }
            case 6: {
                return 10000L;
            }
        }
        return 0L;
    }

    public void handleServerEvent(IBZEvent ibzevent) throws BZException {
        if (ibzevent.getType() == BZEventType.USER_DISCONNECT) {
            User user = (User)ibzevent.getParameter((IBZEventParam)BZEventParam.USER);
            this.userDis(user);
        }
    }

    private void userDis(User user) {
        ChiemTinhRoom room = (ChiemTinhRoom)user.getProperty((Object)("MGROOM_" + this.gameName + "_INFO"));
        if (room != null) {
            room.quitRoom(user);
            room.stopAutoPlay(user);
        }
    }

    @Override
    public void handleClientRequest(User user, DataCmd dataCmd) {
        Debug.trace((Object)("chiemtinh handleClientRequest " + dataCmd.getId()));

        switch (dataCmd.getId()) {
            case 6003: {
                this.subScribe(user, dataCmd);
                break;
            }
            case 6004: {
                this.unSubScribe(user, dataCmd);
                break;
            }
            case 6005: {
                this.changeRoom(user, dataCmd);
                break;
            }
            case 6006: {
                this.autoPlay(user, dataCmd);
                break;
            }
            case 6001: {
                this.play(user, dataCmd);
                break;
            }
            case 6013: {
                this.minimize(user, dataCmd);
            }
        }
    }

    @Override
    public long getNewReferenceId() {
        return ++this.referenceId;
    }

    protected void subScribe(User user, DataCmd dataCmd) {
        SubscribeChiemtinhCmd cmd = new SubscribeChiemtinhCmd(dataCmd);
        ChiemTinhRoom room = (ChiemTinhRoom)this.getRoom(cmd.roomId);
        if (room != null) {
            room.joinRoom(user);
            room.userMaximize(user);
            room.updatePot(user);
            this.updateAvengerInfo(user, room);
        } else {
            Debug.trace((Object)(String.valueOf(this.gameName) + " SUBSCRIBE: room " + cmd.roomId + " not found"));
        }
    }

    private void updateAvengerInfo(User user, ChiemTinhRoom room) {
        ChiemtinhInfoMsg msg = new ChiemtinhInfoMsg();
        msg.ngayX2 = this.ngayX2;
        msg.remain = 0;
        msg.currentMoney = this.userService.getMoneyUserCache(user.getName(), "vin");
        SlotFreeSpin freeSpin = this.slotService.getLuotQuayFreeSlot(String.valueOf(this.gameName) + room.getBetValue(), user.getName());
        if (freeSpin != null && freeSpin.getLines() != null) {
            msg.freeSpin = (byte)freeSpin.getNum();
            msg.lines = freeSpin.getLines();
        }
        this.send((BaseMsg)msg, user);
    }

    protected void unSubScribe(User user, DataCmd dataCmd) {
        UnSubscribeChiemtinhCmd cmd = new UnSubscribeChiemtinhCmd(dataCmd);
        ChiemTinhRoom room = (ChiemTinhRoom)this.getRoom(cmd.roomId);
        if (room != null) {
            room.stopAutoPlay(user);
            room.quitRoom(user);
        } else {
            Debug.trace((Object)(String.valueOf(this.gameName) + " UNSUBSCRIBE: room " + cmd.roomId + " not found"));
        }
    }

    protected void minimize(User user, DataCmd dataCmd) {
        MinimizeAuditionCmd cmd = new MinimizeAuditionCmd(dataCmd);
        ChiemTinhRoom room = (ChiemTinhRoom)this.getRoom(cmd.roomId);
        if (room != null) {
            room.quitRoom(user);
            room.userMinimize(user);
        } else {
            Debug.trace((Object)(String.valueOf(this.gameName) + " MINIMIZE: room " + cmd.roomId + " not found"));
        }
    }

    protected void changeRoom(User user, DataCmd dataCmd) {
        ChangeRoomChiemtinhCmd cmd = new ChangeRoomChiemtinhCmd(dataCmd);
        ChiemTinhRoom roomLeaved = (ChiemTinhRoom)this.getRoom(cmd.roomLeavedId);
        ChiemTinhRoom roomJoined = (ChiemTinhRoom)this.getRoom(cmd.roomJoinedId);
        if (roomLeaved != null && roomJoined != null) {
            roomLeaved.stopAutoPlay(user);
            roomLeaved.quitRoom(user);
            roomJoined.joinRoom(user);
            roomJoined.updatePot(user);
            this.updateAvengerInfo(user, roomJoined);
        } else {
            Debug.trace((Object)(String.valueOf(this.gameName) + ": change room error, leaved= " + cmd.roomLeavedId + ", joined= " + cmd.roomJoinedId));
        }
    }

    private void play(User user, DataCmd dataCmd) {
        PlayChiemtinhCmd cmd = new PlayChiemtinhCmd(dataCmd);
        ChiemTinhRoom room = (ChiemTinhRoom)user.getProperty("MGROOM_" + this.gameName + "_INFO");
        Debug.trace("chiemtinh gamename ="+this.gameName);
        Debug.trace("chiemtinh room="+room);
        if (room != null) {
            try {
                room.play(user, cmd.lines);
            } catch (Exception ex) {
                StringWriter sw = new StringWriter();
                PrintWriter pw = new PrintWriter(sw);
                ex.printStackTrace(pw);
                String sStackTrace = sw.toString(); // stack trace as a string
                Debug.trace((Object)sStackTrace);
                Debug.trace((Object)ex.getMessage());
            }
        }
    }

    private void autoPlay(User user, DataCmd dataCMD) {
        AutoPlayChiemtinhCmd cmd = new AutoPlayChiemtinhCmd(dataCMD);
        ChiemTinhRoom room = (ChiemTinhRoom)user.getProperty((Object)("MGROOM_" + this.gameName + "_INFO"));
        if (room != null) {
            if (cmd.autoPlay == 1) {
                try {
                    short result = room.play(user, cmd.lines);
                    if (result != 3 && result != 4 && result != 101 && result != 102 && result != 100) {
                        room.autoPlay(user, cmd.lines, result);
                    } else {
                        room.forceStopAutoPlay(user);
                    }
                } catch (Exception ex) {
                    Logger.getLogger(ChiemTinhModule.class.getName()).log(Level.SEVERE, null, ex);
                }
            } else {
                room.stopAutoPlay(user);
            }
        }
    }

    @Override
    protected String getRoomName(short moneyType, long baseBetting) {
        String moneyTypeStr = "xu";
        if (moneyType == 1) {
            moneyTypeStr = "vin";
        }
        return String.valueOf(this.gameName) + "_" + moneyTypeStr + "_" + baseBetting;
    }

    @Override
    protected void gameLoop() {
//        List<String> bots;
//        ChiemTinhRoom room;
//        ++this.countBot100;
//        if (this.countBot100 >= this.getCountTimeBot(String.valueOf(this.gameName) + "_bot_100")) {
//            if (this.countBot100 == this.getCountTimeBot(String.valueOf(this.gameName) + "_bot_100")) {
//                bots = BotMinigame.getBots(ConfigGame.getIntValue(String.valueOf(this.gameName) + "_num_bot_100"), "vin");
//                for (String bot : bots) {
//                    if (bot == null) continue;
//                    room = (ChiemTinhRoom)this.rooms.get(String.valueOf(this.gameName) + "_vin_10");
//                    long referenceId = getNewReferenceId();
//                    room.playNormal(bot, this.fullLines, referenceId);
//                }
//            }
//            this.countBot100 = 0;
//        }
//        ++this.countBot1000;
//        if (this.countBot1000 >= this.getCountTimeBot(String.valueOf(this.gameName) + "_bot_1000")) {
//            if (this.countBot1000 == this.getCountTimeBot(String.valueOf(this.gameName) + "_bot_1000")) {
//                bots = BotMinigame.getBots(ConfigGame.getIntValue(String.valueOf(this.gameName) + "_num_bot_1000"), "vin");
//                for (String bot : bots) {
//                    if (bot == null) continue;
//                    room = (ChiemTinhRoom)this.rooms.get(String.valueOf(this.gameName) + "_vin_100");
//                    long referenceId = getNewReferenceId();
//                    room.playNormal(bot, this.fullLines, referenceId);
//                }
//            }
//            this.countBot1000 = 0;
//        }
//        ++this.countBot10000;
//        if (this.countBot10000 >= this.getCountTimeBot(String.valueOf(this.gameName) + "_bot_10000")) {
//            if (this.countBot10000 == this.getCountTimeBot(String.valueOf(this.gameName) + "_bot_10000")) {
//                bots = BotMinigame.getBots(ConfigGame.getIntValue(String.valueOf(this.gameName) + "_num_bot_10000"), "vin");
//                for (String bot : bots) {
//                    if (bot == null) continue;
//                    room = (ChiemTinhRoom)this.rooms.get(String.valueOf(this.gameName) + "_vin_1000");
//                    long referenceId = getNewReferenceId();
//                    room.playNormal(bot, this.fullLines, referenceId);
//                }
//            }
//            this.countBot10000 = 0;
//        }
    }
}

