package com.iramml.bookstore.app.model;

public class UserResponse {
    private String code, message;
    private User user;

    public UserResponse() {
    }

    public UserResponse(String code, String message, User user) {
        this.code = code;
        this.message = message;
        this.user = user;
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

    public User getUser() {
        return user;
    }

    public void setUser(User user) {
        this.user = user;
    }
}
