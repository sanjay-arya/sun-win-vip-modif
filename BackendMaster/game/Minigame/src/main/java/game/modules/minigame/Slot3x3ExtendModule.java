package game.modules.minigame;

import bitzero.server.BitZeroServer;
import bitzero.server.core.BZEventParam;
import bitzero.server.core.BZEventType;
import bitzero.server.core.IBZEvent;
import bitzero.server.entities.User;
import bitzero.server.exceptions.BZException;
import bitzero.server.extensions.BaseClientRequestHandler;
import bitzero.server.extensions.data.DataCmd;
import bitzero.util.common.business.Debug;
import com.vinplay.dal.service.CacheService;
import com.vinplay.dal.service.MiniGameService;
import com.vinplay.dal.service.impl.CacheServiceImpl;
import com.vinplay.dal.service.impl.MiniGameServiceImpl;
import com.vinplay.vbee.common.utils.CommonUtils;
import game.SlotExtendService;
import game.SlotExtendServiceImplement;
import game.modules.minigame.cmd.MiniGameCMD;

import game.modules.minigame.cmd.rev.slot3x3.AutoPlaySlotExtendCmd;
import game.modules.minigame.cmd.rev.slot3x3.ChangeRoomSlotExtendCmd;
import game.modules.minigame.cmd.rev.slot3x3.SubscribeSlotExtendCmd;
import game.modules.minigame.cmd.rev.slot3x3.UnSubscribeSlotExtendCmd;
import game.modules.minigame.cmd.send.slot3x3.RequestSlotExtendSpin;
import game.modules.minigame.cmd.send.slot3x3.UpdatePotSlotExtend;
import game.modules.minigame.room.MGRoom;
import game.modules.minigame.room.MGRoomSlotExtend;
import game.utils.ConfigGame;
import game.utils.GameUtils;

import java.util.HashMap;
import java.util.HashSet;
import java.util.Map;
import java.util.Set;
import java.util.concurrent.TimeUnit;

public class Slot3x3ExtendModule extends BaseClientRequestHandler {

    private static Map<String, MGRoom> rooms = new HashMap();
    private MiniGameService service = new MiniGameServiceImpl();
    private SlotExtendService slotExtendService = new SlotExtendServiceImplement();
    private static long referenceId = 1L;
    private GameLoopTask gameLoopTask;
    protected CacheService sv;
    private long countUpdateJackpot;
    private Set<User> usersSubJackpot;

    public Slot3x3ExtendModule() {
        this.gameLoopTask = new GameLoopTask();
        this.sv = new CacheServiceImpl();
    }

    public void init() {
        super.init();
        long[] pots = new long[6];
        long[] funds = new long[6];
        int[] initPotValues = new int[6];
        try {
            String initPotValuesStr = ConfigGame.getValueString("slot_extend_init_pot_values");
            String[] arr = initPotValuesStr.split(",");
            for (int i = 0; i < arr.length; i++) {
                initPotValues[i] = Integer.parseInt(arr[i]);
            }
            pots = this.service.getPots("SlotExtend");
            Debug.trace("SLOT EXTEND POTS: " + CommonUtils.arrayLongToString(pots));
            funds = this.service.getFunds("SlotExtend");
            Debug.trace("SLOT EXTEND FUNDS: " + CommonUtils.arrayLongToString(funds));
        } catch (Exception e) {
            Debug.trace((Object[]) new Object[]{"Init SLOT EXTEND error ", e.getMessage()});
        }
        rooms.put("SlotExtend_vin_10", new MGRoomSlotExtend("SlotExtend_vin_10", (short) 1, pots[0], funds[0], 10, initPotValues[0]));
        rooms.put("SlotExtend_vin_100", new MGRoomSlotExtend("SlotExtend_vin_100", (short) 1, pots[1], funds[1], 100, initPotValues[1]));
        rooms.put("SlotExtend_vin_1000", new MGRoomSlotExtend("SlotExtend_vin_1000", (short) 1, pots[2], funds[2], 1000, initPotValues[2]));
        Debug.trace("INIT SLOT_EXTEND DONE");
        getParentExtension().addEventListener(BZEventType.USER_DISCONNECT, this);
        referenceId = this.slotExtendService.getLastReferenceId();
        Debug.trace("START SLOT_EXTEND REFERENCE ID= " + referenceId);
        this.usersSubJackpot = new HashSet<>();
        BitZeroServer.getInstance().getTaskScheduler().scheduleAtFixedRate(this.gameLoopTask, 10, 1, TimeUnit.SECONDS);
    }

    public static long getNewRefenceId() {
        return ++referenceId;
    }


    public void handleServerEvent(IBZEvent ibzevent) throws BZException {
        if (ibzevent.getType() == BZEventType.USER_DISCONNECT) {
            User user = (User) ibzevent.getParameter(BZEventParam.USER);
            userDis(user);
        }
    }

    private void userDis(User user) {
        MGRoomSlotExtend room = (MGRoomSlotExtend) user.getProperty("MGROOM_SLOT_EXTEND_INFO");
        if (room != null) {
            room.quitRoom(user);
            room.stopAutoPlay(user);
        }
    }

