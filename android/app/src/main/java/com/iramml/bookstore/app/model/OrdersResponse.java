package com.iramml.bookstore.app.model;

import java.util.ArrayList;

public class OrdersResponse {
    private String code, message;
    private ArrayList<Order> orders;

    public OrdersResponse() {
    }

    public OrdersResponse(String code, String message, ArrayList<Order> orders) {
        this.code = code;
        this.message = message;
        this.orders = orders;
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

    public ArrayList<Order> getOrders() {
        return orders;
    }

    public void setOrders(ArrayList<Order> orders) {
        this.orders = orders;
    }
}
