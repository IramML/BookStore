package com.iramml.bookstore.app.model;

import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;

public class BooksResponse {
    private String code, message;
    private ArrayList<Book> books;

    public BooksResponse() {
    }

    public BooksResponse(String code, ArrayList<Book> books) {
        this.code = code;
        this.books = books;
    }

    public String getCode() {
        return code;
    }

    public void setCode(String code) {
        this.code = code;
    }

    public ArrayList<Book> getBooks() {
        return books;
    }

    public void setBooks(ArrayList<Book> books) {
        this.books = books;
    }
}
