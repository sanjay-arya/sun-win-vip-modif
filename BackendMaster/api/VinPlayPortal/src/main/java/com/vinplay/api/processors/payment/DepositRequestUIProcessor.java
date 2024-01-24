package com.vinplay.api.processors.payment;

import java.util.List;
import java.util.Map;
import java.util.SplittableRandom;
import java.util.concurrent.ConcurrentHashMap;

import javax.servlet.http.HttpServletRequest;

import org.apache.commons.lang3.StringUtils;
import org.apache.log4j.Logger;

import com.vinplay.dichvuthe.response.RechargePaywellResponse;
import com.vinplay.payment.entities.BankConfig;
import com.vinplay.payment.entities.PaymentConfig;
import com.vinplay.payment.service.PaymentConfigService;
import com.vinplay.payment.service.PaymentManualService;
import com.vinplay.payment.service.RechargePayWellService;
import com.vinplay.payment.service.RechargePrincePayService;
import com.vinplay.payment.service.impl.PaymentConfigServiceImpl;
import com.vinplay.payment.service.impl.PaymentManualServiceImpl;
import com.vinplay.payment.service.impl.RechargePayWellServiceImpl;
import com.vinplay.payment.service.impl.RechargePrincePayServiceImpl;
import com.vinplay.payment.utils.Constant;
import com.vinplay.payment.utils.PayUtils;
import com.vinplay.payment.utils.PaymentConstant;
import com.vinplay.usercore.service.UserService;
import com.vinplay.usercore.service.impl.UserServiceImpl;
import com.vinplay.vbee.common.cp.BaseProcessor;
import com.vinplay.vbee.common.cp.Param;
import com.vinplay.vbee.common.models.UserModel;
import com.vinplay.vbee.common.response.BaseResponse;

public class DepositRequestUIProcessor implements BaseProcessor<HttpServletRequest, String> {

	private static final Logger logger = Logger.getLogger("api");
	
	private String getIpAddress(HttpServletRequest request) {
        String ipAddress = request.getHeader("X-FORWARDED-FOR");
        if (ipAddress == null) {
            ipAddress = request.getRemoteAddr();
        }
        return ipAddress;
    }
	private static Map<String, Long> mapCache = new ConcurrentHashMap<String, Long>();
    
    public static boolean validateRequest(String orderID) {
		if (mapCache.isEmpty()) {
			long t1 = new java.util.Date().getTime();
			mapCache.put(orderID, t1);
		} else {
			if (mapCache.containsKey(orderID)) {

				long t1 = mapCache.get(orderID);
				long t2 =  new java.util.Date().getTime();
				if ((t2 - t1) > 1000 * 10) {
					mapCache.put(orderID, t2);
					return true;
				} else {
					return false;
				}

			} else {
				long t1 =  new java.util.Date().getTime();
				mapCache.put(orderID, t1);
			}
		}
		return true;
	}
    
	private static final String[] RANDOM_IP = { "127.0.0.1", "0:0:0:0:0:0:0:1" };
	
	private final SplittableRandom ran = new SplittableRandom();
	
