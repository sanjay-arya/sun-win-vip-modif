package game.modules.BotJackPotTimer;

import bitzero.util.common.business.Debug;
import com.vinplay.vbee.common.enums.Games;
import game.GameConfig.GameConfig;
import game.modules.minigame.GalaxyModule;
import game.modules.minigame.entities.BotMinigame;
import game.modules.minigame.room.MGRoomGalaxy;
import game.utils.GameUtil;

import java.util.List;

public class BotJackPotGalaxyTimer implements Runnable {
    public boolean isInitBot = false;
    public List<String> bots;
    private long timeJackPot_10 = 0;
    private long timeJackPot_100 = 0;
    private long timeJackPot_1000 = 0;

    public BotJackPotGalaxyTimer(long[] timeJackpot){
        this.timeJackPot_10 = timeJackpot[0];
        this.timeJackPot_100 = timeJackpot[1];
        this.timeJackPot_1000 = timeJackpot[2];
    }

    @Override
    public void run() {
        try {
//           Debug.trace("BotJackPotMinipokerTimer");
            if (!this.isInitBot) {
                try{
                    this.bots = BotMinigame.getBotsJackPot(500, "vin");
                }catch (Exception e){
                    Debug.warn("error init bot");
                }
                this.isInitBot = true;

            }
            int moneyToJackPot_10 = GameConfig.getInstance().galaxyBotConfig.randomJackPotPer5s(0);
            MGRoomGalaxy room10 = (MGRoomGalaxy) GalaxyModule.rooms.get(Games.GALAXY.getName() + "_vin_10");
            room10.addMoneyToPot(moneyToJackPot_10);
            int moneyToJackPot_100 = GameConfig.getInstance().galaxyBotConfig.randomJackPotPer5s(1);
            MGRoomGalaxy room100 = (MGRoomGalaxy) GalaxyModule.rooms.get(Games.GALAXY.getName()+ "_vin_100");
            room100.addMoneyToPot(moneyToJackPot_100);
            int moneyToJackPot_1000 = GameConfig.getInstance().galaxyBotConfig.randomJackPotPer5s(2);
            MGRoomGalaxy room1000 = (MGRoomGalaxy) GalaxyModule.rooms.get(Games.GALAXY.getName() + "_vin_1000");
            room1000.addMoneyToPot(moneyToJackPot_1000);

            long currentTime = GameUtil.getTimeStampInSeconds();
            int time = 0;
            if(currentTime > timeJackPot_10){
                time = GameConfig.getInstance().galaxyBotConfig.randomTimeBotEat(0);
                timeJackPot_10 = currentTime + time;
                room10.botEatJackpot(GalaxyModule.keyBotJackpotSlot3x3 +
                        "_vin_10",timeJackPot_10, this.bots.get(GameUtil.randomMax(this.bots.size())));
            }
            if(currentTime > timeJackPot_100){
                time = GameConfig.getInstance().galaxyBotConfig.randomTimeBotEat(1);
                timeJackPot_100 = currentTime + time;
                room100.botEatJackpot(GalaxyModule.keyBotJackpotSlot3x3 +
                        "_vin_100",timeJackPot_100, this.bots.get(GameUtil.randomMax(this.bots.size())));
            }
            if(currentTime > timeJackPot_1000){
                time = GameConfig.getInstance().galaxyBotConfig.randomTimeBotEat(2);
                timeJackPot_1000 = currentTime + time;
                room1000.botEatJackpot(GalaxyModule.keyBotJackpotSlot3x3 +
                        "_vin_1000",timeJackPot_1000, this.bots.get(GameUtil.randomMax(this.bots.size())));
            }
            // Debug.trace("run finish");
        }catch (Exception e){
            Debug.trace(e);
        }
    }
}
