package com.example.iramml.bookstore.Model;

import com.google.gson.annotations.SerializedName;

public class Book{
    @SerializedName("id")
    public String id;
    @SerializedName("title")
    public String title;
    @SerializedName("pages")
    public String pages;
    @SerializedName("editorial")
    public String editorial;
    @SerializedName("author")
    public String author;
    @SerializedName("cost")
    public String cost;
    @SerializedName("image")
    public String image;
    @SerializedName("there_pdf")
    public String is_pdf;
    @SerializedName("there_physical")
    public String is_physical;
}