    public void handleClientRequest(User user, DataCmd dataCmd) {
        System.out.println("handleClientRequest " + dataCmd.getId());
        switch (dataCmd.getId()) {
            case MiniGameCMD.CMD_SLOT_EXTEND_SUB:
                subScribeSlotExtend(user, dataCmd);
                break;

            case MiniGameCMD.CMD_SLOT_EXTEND_UNSUB:
                unSubScribePokeGo(user, dataCmd);
                break;

            case MiniGameCMD.CMD_SLOT_EXTEND_CHANGE_ROOM:
                changeRoom(user, dataCmd);
                break;

            case MiniGameCMD.CMD_SLOT_EXTEND_AUTOSPIN:
                if (GameUtils.disablePlayMiniGame(user)) {
                    return;
                }
                autoPlay(user, dataCmd);
                break;

            case MiniGameCMD.CMD_SLOT_EXTEND_SPIN:
                if (GameUtils.disablePlayMiniGame(user)) {
                    return;
                }
                playSlotExtend(user, dataCmd);
        }
    }

    private void subScribeSlotExtend(User user, DataCmd dataCmd) {
        SubscribeSlotExtendCmd cmd = new SubscribeSlotExtendCmd(dataCmd);
        MGRoomSlotExtend room = getRoom(cmd.roomId);
        if (room != null) {
            room.joinRoom(user);
            room.updatePotToUser(user);
        } else {
            Debug.trace("MSlotExtend SUBSCRIBE: room " + cmd.roomId + " not found");
        }
        if (user != null)
            this.usersSubJackpot.add(user);
    }

    private void unSubScribePokeGo(User user, DataCmd dataCmd) {
        UnSubscribeSlotExtendCmd cmd = new UnSubscribeSlotExtendCmd(dataCmd);
        MGRoomSlotExtend room = getRoom(cmd.roomId);
        if (room != null) {
            room.stopAutoPlay(user);
            room.quitRoom(user);
        } else {
            Debug.trace("MGRoomSlotExtend UNSUBSCRIBE: room " + cmd.roomId + " not found");
        }
        if (user != null)
            this.usersSubJackpot.remove(user);
    }

    private void changeRoom(User user, DataCmd dataCmd) {
        ChangeRoomSlotExtendCmd cmd = new ChangeRoomSlotExtendCmd(dataCmd);
        MGRoomSlotExtend roomLeaved = getRoom(cmd.roomLeavedId);
        MGRoomSlotExtend roomJoined = getRoom(cmd.roomJoinedId);
        if ((roomLeaved != null) && (roomJoined != null)) {
            roomLeaved.stopAutoPlay(user);
            roomLeaved.quitRoom(user);
            roomJoined.joinRoom(user);
            roomJoined.updatePotToUser(user);
        }
    }

    private void playSlotExtend(User user, DataCmd dataCmd) {
        RequestSlotExtendSpin cmd = new RequestSlotExtendSpin(dataCmd);
        MGRoomSlotExtend room = (MGRoomSlotExtend) user.getProperty("MGROOM_SLOT_EXTEND_INFO");
        if (room != null) {
            room.play(user, cmd.gold);
        }

    }

    private void autoPlay(User user, DataCmd dataCMD) {
        AutoPlaySlotExtendCmd cmd = new AutoPlaySlotExtendCmd(dataCMD);
        MGRoomSlotExtend room = (MGRoomSlotExtend) user.getProperty("MGROOM_SLOT_EXTEND_INFO");
        if (room != null) {
            if (cmd.autoPlay == 1) {
                short result = room.play(user, cmd.gold);
                if ((result != 3) && (result != 4) && (result != 101) && (result != 102) && (result != 100)) {
                    room.autoPlay(user, cmd.gold);
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
        return "SlotExtend_" + moneyTypeStr + "_" + baseBetting;
    }

    private MGRoomSlotExtend getRoom(byte roomId) {
        short moneyType = getMoneyTypeFromRoomId(roomId);
        long baseBetting = getBaseBetting(roomId);
        String roomName = getRoomName(moneyType, baseBetting);
        MGRoomSlotExtend room = (MGRoomSlotExtend) rooms.get(roomName);
        return room;
    }

    private short getMoneyTypeFromRoomId(byte roomId) {
        if ((0 <= roomId) && (roomId < 3)) {
            return 1;
        }
        return 0;
    }

    private long getBaseBetting(byte roomId) {
        switch (roomId) {
            case 0:
                return 10L;

            case 1:

            case 3:
                return 100L;

            case 2:

            case 4:
                return 1000L;

            case 5:
                return 10000L;
        }

        return 0L;
    }

    public void updateJackpot() {
        UpdatePotSlotExtend msg;
        try {
            com.vinplay.usercore.service.impl.CacheServiceImpl cacheService = new com.vinplay.usercore.service.impl.CacheServiceImpl();
            int miniPoker100 = cacheService.getValueInt("SlotExtend_vin_10");
            int miniPoker1000 = cacheService.getValueInt("SlotExtend_vin_100");
            int miniPoker10000 = cacheService.getValueInt("SlotExtend_vin_1000");

            msg = new UpdatePotSlotExtend();
            msg.value1 = miniPoker100;
            msg.value2 = miniPoker1000;
            msg.value3 = miniPoker10000;

            for (User user : this.usersSubJackpot) {
                if (user != null)
                    send(msg, user);
            }
        } catch (Exception e) {
            Debug.trace("Update jackpot exception: " + e.getMessage());
        }
    }

    private void gameLoop() {
        this.countUpdateJackpot += 1L;
        if (this.countUpdateJackpot >= ConfigGame.getIntValue("update_jackpot_time")) {
            updateJackpot();
            this.countUpdateJackpot = 0L;
        }
    }

    private final class GameLoopTask implements Runnable {
        private GameLoopTask() {

        }

        public void run() {
            Slot3x3ExtendModule.this.gameLoop();
        }
    }

}
