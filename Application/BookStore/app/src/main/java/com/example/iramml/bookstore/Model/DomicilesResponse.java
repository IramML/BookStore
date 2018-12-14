package com.example.iramml.bookstore.Model;

import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;

public class DomicilesResponse {
    @SerializedName("code")
    public String code;
    @SerializedName("domiciles")
    public ArrayList<Domicile> domiciles;
}
