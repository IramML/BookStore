package com.iramml.bookstore.app.model;

import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;

public class DomicilesResponse {
    @SerializedName("code")
    public String code;
    @SerializedName("domiciles")
    public ArrayList<Domicile> domiciles;
}
