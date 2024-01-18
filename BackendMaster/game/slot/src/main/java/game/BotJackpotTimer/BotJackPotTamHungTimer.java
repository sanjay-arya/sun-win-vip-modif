package game.BotJackpotTimer;

import bitzero.util.common.business.Debug;

import game.GameConfig.BotJackpotConfig.SlotTamHungBotConfig;
import game.GameConfig.GameConfig;
import game.modules.GameUtil;
import game.modules.slot.TamHungModule;
import game.modules.slot.entities.BotMinigame;
import game.modules.slot.room.TamHungRoom;

import java.util.List;

public class BotJackPotTamHungTimer implements Runnable {
    public boolean isInitBot = false;
    public List<String> bots;
    private long timeJackPot_10 = 0;
    private long timeJackPot_100 = 0;
    private long timeJackPot_1000 = 0;
    TamHungModule tamHungModule;

    public BotJackPotTamHungTimer(long[] timeJackpot, TamHungModule tamHungModule){
        this.timeJackPot_10 = timeJackpot[0];
        this.timeJackPot_100 = timeJackpot[1];
        this.timeJackPot_1000 = timeJackpot[2];
        this.tamHungModule = tamHungModule;
    }

    @Override
    public void run() {
       try {
           //Debug.trace("BotJackPotMinipokerTimer");
           if (!this.isInitBot) {
               try{
                   this.bots = BotMinigame.getBotsJackPot(500, "vin");
               }catch (Exception e){
                   Debug.warn("error init bot");
               }
               this.isInitBot = true;

           }
           int moneyToJackPot_10 = GameConfig.getInstance().slotTamHungBotConfig.randomJackPotPer5s(0);
           TamHungRoom room10 = (TamHungRoom)this.tamHungModule.rooms.get(this.tamHungModule.gameName + "_vin_10");
           room10.addMoneyToPot(moneyToJackPot_10);
           int moneyToJackPot_100 = GameConfig.getInstance().slotTamHungBotConfig.randomJackPotPer5s(1);
           TamHungRoom room100 = (TamHungRoom)this.tamHungModule.rooms.get(this.tamHungModule.gameName + "_vin_100");
           room100.addMoneyToPot(moneyToJackPot_100);
           int moneyToJackPot_1000 = GameConfig.getInstance().slotTamHungBotConfig.randomJackPotPer5s(2);
           TamHungRoom room1000 = (TamHungRoom)this.tamHungModule.rooms.get(this.tamHungModule.gameName + "_vin_1000");
           room1000.addMoneyToPot(moneyToJackPot_1000);
//
           long currentTime = GameUtil.getTimeStampInSeconds();
           int time = 0;
           if(currentTime > timeJackPot_10){
               time = GameConfig.getInstance().slotTamHungBotConfig.randomTimeBotEat(0);
               timeJackPot_10 = currentTime + time;
               room10.botEatJackpot(this.tamHungModule.keyBotJackpot3Hung +
                       "_vin_10",timeJackPot_10, this.bots.get(GameUtil.randomMax(this.bots.size())));
           }
           if(currentTime > timeJackPot_100){
               time = GameConfig.getInstance().slotTamHungBotConfig.randomTimeBotEat(1);
               timeJackPot_100 = currentTime + time;
               room100.botEatJackpot(this.tamHungModule.keyBotJackpot3Hung +
                       "_vin_100",timeJackPot_100, this.bots.get(GameUtil.randomMax(this.bots.size())));
           }
           if(currentTime > timeJackPot_1000){
               time = GameConfig.getInstance().slotTamHungBotConfig.randomTimeBotEat(2);
               timeJackPot_1000 = currentTime + time;
               room1000.botEatJackpot(this.tamHungModule.keyBotJackpot3Hung +
                       "_vin_1000",timeJackPot_1000, this.bots.get(GameUtil.randomMax(this.bots.size())));
           }
//           Debug.trace("run finish");
       }catch (Exception e){
           Debug.trace(e);
       }
    }
}
