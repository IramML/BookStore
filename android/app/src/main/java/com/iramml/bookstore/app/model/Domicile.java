package com.iramml.bookstore.app.model;

public class Domicile {
    private String id, postal_code, country, state, city, street, outdoor_number, is_archived;

    public Domicile(String id, String postal_code, String country, String state, String city, String street, String outdoor_number, String is_archived) {
        this.id = id;
        this.postal_code = postal_code;
        this.country = country;
        this.state = state;
        this.city = city;
        this.street = street;
        this.outdoor_number = outdoor_number;
        this.is_archived = is_archived;
    }

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getPostal_code() {
        return postal_code;
    }

    public void setPostal_code(String postal_code) {
        this.postal_code = postal_code;
    }

    public String getCountry() {
        return country;
    }

    public void setCountry(String country) {
        this.country = country;
    }

    public String getState() {
        return state;
    }

    public void setState(String state) {
        this.state = state;
    }

    public String getCity() {
        return city;
    }

    public void setCity(String city) {
        this.city = city;
    }

    public String getStreet() {
        return street;
    }

    public void setStreet(String street) {
        this.street = street;
    }

    public String getOutdoor_number() {
        return outdoor_number;
    }

    public void setOutdoor_number(String outdoor_number) {
        this.outdoor_number = outdoor_number;
    }

    public String getIs_archived() {
        return is_archived;
    }

    public void setIs_archived(String is_archived) {
        this.is_archived = is_archived;
    }
}
