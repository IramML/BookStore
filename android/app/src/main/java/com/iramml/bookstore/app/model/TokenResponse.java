package com.iramml.bookstore.app.model;

import com.google.gson.annotations.SerializedName;

public class TokenResponse {
    public String code, message, access_token;

    public TokenResponse() {
    }

    public TokenResponse(String code, String message, String access_token) {
        this.code = code;
        this.message = message;
        this.access_token = access_token;
    }

    public String getCode() {
        return code;
    }

    public void setCode(String code) {
        this.code = code;
    }

    public String getMessage() {
        return message;
    }

    public void setMessage(String message) {
        this.message = message;
    }

    public String getAccess_token() {
        return access_token;
    }

    public void setAccess_token(String access_token) {
        this.access_token = access_token;
    }
}
