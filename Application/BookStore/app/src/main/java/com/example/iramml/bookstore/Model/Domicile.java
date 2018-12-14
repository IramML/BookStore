package com.example.iramml.bookstore.Model;

public class Domicile {
    private String postal_code, colony, state, municipality, street, outdoor_number;

    public Domicile(String postal_code, String colony, String state, String municipality, String street, String outdoor_number) {
        this.postal_code = postal_code;
        this.colony = colony;
        this.state = state;
        this.municipality = municipality;
        this.street = street;
        this.outdoor_number = outdoor_number;
    }

    public String getPostalCode() {
        return postal_code;
    }

    public void setPostalCode(String postalCode) {
        this.postal_code = postalCode;
    }

    public String getColony() {
        return colony;
    }

    public void setColony(String colony) {
        this.colony = colony;
    }

    public String getState() {
        return state;
    }

    public void setState(String state) {
        this.state = state;
    }

    public String getMunicipality() {
        return municipality;
    }

    public void setMunicipality(String municipality) {
        this.municipality = municipality;
    }

    public String getStreet() {
        return street;
    }

    public void setStreet(String street) {
        this.street = street;
    }

    public String getOutdoorNumber() {
        return outdoor_number;
    }

    public void setOutdoorNumber(String outdoorNumber) {
        this.outdoor_number = outdoorNumber;
    }
}
