package com.vinplay.dailyQuest;

import com.vinplay.vbee.common.enums.Games;
import com.vinplay.dailyQuest.model.DailyQuestData;

public class DailyQuestConfig {
    public static DailyQuestData[] allQuest = {
            new DailyQuestData(Games.NHIEM_VU.getId(), 500000, QuestType.MONEY, 10000, GiftType.MONEY,
                    -1, -1, 0, "Top up 500k card and get 10k free"),
            new DailyQuestData(Games.MINI_POKER.getId(), 200000, QuestType.MONEY, 1, GiftType.FREE_SPIN,
                    Games.SPARTAN.getId(), 100, 1, "Minipoker total bet 200k Get 1 spin of Fortune 100"),
            new DailyQuestData(Games.CHIEM_TINH.getId(), 200000, QuestType.MONEY, 1, GiftType.FREE_SPIN,
                    Games.BENLEY.getId(), 100, 2, "Total bet Astrology 200k Get 1 Bitcoin spin 100"),
            new DailyQuestData(Games.MAYBACH.getId(), 200000, QuestType.MONEY, 1, GiftType.FREE_SPIN,
                    Games.BENLEY.getId(), 100, 3, "Total Football bet 200k Get 1 Bitcoin 100 spin"),
            new DailyQuestData(Games.BENLEY.getId(), 200000, QuestType.MONEY, 1, GiftType.FREE_SPIN,
                    Games.AUDITION.getId(), 100, 4, "Tổng cược Bitcoin 200k Tặng 1 lượt quay Đua Xe 100"),
            new DailyQuestData(Games.AUDITION.getId(), 200000, QuestType.MONEY, 1, GiftType.FREE_SPIN,
                    Games.TAMHUNG.getId(), 100, 5, "Tổng cược Đua Xe 200k Tặng 1 lượt quay Chim Điên 100"),
            new DailyQuestData(Games.TAMHUNG.getId(), 200000, QuestType.MONEY, 1, GiftType.FREE_SPIN,
                    Games.MAYBACH.getId(), 100, 6, "Tổng cược Chim Điên 200k Tặng 1 lượt quay Bóng Đá 100"),
            new DailyQuestData(Games.ROLL_ROYE.getId(), 200000, QuestType.MONEY, 2000, GiftType.FREE_SPIN,
                    Games.TAMHUNG.getId(), 100, 7, "Tổng cược Thần Bài 200k Tặng 1 lượt quay Chim Điên 100"),
            new DailyQuestData(Games.TAI_XIU.getId(), 500000, QuestType.MONEY, 2000, GiftType.MONEY,
                    -1, -1, 8, "Tổng cược Over/under 500k Tặng 2k"),
            new DailyQuestData(Games.BAU_CUA.getId(), 500000, QuestType.MONEY, 2000, GiftType.MONEY,
                    -1, -1, 9, "Tổng cược Bầu cua 500k Tặng 2k"),
//            new DailyQuestData(Games.CHIEM_TINH.getId(), 200000, QuestType.MONEY, 1, GiftType.FREE_SPIN,
//                    Games.BENLEY.getId(), 100, 2, "Tổng cược Chiêm Tinh 200k Tặng 1 lượt quay Bitcoin 100"),

    };

    public static boolean[] questActive = {
            false, false, true, false, true,
            true, true, true, false, false
    };
}
