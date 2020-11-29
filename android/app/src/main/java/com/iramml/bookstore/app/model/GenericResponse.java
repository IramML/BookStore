package com.iramml.bookstore.app.model;

public class GenericResponse {
    private String code, message;

    public GenericResponse() {
    }

    public GenericResponse(String code, String message) {
        this.code = code;
        this.message = message;
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
}