	@Override
	public String execute(Param<HttpServletRequest> param) {
		HttpServletRequest request = param.get();
		String fullName = request.getParameter("fn");
		long amount = 0;
		try {
			amount = Long.parseLong(request.getParameter("am"));
		} catch (Exception e) {
			return BaseResponse.error("99", e.getMessage());
		}
		String bankCode = request.getParameter("bc");
		String payType = request.getParameter("pt");
		String nickName = request.getParameter("nn");
		String accessToken = request.getParameter("at");
		String transactionId = request.getParameter("ti");
		String providerName = request.getParameter("pn");// paywell or royalpay
		String ip = getIpAddress(request);
		logger.info("ipaddress1 :" + ip);
		String clientIp = "";
		if (ip != null && !"".equals(ip)) {
			String[] arrayIp = ip.split(",");
			for (int i = 0; i < (arrayIp.length > 2 ? 2 : arrayIp.length); i++) {
				if (arrayIp[i].length() <= 40) {
					clientIp = arrayIp[i].trim();
					break;
				}
			}
		}
		
		if (!validateRequest(nickName)) {
			return BaseResponse.error(Constant.ERROR_DUPLICATE, "Only one deposit is required within 10 seconds, character name =" + nickName);
		}
		
		logger.info("Deposit request nickName: " + nickName + ", accessToken: " + accessToken + ", providerName: "
				+ providerName + ",ipaddress=" + clientIp);
		UserService userService = new UserServiceImpl();

		try {
			if (StringUtils.isBlank(nickName) || StringUtils.isBlank(accessToken)) {
				return BaseResponse.error(Constant.ERROR_PARAM, "input parameter is null or empty");
			}

			if (StringUtils.isBlank(payType)) {
				return BaseResponse.error(Constant.ERROR_PARAM, "Incorrect deposit method");
			}
			if (StringUtils.isBlank(providerName)) {
				return BaseResponse.error(Constant.ERROR_PARAM, "Incorrect supplier");
			}
			if (StringUtils.isBlank(fullName)) {
				return BaseResponse.error(Constant.ERROR_PARAM, "The account holder's name is incorrect");
			}
			int payTypeInt = 0;
			try {
				payTypeInt = Integer.parseInt(payType);
			} catch (NumberFormatException e) {
				return BaseResponse.error(Constant.ERROR_SYSTEM, e.getMessage());
			}
			// validation paytype
			if (PaymentConstant.PayType.ONLINE.getKey() != payTypeInt
					&& PaymentConstant.PayType.OFFLINE.getKey() != payTypeInt
					&& PaymentConstant.PayType.MOMO_DEP.getKey() != payTypeInt
					&& PaymentConstant.PayType.ZALO_DEP.getKey() != payTypeInt) {
				return BaseResponse.error(Constant.ERROR_PAYTYPE, "Payment method is incorrect");
			}
			boolean isToken = userService.isActiveToken(nickName, accessToken);
			if (isToken) {
				// get provider info
				PaymentConfigService payConfig = new PaymentConfigServiceImpl();
				// check min amount
				PaymentConfig config = payConfig.getConfigByKey(providerName);
				if (config == null)
					return BaseResponse.error(Constant.ERROR_PROVIDERNAME, "This payment gateway is not supported at this time");

				long minAmount = config.getConfig().getMinMoney();
				if (amount < 1000) {
					return BaseResponse.error(Constant.MIN_MONEY, "The deposit amount is too small");
				}
				if(PaymentConstant.PayType.MOMO_DEP.getKey() != payTypeInt) {
					if (minAmount > amount) {
						return BaseResponse.error(Constant.MIN_MONEY, "The deposit amount must be larger  " + minAmount +" MMK");
					}
				}else {
					if (amount < 1000) {
						return BaseResponse.error(Constant.MIN_MONEY, "The deposit amount must be greater than  5,000 MMK");
					}
				}
				// 300000000
				
				if(amount > 1000000) {
					return BaseResponse.error(Constant.MAX_MONEY, "The deposit amount must be less 1 million MMK");
				}
				// get usermodel
				UserModel user = userService.getUserByNickName(nickName);
				String userId = user.getId() + "";
				String username = user.getUsername();
				if(user.isBanLogin() ||user.isBanTransferMoney()||user.isBot()) {
					return BaseResponse.error(Constant.ERROR_USERTYPE, "You have been prohibited from performing this function");
				}
				// switch provider
				RechargePaywellResponse resultResponse = null;
				String paytypeStr = PayUtils.getPayType(payTypeInt, providerName);
				if ("".equals(paytypeStr)) {
					return BaseResponse.error(Constant.ERROR_PAYTYPE, "Payment form is incorrect");
				}

				switch (providerName) {
				case PaymentConstant.PROVIDER.PAYWELL:
					if (StringUtils.isBlank(bankCode)) {
						return BaseResponse.error(Constant.ERROR_PARAM, "Bank code is incorrect");
					}
					// check bankCode
					List<BankConfig> lstBankConfig = config.getConfig().getBanks();
					boolean isExist = false;
					for (BankConfig bankConfig : lstBankConfig) {
						if (bankConfig.getKey().equals(bankCode)) {
							isExist = true;
							break;
						}
					}
					if (!isExist) {
						return BaseResponse.error(Constant.ERROR_BANKCODE, "This bank is not supported yet");
					}
					RechargePayWellService servicePaywell = new RechargePayWellServiceImpl();
					resultResponse = servicePaywell.createTransaction(userId, username, nickName, fullName, amount,
							bankCode, paytypeStr);
					break;
				case PaymentConstant.PROVIDER.PRINCE_PAY:
					if ("".equals(clientIp) || clientIp.length() > 20) {
						clientIp = RANDOM_IP[ran.nextInt(2 - 0 + 1) + 0];
					}
					RechargePrincePayService servicePrince = new RechargePrincePayServiceImpl();
					resultResponse = servicePrince.createTransaction(userId, username, nickName, amount, paytypeStr,
							fullName, bankCode, clientIp);
					break;

				case PaymentConstant.PROVIDER.CLICK_PAY:
//					RechargeOneClickPayService serviceClick = new RechargeOneClickPayServiceImpl();
//					resultResponse = serviceClick.createTransaction(userId, username, nickName, amount, paytypeStr,
//							fullName, bankCode, clientIp);
					break;
				case PaymentConstant.PROVIDER.MANUAL_BANK:
					String bankAccountNum = request.getParameter("bn");
					
					if (paytypeStr.equals("bank_recharge")) {
						if (StringUtils.isBlank(bankAccountNum)) {
							return BaseResponse.error(Constant.ERROR_PARAM, "Missing bank account number");
						}
						if (StringUtils.isBlank(bankCode)) {
							return BaseResponse.error(Constant.ERROR_PARAM, "Missing bank name");
						}
					} else if (paytypeStr.equals("momo_recharge")) {
						bankCode = "momo";
					} else {
						bankCode = "zalo";
					}
					String desc = request.getParameter("ds");
					PaymentManualService manuService = new PaymentManualServiceImpl();
					resultResponse = manuService.deposit(nickName, fullName, amount, bankCode, bankAccountNum,
							paytypeStr, desc,transactionId);
				default:
					break;
				}
				
				if (resultResponse == null) {
					return BaseResponse.error(Constant.ERROR_CREATE_TRANSACTION, "Unable to create transaction");
				} else {
					logger.info("Deposit response nickName: " + nickName + ", response : " + resultResponse.toJson());
				}
				
				if (PaymentConstant.SUCCESS == resultResponse.getCode()) {
					return new BaseResponse<>().success(resultResponse.getData());
				} else if (PaymentConstant.MAINTAINCE == resultResponse.getCode()) {
					return BaseResponse.error(resultResponse.getCode() + "",
							"The payment portal is under maintenance, please try again in a few minutes");
				} else if (PaymentConstant.TOO_MANY_REQUEST == resultResponse.getCode()) {
					return BaseResponse.error(resultResponse.getCode() + "",
							"Too many deposit requests, please try again in a few minutes");
				} else {
					return BaseResponse.error(resultResponse.getCode() + "", resultResponse.getData());
				}

			} else {
				return BaseResponse.error(Constant.ERROR_SESSION, "Your trading session has ended, please reload the page and log in");
			}
		} catch (Exception e) {
			logger.error(e);
			return BaseResponse.error(Constant.ERROR_SYSTEM, e.getMessage());
		}

	}

}
