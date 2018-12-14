package com.example.iramml.bookstore.Model;

import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;

public class BooksResponse {
    @SerializedName("code")
    public String code;
    @SerializedName("books")
    public ArrayList<Book> books;
}
