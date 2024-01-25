package com.vinplay.utils;

import java.util.HashMap;
import java.util.Map;

public interface EnumConstants {
	enum HttpStatus {
		SUCCESS(0, "Success"),
		ERR_SYSTEM(-100, "System error"),
		;
		
		private int key;
		private String value;
		
		HttpStatus(int key, String value) {
			this.value = value;
			this.key = key;
		}
		
		public String getValue() {
			return value;
		}
		
		public int getKey() {
			return key;
		}
	}
	enum ErrorBank {
		SUCCESS(0, "Success"),
		ERR_TRANSACTION(-99, "Error transaction"),
		ERR_OVER_BANK_NUMBER(-1, "You have added 5 bank accounts, please contact customer service!"),
		ERR_CUSTOMER_NAME(-2, "The account holder must match the first added account holder name."),
		ERR_EXISTED_BANK_NUMBER(-3, "This account number already exists, please re-enter"),
		ERR_NOT_EXIST_ID(-4, "not exist id"),
		ERR_USER_NOT_EXIST(-5, "User not exist"),
		ERR_RECORD_NOT_EXIST(-6, "Record not exist"),
		ERR_CHANGE_BANKNUMBER(-7, "You cannot change bank STK. Please contact Customer Service!"),
		ERR_CHANGE_CUSTOMERNAME(-8, "You cannot change the account holder name. Please contact Customer Service!"),
		
		ERR_SYSTEM(-100, "System error"),
		;
		
		private int key;
		private String value;

		ErrorBank(int key, String value) {
			this.value = value;
			this.key = key;
		}
		  
		private static final Map<Integer, String> lookup = new HashMap<Integer, String>();

	    static {
	        for (ErrorBank d : ErrorBank.values()) {
	            lookup.put(d.getKey(), d.getValue());
	        }
	    }


	    public static String getValue(int key) {
			return lookup.get(key);
		}

	    public String getValue() {
	        return value;
	    }

	    public int getKey() {
	        return key;
	    }
	}

	
}
