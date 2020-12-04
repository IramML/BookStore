package com.iramml.bookstore.app.model;

import com.iramml.bookstore.app.common.ConfigApp;

public class OrderDetailResponse {
    private String code, message;
    private Order order;

    public OrderDetailResponse() {
    }

    public OrderDetailResponse(String code, String message, Order order) {
        this.code = code;
        this.message = message;
        this.order = order;
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

    public Order getOrder() {
        return order;
    }

    public void setOrder(Order order) {
        this.order = order;
    }

}
