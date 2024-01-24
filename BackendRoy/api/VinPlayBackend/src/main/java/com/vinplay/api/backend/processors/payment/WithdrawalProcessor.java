package com.vinplay.api.backend.processors.payment;

import javax.servlet.http.HttpServletRequest;
import org.apache.commons.lang3.StringUtils;
import org.apache.log4j.Logger;
import com.vinplay.dichvuthe.response.RechargePaywellResponse;
import com.vinplay.payment.service.WithDrawOneClickPayService;
import com.vinplay.payment.service.WithDrawPrincePayService;
import com.vinplay.payment.service.impl.WithDrawOneClickPayServiceImpl;
import com.vinplay.payment.service.impl.WithDrawPrincePayServiceImpl;
import com.vinplay.payment.utils.Constant;
import com.vinplay.vbee.common.cp.BaseProcessor;
import com.vinplay.vbee.common.cp.Param;
import com.vinplay.vbee.common.response.BaseResponse;
import com.vinplay.vbee.common.utils.CommonUtils;

public class WithdrawalProcessor implements BaseProcessor<HttpServletRequest, String>{
	private static final Logger logger = Logger.getLogger("backend");
	
	public String execute(Param<HttpServletRequest> param) {
		HttpServletRequest request = param.get();
		String nickName = request.getParameter("nn");
		String approvedName = request.getParameter("nns");
		String orderId = request.getParameter("oid");
		String providerName = request.getParameter("pn");
		String ip = request.getParameter("ip");
		logger.info("Request WithdrawalProcessor nickName= " + nickName + ", orderId: " + orderId
				+ ", approvedName: " + approvedName + ", " + "providerName: " + providerName + ", " + "ip: " + ip);
		
		if (StringUtils.isBlank(nickName)) {
			return BaseResponse.error(Constant.ERROR_PARAM, "nickName is null or empty");
		}
		if (StringUtils.isBlank(approvedName)) {
			return BaseResponse.error(Constant.ERROR_PARAM, "nickName of staff is null or empty");
		}
		if (StringUtils.isBlank(orderId)) {
			return BaseResponse.error(Constant.ERROR_PARAM, "orderId is null or empty");
		}
		if (StringUtils.isBlank(providerName)) {
			return BaseResponse.error(Constant.ERROR_PARAM, "providerName is null or empty");
		}
		if (StringUtils.isBlank(ip)) {
			return BaseResponse.error(Constant.ERROR_PARAM, "ip is null or empty");
		}
		
		if (!CommonUtils.validateRequest(orderId)) {
			return BaseResponse.error(Constant.ERROR_DUPLICATE, "This order can only be processed once within 20 seconds, orderId=" + orderId);
		}
		
		RechargePaywellResponse res = new RechargePaywellResponse(1, 0L, 0, 0L,"");
		try {
			switch (providerName) {
			case "clickpay":
				WithDrawOneClickPayService withdrawOneClickPayService = new WithDrawOneClickPayServiceImpl();
				res = withdrawOneClickPayService.withdrawal(orderId, approvedName, ip);
				if(0 == res.getCode()) {
					return new BaseResponse<String>().success(res.getData());
				}
				else {
					return BaseResponse.error(res.getCode() + "", res.getData());
				}
			case "princepay":
				WithDrawPrincePayService withdrawPrincePayService = new WithDrawPrincePayServiceImpl();
				res = withdrawPrincePayService.withdrawal(orderId, "712", approvedName, ip);
				if(0 == res.getCode()) {
					return new BaseResponse<String>().success(res.getData());
				}
				else {
					return BaseResponse.error(res.getCode() + "", res.getData());
				}
			default:
				return BaseResponse.error(res.getCode() + "", "Not support provider: " + providerName);
			}
		} catch (Exception e) {
			logger.error(e);
			return BaseResponse.error(Constant.ERROR_SYSTEM, e.getMessage());
		}

	}
}
