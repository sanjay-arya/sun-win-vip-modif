package game.BotJackpotTimer;

import bitzero.util.common.business.Debug;
import game.GameConfig.GameConfig;
import game.modules.GameUtil;
import game.modules.slot.ChiemTinhModule;
import game.modules.slot.entities.BotMinigame;
import game.modules.slot.room.ChiemTinhRoom;

import java.util.List;

public class BotJackPotChiemtinhTimer implements Runnable {
    public boolean isInitBot = false;
    public List<String> bots;
    private long timeJackPot_10 = 0;
    private long timeJackPot_100 = 0;
    private long timeJackPot_1000 = 0;
    ChiemTinhModule chiemtinhModule;

    public BotJackPotChiemtinhTimer(long[] timeJackpot, ChiemTinhModule chiemtinhModule){
        this.timeJackPot_10 = timeJackpot[0];
        this.timeJackPot_100 = timeJackpot[1];
        this.timeJackPot_1000 = timeJackpot[2];
        this.chiemtinhModule = chiemtinhModule;
    }

    @Override
    public void run() {
       try {
           //Debug.trace("BotJackPotMinipokerTimer");
           if (!this.isInitBot) {
               try{
                   this.bots = BotMinigame.getBotsJackPot(500, "vin");// lấy 500 bot
               }catch (Exception e){
                   Debug.warn("error init bot");
               }
               this.isInitBot = true;

           }
           int moneyToJackPot_10 = GameConfig.getInstance().slotChiemtinhBotConfig.randomJackPotPer5s(0);
           ChiemTinhRoom room10 = (ChiemTinhRoom)this.chiemtinhModule.rooms.get(this.chiemtinhModule.gameName + "_vin_10");
           room10.addMoneyToPot(moneyToJackPot_10);
           int moneyToJackPot_100 = GameConfig.getInstance().slotChiemtinhBotConfig.randomJackPotPer5s(1);
           ChiemTinhRoom room100 = (ChiemTinhRoom)this.chiemtinhModule.rooms.get(this.chiemtinhModule.gameName + "_vin_100");
           room100.addMoneyToPot(moneyToJackPot_100);
           int moneyToJackPot_1000 = GameConfig.getInstance().slotChiemtinhBotConfig.randomJackPotPer5s(2);
           ChiemTinhRoom room1000 = (ChiemTinhRoom)this.chiemtinhModule.rooms.get(this.chiemtinhModule.gameName + "_vin_1000");
           room1000.addMoneyToPot(moneyToJackPot_1000);
//
           long currentTime = GameUtil.getTimeStampInSeconds();
           int time = 0;
           if(currentTime > timeJackPot_10){
               time = GameConfig.getInstance().slotChiemtinhBotConfig.randomTimeBotEat(0);
               timeJackPot_10 = currentTime + time;
               room10.botEatJackpot(this.chiemtinhModule.keyBotJackpotSlot11IconWild +
                       "_vin_10",timeJackPot_10, this.bots.get(GameUtil.randomMax(this.bots.size())));
           }
           if(currentTime > timeJackPot_100){
               time = GameConfig.getInstance().slotChiemtinhBotConfig.randomTimeBotEat(1);
               timeJackPot_100 = currentTime + time;
               room100.botEatJackpot(this.chiemtinhModule.keyBotJackpotSlot11IconWild +
                       "_vin_100",timeJackPot_100, this.bots.get(GameUtil.randomMax(this.bots.size())));
           }
           if(currentTime > timeJackPot_1000){
               time = GameConfig.getInstance().slotChiemtinhBotConfig.randomTimeBotEat(2);
               timeJackPot_1000 = currentTime + time;
               room1000.botEatJackpot(this.chiemtinhModule.keyBotJackpotSlot11IconWild +
                       "_vin_1000",timeJackPot_1000, this.bots.get(GameUtil.randomMax(this.bots.size())));
           }
//           Debug.trace("run finish");
       }catch (Exception e){
           Debug.trace(e);
       }
    }
}
