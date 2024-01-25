package com.vinplay.utils;

import com.vinplay.payment.entities.DepositPaygateModel;
import com.vinplay.payment.entities.UserWithdraw;
import com.vinplay.usercore.utils.GameCommon;

public class TelegramAlert {
	
    public static boolean SendMessage(String message){
        try{
            String chatId = GameCommon.getValueStr("Telegram_chat_id");
            String bootToken = GameCommon.getValueStr("Telegram_boot_token");
            return TelegramUtil.sendMessage(message, chatId, bootToken);
        }catch (Exception e){
            return false;
        }

    }
    public static boolean SendMessageCashout(UserWithdraw userWithdraw){
        try{
            String message = "<b>Request withdrawal from User " + userWithdraw.Username + "</b>";
            message += "\n Amount of money <b>"+ userWithdraw.Amount+ "</b>";
            message += "\n Bank: <b>"+ userWithdraw.BankName+ "</b>";
            message += "\n account name <b>"+ userWithdraw.BankAccountName+ "</b>";
            message += "\n Account number : <b>"+ userWithdraw.BankAccountNumber+ "</b>";
            return SendMessage(message);
        }catch (Exception e){
            return false;
        }
    }
    public static boolean SendMessageDepositBank(DepositPaygateModel model){
        try{
            String message = "<b>Request deposit via User Bank" + model.Nickname+ "</b>";
            message += "\n Amount of money <b>"+ model.Amount+ "</b>";
            message += "\n Bank: : <b>"+ model.BankCode+ "</b>";
            message += "\n Account name : <b>"+ model.BankAccountName+ "</b>";
            message += "\n Account number: <b>"+ model.BankAccountNumber+ "</b>";
            return SendMessage(message);
        }catch (Exception e){
            return false;
        }
    }

    public static boolean SendMessageRechard(String message){
        try{
            return TelegramUtil.pushNotificationDeposit(message);
        }catch (Exception e){
            return false;
        }
    }
}
