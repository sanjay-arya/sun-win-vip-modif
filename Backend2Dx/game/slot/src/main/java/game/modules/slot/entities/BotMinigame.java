package game.modules.slot.entities;

import bitzero.util.common.business.Debug;
import com.vinplay.dal.service.BotService;
import com.vinplay.dal.service.impl.BotServiceImpl;
import com.vinplay.usercore.service.UserService;
import com.vinplay.usercore.service.impl.UserServiceImpl;
import com.vinplay.vbee.common.config.VBeePath;

import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.security.NoSuchAlgorithmException;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;
import java.util.Random;

public class BotMinigame {
     private static List bots = new ArrayList();
     private static List botsVip = new ArrayList();
     private static UserService userService = new UserServiceImpl();
     private static BotService botService = new BotServiceImpl();
     private static long[] soDuConLai = new long[]{300000L, 3500000L, 4000000L};
     private static String basePath = VBeePath.basePath;

     public static void loadData() {
          BufferedReader br;
          BotServiceImpl service;
          String botName;
          try {
               br = new BufferedReader(new FileReader(basePath.concat("config/bots.txt")));
               service = new BotServiceImpl();

               while((botName = br.readLine()) != null) {
                    try {
                         service.login(botName);
                         bots.add(botName);
                    } catch (SQLException | NoSuchAlgorithmException var7) {
                         Debug.trace(new Object[]{"Load bot " + botName + " error: ", var7});
                    }
               }

               br.close();
          } catch (FileNotFoundException var10) {
          } catch (IOException var11) {
          }

          try {
               br = new BufferedReader(new FileReader(basePath.concat("config/bots_vip.txt")));
               service = new BotServiceImpl();

               while((botName = br.readLine()) != null) {
                    try {
                         service.login(botName);
                         botsVip.add(botName);
                    } catch (SQLException | NoSuchAlgorithmException var6) {
                         Debug.trace(new Object[]{"Load vip bot " + botName + " error: ", var6});
                    }
               }

               br.close();
          } catch (FileNotFoundException var8) {
          } catch (IOException var9) {
          }

          Debug.trace("TOTAL BOTS: " + bots.size());
     }

     public static String getRandomBot(String moneyType) {
          Random rd = new Random();
          int index = rd.nextInt(bots.size());
          String nickname = (String)bots.get(index);
          pushMoneyToBot(nickname, moneyType);
          return nickname;
     }

     private static void pushMoneyToBot(String nickname, String moneyType) {
          long currentMoney = userService.getCurrentMoneyUserCache(nickname, moneyType);
          if (currentMoney < 100000L) {
               botService.addMoney(nickname, 1000000L, moneyType, "minigame bots အတွက် ကုန်ကျစရိတ်");
          } else {
               banVin(nickname, moneyType, currentMoney);
          }

     }

     private static void banVin(String nickname, String moneyType, long currentMoney) {
          if (currentMoney >= 6000000L) {
               Random rd = new Random();
               int index = rd.nextInt(soDuConLai.length);
               long soDu = soDuConLai[index];
               long tienBan = currentMoney - soDu;
               botService.addMoney(nickname, -tienBan, moneyType, "Chuyá»ƒn tiá»�n");
          }

     }

     private static void pushMoneyToBotVip(String nickname, String moneyType, long moneyPushed) {
          long currentMoney = userService.getCurrentMoneyUserCache(nickname, moneyType);
          if (currentMoney < moneyPushed) {
               botService.addMoney(nickname, moneyPushed, moneyType, "Cá»™ng tiá»�n cho bot minigame");
          } else {
               banVin(nickname, moneyType, currentMoney);
          }

     }

     public static List getBots(int amount, String moneyType) {
          List results = new ArrayList();
          List copyBots = new ArrayList(bots);

          for(int i = 0; i < amount; ++i) {
               Random rd = new Random();
               int index = rd.nextInt(copyBots.size());
               String nickname = (String)copyBots.get(index);
               pushMoneyToBot(nickname, moneyType);
               results.add(copyBots.remove(index));
          }

          return results;
     }

     public static List getBotsVip(int amount, String moneyType) {
          List results = new ArrayList();
          List copyBots = new ArrayList(botsVip);

          for(int i = 0; i < amount; ++i) {
               Random rd = new Random();
               int index = rd.nextInt(copyBots.size());
               String nickname = (String)copyBots.get(index);
               pushMoneyToBotVip(nickname, moneyType, 10000000L);
               results.add(copyBots.remove(index));
          }

          return results;
     }

     public static List getBotsSuperVip(int amount, String moneyType, long moneyPushed) {
          List results = new ArrayList();
          List copyBots = new ArrayList(botsVip);

          for(int i = 0; i < amount; ++i) {
               Random rd = new Random();
               int index = rd.nextInt(copyBots.size());
               String nickname = (String)copyBots.get(index);
               pushMoneyToBotVip(nickname, moneyType, moneyPushed);
               results.add(copyBots.remove(index));
          }

          return results;
     }

     public static List getBotChat() {
          int number = 0;
          Random rd = new Random();
          if (isNight()) {
               int n = rd.nextInt(5);
               if (n == 0) {
                    number = 1;
               }
          } else {
               number = rd.nextInt(3);
          }

          List results = new ArrayList();
          if (number > 0) {
               for(int i = 0; i < number; ++i) {
                    int n2 = rd.nextInt(10);
                    if (n2 == 0) {
                         n2 = rd.nextInt(botsVip.size());
                         results.add(botsVip.get(n2));
                    } else {
                         n2 = rd.nextInt(bots.size());
                         results.add(bots.get(n2));
                    }
               }
          }

          return results;
     }

     public static boolean isNight() {
          Calendar cal = Calendar.getInstance();
          int hourOfDay = cal.get(11);
          return 2 <= hourOfDay && hourOfDay <= 8;
     }

     public static void main(String[] args) {
          isNight();
     }
}
