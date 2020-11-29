package com.iramml.bookstore.app.model;

import com.google.gson.annotations.SerializedName;

public class TokenResponse {
    public String code, token;

    public TokenResponse() {
    }

    public TokenResponse(String code, String token) {
        this.code = code;
        this.token = token;
    }

    public String getCode() {
        return code;
    }

    public void setCode(String code) {
        this.code = code;
    }

    public String getToken() {
        return token;
    }

    public void setToken(String token) {
        this.token = token;
    }
}
