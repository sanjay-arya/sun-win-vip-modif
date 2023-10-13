package game.util;

import bitzero.server.config.ConfigHandle;
import bitzero.util.socialcontroller.bean.UserInfo;
import com.vinplay.dichvuthe.service.AlertService;
import com.vinplay.dichvuthe.service.impl.AlertServiceImpl;
import com.vinplay.usercore.service.UserService;
import com.vinplay.usercore.service.impl.UserServiceImpl;
import com.vinplay.vbee.common.enums.Games;
import com.vinplay.vbee.common.response.UserResponse;
import java.util.Random;

public class GameUtils {
     public static boolean dev_mod = ConfigHandle.instance().getLong("dev_mod") == 1L;

     public static UserInfo getUserInfo(String username, String sessionKey) {
          if (dev_mod) {
               UserInfo info = new UserInfo();
               boolean var8 = false;

               int userId;
               try {
                    Integer v = new Integer(username);
                    userId = v;
               } catch (Exception var6) {
                    Random rd = new Random();
                    userId = Math.abs(rd.nextInt() % 100000);
               }

               info.setUsername("vp_" + userId);
               info.setUserId("" + userId);
               return info;
          } else {
               UserService service = new UserServiceImpl();
               UserResponse res = service.checkSessionKey(username, sessionKey, Games.KHO_BAU);
               if (res.getErrorCode() == "0") {
                    res.getUser().getId();
                    UserInfo info2 = new UserInfo();
                    info2.setUserId(String.valueOf(res.getUser().getId()));
                    info2.setUsername(res.getUser().getNickname());
                    return info2;
               } else {
                    return null;
               }
          }
     }

     public static void sendAlert(String msg) {
     }

     public static void sendSMSToUser(String username, String message) {
          if (ConfigGame.getIntValue("enable_alert_msg", 0) == 1) {
               try {
                    AlertService alert = new AlertServiceImpl();
                    alert.sendSMS2User(username, message);
               } catch (Exception var3) {
               }
          }

     }
}
