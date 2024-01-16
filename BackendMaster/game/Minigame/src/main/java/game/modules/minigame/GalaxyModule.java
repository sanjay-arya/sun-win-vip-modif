package game.modules.minigame;

import bitzero.server.BitZeroServer;
import bitzero.server.core.BZEventParam;
import bitzero.server.core.BZEventType;
import bitzero.server.core.IBZEvent;
import bitzero.server.core.IBZEventParam;
import bitzero.server.entities.User;
import bitzero.server.exceptions.BZException;
import bitzero.server.extensions.BaseClientRequestHandler;
import bitzero.server.extensions.data.BaseMsg;
import bitzero.server.extensions.data.DataCmd;
import bitzero.util.ExtensionUtility;
import bitzero.util.common.business.Debug;
import com.vinplay.dal.service.CacheService;
import com.vinplay.dal.service.GalaxyService;
import com.vinplay.dal.service.MiniGameService;
import com.vinplay.dal.service.impl.CacheServiceImpl;
import com.vinplay.dal.service.impl.GalaxyServiceImpl;
import com.vinplay.dal.service.impl.MiniGameServiceImpl;
import com.vinplay.vbee.common.enums.Games;
import com.vinplay.vbee.common.exceptions.KeyNotFoundException;
import com.vinplay.vbee.common.utils.CommonUtils;
import game.modules.BotJackPotTimer.BotJackPotGalaxyTimer;
import game.modules.minigame.cmd.rev.galaxy.*;
import game.modules.minigame.cmd.send.galaxy.GalaxyX2Msg;
import game.modules.minigame.entities.BotMinigame;
import game.modules.minigame.room.MGRoom;
import game.modules.minigame.room.MGRoomGalaxy;
import game.utils.ConfigGame;
import game.utils.GameUtils;

import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.concurrent.TimeUnit;

public class GalaxyModule extends BaseClientRequestHandler {
    private static Runnable galaxyX2Task = new GalaxyX2Task();
    public static Map<String, MGRoom> rooms = new HashMap<String, MGRoom>();
    private MiniGameService service = new MiniGameServiceImpl();
    private GalaxyService pgService = new GalaxyServiceImpl();
    private static long referenceId = 1L;
    private static String ngayX2;
    private GameLoopTask gameLoopTask = new GameLoopTask();
    private int countBot100 = 0;
    private int countBot1000 = 0;
    private int countBot10000 = 0;
    private String fullLines = "1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20";
    protected CacheService sv = new CacheServiceImpl();
    public String gameName = Games.GALAXY.getName();

    private static String slot3x3JackpotFund = "Galaxy_Jackpot_Fund";
    public static final String keyBotJackpotSlot3x3 = "Bot_Galaxy_time";

    private static GalaxyModule _instance;

    public static GalaxyModule getInstance(){
        return _instance;
    }

    public void init() {
        super.init();
        long[] pots = new long[6];
        long[] funds = new long[6];
//        int[] initPotValues = new int[6];
        int[] initPotValues = {500000,5000000,50000000,500000,5000000,50000000};
        long[] fundsJackPot = new long[6];
        long[] timeJackPot = new long[3];
        try {
            pots = this.service.getPots(Games.GALAXY.getName());
            Debug.trace(this.gameName+" POTS: " + CommonUtils.arrayLongToString(pots));
            funds = this.service.getFunds(Games.GALAXY.getName());
            Debug.trace(this.gameName+" FUNDS: " + CommonUtils.arrayLongToString(funds));

            fundsJackPot = this.service.getFunds(slot3x3JackpotFund);
            Debug.trace("Slot3x3 FUNDS JACKPOT: " + CommonUtils.arrayLongToString(fundsJackPot));
            timeJackPot = this.service.getFunds(keyBotJackpotSlot3x3);
            Debug.trace("Slot3x3 TIME JACKPOT: " + CommonUtils.arrayLongToString(timeJackPot));
        }
        catch (Exception e) {
            Debug.trace("Init "+this.gameName+" error ", e.getMessage());
        }
        rooms.put(Games.GALAXY.getName() + "_vin_10", new MGRoomGalaxy(this, Games.GALAXY.getName() + "_vin_10", (short)1, pots[0], funds[0], 100, initPotValues[0], slot3x3JackpotFund + "_vin_10", fundsJackPot[0]));
        rooms.put(Games.GALAXY.getName() + "_vin_100", new MGRoomGalaxy(this, Games.GALAXY.getName() + "_vin_100", (short)1, pots[1], funds[1], 1000, initPotValues[1],slot3x3JackpotFund + "_vin_100", fundsJackPot[1]));
        rooms.put(Games.GALAXY.getName() + "_vin_1000", new MGRoomGalaxy(this, Games.GALAXY.getName() + "_vin_1000", (short)1, pots[2], funds[2], 10000, initPotValues[2], slot3x3JackpotFund + "_vin_100", fundsJackPot[2]));
        rooms.put(Games.GALAXY.getName() + "_xu_1000", new MGRoomGalaxy(this, Games.GALAXY.getName() + "_xu_1000", (short)0, pots[3], funds[3], 1000, initPotValues[3],slot3x3JackpotFund + "_xu_100", fundsJackPot[3]));
        rooms.put(Games.GALAXY.getName() + "_xu_10000", new MGRoomGalaxy(this, Games.GALAXY.getName() + "_xu_10000", (short)0, pots[4], funds[4], 10000, initPotValues[4],slot3x3JackpotFund + "_xu_1000", fundsJackPot[4]));
        rooms.put(Games.GALAXY.getName() + "_xu_100000", new MGRoomGalaxy(this, Games.GALAXY.getName() + "_xu_100000", (short)0, pots[5], funds[5], 100000, initPotValues[5], slot3x3JackpotFund + "_xu_10000", fundsJackPot[5]));
        Debug.trace("INIT "+this.gameName+" DONE");
        this.getParentExtension().addEventListener(BZEventType.USER_DISCONNECT, this);
        referenceId = this.pgService.getLastReferenceId();
        Debug.trace("START "+this.gameName+" REFERENCE ID= " + referenceId);
        CacheServiceImpl sv = new CacheServiceImpl();
        try {
            sv.removeKey(this.gameName + "_last_day_x2");
        }
        catch (KeyNotFoundException e) {
            //Debug.trace((Object)"KEY NOT FOUND");
        }

        BitZeroServer.getInstance().getTaskScheduler().scheduleAtFixedRate(new BotJackPotGalaxyTimer(timeJackPot), 10, 5, TimeUnit.SECONDS);

        _instance = this;
    }

