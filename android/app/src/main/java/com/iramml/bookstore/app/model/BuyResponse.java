package com.iramml.bookstore.app.model;

import com.google.gson.annotations.SerializedName;

public class BuyResponse {
    @SerializedName("code")
    public String code;
    @SerializedName("message")
    public String message;
}
