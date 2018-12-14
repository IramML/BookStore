package com.example.iramml.bookstore.Model;

import com.google.gson.annotations.SerializedName;

public class TokenResponse {
    @SerializedName("code")
    public String code;
    @SerializedName("token")
    public String token;
}