    public static long getNewRefenceId() {
        return ++referenceId;
    }

    public void handleServerEvent(IBZEvent ibzevent) throws BZException {
        if (ibzevent.getType() == BZEventType.USER_DISCONNECT) {
            User user = (User)ibzevent.getParameter((IBZEventParam) BZEventParam.USER);
            this.userDis(user);
        }
    }

    private void userDis(User user) {
        MGRoomGalaxy room = (MGRoomGalaxy)user.getProperty((Object)"MGROOM_"+this.gameName+"_INFO");
        if (room != null) {
            room.quitRoom(user);
            room.stopAutoPlay(user);
        }
    }

    public void handleClientRequest(User user, DataCmd dataCmd) {
        switch (dataCmd.getId()) {
            case 8003: {
                this.subScribeGalaxy(user, dataCmd);
                break;
            }
            case 8004: {
                this.unSubScribeGalaxy(user, dataCmd);
                break;
            }
            case 8005: {
                this.changeRoom(user, dataCmd);
                break;
            }
            case 8006: {
                if (GameUtils.disablePlayMiniGame(user)) {
                    return;
                }
                this.autoPlay(user, dataCmd);
                break;
            }
            case 8001: {
                if (GameUtils.disablePlayMiniGame(user)) {
                    return;
                }
                this.playGalaxy(user, dataCmd);
            }
        }
    }

    private void subScribeGalaxy(User user, DataCmd dataCmd) {
        SubscribeGalaxyCmd cmd = new SubscribeGalaxyCmd(dataCmd);
        MGRoomGalaxy room = this.getRoom(cmd.roomId);
        if (room != null) {
            room.joinRoom(user);
            room.updatePotToUser(user);
            GalaxyX2Msg msg = new GalaxyX2Msg();
            msg.ngayX2 = "";
            this.send((BaseMsg)msg, user);
        } else {
            Debug.trace((Object)(this.gameName+" SUBSCRIBE: room " + cmd.roomId + " not found"));
        }
    }

    private void unSubScribeGalaxy(User user, DataCmd dataCmd) {
        UnSubscribeGalaxyCmd cmd = new UnSubscribeGalaxyCmd(dataCmd);
        MGRoomGalaxy room = this.getRoom(cmd.roomId);
        if (room != null) {
            room.stopAutoPlay(user);
            room.quitRoom(user);
        } else {
            Debug.trace((Object)(this.gameName+" UNSUBSCRIBE: room " + cmd.roomId + " not found"));
        }
    }

    private void changeRoom(User user, DataCmd dataCmd) {
        ChangeRoomGalaxyCmd cmd = new ChangeRoomGalaxyCmd(dataCmd);
        MGRoomGalaxy roomLeaved = this.getRoom(cmd.roomLeavedId);
        MGRoomGalaxy roomJoined = this.getRoom(cmd.roomJoinedId);
        if (roomLeaved != null && roomJoined != null) {
            roomLeaved.stopAutoPlay(user);
            roomLeaved.quitRoom(user);
            roomJoined.joinRoom(user);
            roomJoined.updatePotToUser(user);
        }
    }

    private void playGalaxy(User user, DataCmd dataCmd) {
        PlayGalaxyCmd cmd = new PlayGalaxyCmd(dataCmd);
        MGRoomGalaxy room = (MGRoomGalaxy)user.getProperty((Object)"MGROOM_"+this.gameName+"_INFO");
        if (room != null) {
            room.play(user, cmd.lines);
        }
    }

