package com.iramml.bookstore.app.model;

public class BookDetailResponse {
    private String code, message;
    private Book book;

    public BookDetailResponse() {

    }

    public BookDetailResponse(String code, String message, Book book) {
        this.code = code;
        this.message = message;
        this.book = book;
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

    public Book getBook() {
        return book;
    }

    public void setBook(Book book) {
        this.book = book;
    }
}