    private void autoPlay(User user, DataCmd dataCMD) {
        AutoPlayGalaxyCmd cmd = new AutoPlayGalaxyCmd(dataCMD);
        MGRoomGalaxy room = (MGRoomGalaxy)user.getProperty((Object)"MGROOM_"+this.gameName+"_INFO");
        if (room != null) {
            if (cmd.autoPlay == 1) {
                short result = room.play(user, cmd.lines);
                if (result != 3 && result != 4 && result != 101 && result != 102 && result != 100) {
                    room.autoPlay(user, cmd.lines);
                } else {
                    room.forceStopAutoPlay(user);
                }
            } else {
                room.stopAutoPlay(user);
            }
        }
    }

    private String getRoomName(short moneyType, long baseBetting) {
        String moneyTypeStr = "xu";
        if (moneyType == 1) {
            moneyTypeStr = "vin";
        }
        return Games.GALAXY.getName() + "_" + moneyTypeStr + "_" + baseBetting;
    }

    private MGRoomGalaxy getRoom(byte roomId) {
        short moneyType = this.getMoneyTypeFromRoomId(roomId);
        long baseBetting = this.getBaseBetting(roomId);
        String roomName = this.getRoomName(moneyType, baseBetting);
        MGRoomGalaxy room = (MGRoomGalaxy)rooms.get(roomName);
        return room;
    }

    private short getMoneyTypeFromRoomId(byte roomId) {
//        return 0 <= roomId && roomId < 3;
        if ((0 <= roomId) && (roomId < 3)) {
            return 1;
        }
        return 0;
    }

    private long getBaseBetting(byte roomId) {
        switch (roomId) {
            case 0: {
                return 100L;
            }
            case 1: {
                return 1000L;
            }
            case 2: {
                return 10000L;
            }
            case 3: {
                return 1000L;
            }
            case 4: {
                return 10000L;
            }
            case 5: {
                return 100000L;
            }
        }
        return 0L;
    }

    private int getCountTimeBot100() {
        int n = ConfigGame.getIntValue(this.gameName+"_bot_100", 0);
        if (n == 0) {
            return 0;
        }
        if (BotMinigame.isNight()) {
            n *= 3;
        }
        return n;
    }

    private int getCountTimeBot1000() {
        int n = ConfigGame.getIntValue(this.gameName+"_bot_1000", 0);
        if (n == 0) {
            return 0;
        }
        if (BotMinigame.isNight()) {
            n *= 5;
        }
        return n;
    }

    private int getCountTimeBot10000() {
        int n = ConfigGame.getIntValue(this.gameName+"_bot_10000", 0);
        if (n == 0) {
            return 0;
        }
        if (BotMinigame.isNight()) {
            n *= 10;
        }
        return n;
    }

    private void gameLoop() {
        List<String> bots;
        MGRoomGalaxy room;
        ++this.countBot100;
        if (this.countBot100 >= this.getCountTimeBot100()) {
            this.countBot100 = 0;
            bots = BotMinigame.getBots(ConfigGame.getIntValue(this.gameName+"_num_bot_100"), "vin");
            for (String bot : bots) {
                if (bot == null) continue;
                room = (MGRoomGalaxy)rooms.get(Games.GALAXY.getName() + "_vin_10");
                room.play(bot, this.fullLines);
            }
        }
        ++this.countBot1000;
        if (this.countBot1000 >= this.getCountTimeBot1000()) {
            this.countBot1000 = 0;
            bots = BotMinigame.getBots(ConfigGame.getIntValue(this.gameName+"_num_bot_1000"), "vin");
            for (String bot : bots) {
                if (bot == null) continue;
                room = (MGRoomGalaxy)rooms.get(Games.GALAXY.getName() + "_vin_100");
                room.play(bot, this.fullLines);
            }
        }
        ++this.countBot10000;
        if (this.countBot10000 >= this.getCountTimeBot10000()) {
            this.countBot10000 = 0;
            bots = BotMinigame.getBots(ConfigGame.getIntValue(this.gameName+"_num_bot_10000"), "vin");
            for (String bot : bots) {
                if (bot == null) continue;
                room = (MGRoomGalaxy)rooms.get(Games.GALAXY.getName() + "_vin_1000");
                room.play(bot, this.fullLines);
            }
        }
    }

    public void sendMsgToAllUsers(BaseMsg msg) {
        SendMsgToAlLUsersThread t = new SendMsgToAlLUsersThread(msg);
        t.start();
    }

    protected void sendMessageToTS(BaseMsg msg) {
        List users = ExtensionUtility.globalUserManager.getAllUsers();
        if (users != null) {
            this.send(msg, users);
        }

    }

    private static final class GalaxyX2Task
            implements Runnable {
        private GalaxyX2Task() {
        }

        @Override
        public void run() {

        }
    }

    private final class GameLoopTask
            implements Runnable {
        private GameLoopTask() {
        }

        @Override
        public void run() {
            GalaxyModule.this.gameLoop();
        }
    }

    protected final class SendMsgToAlLUsersThread
            extends Thread {
        private BaseMsg msg;

        protected SendMsgToAlLUsersThread(BaseMsg msg) {
            this.msg = msg;
        }

        @Override
        public void run() {
            GalaxyModule.this.sendMessageToTS(this.msg);
        }
    }
}
