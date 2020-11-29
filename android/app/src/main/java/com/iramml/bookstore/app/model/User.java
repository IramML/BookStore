package com.iramml.bookstore.app.model;

import android.net.Uri;

import com.google.gson.annotations.SerializedName;
import com.iramml.bookstore.app.common.ConfigApp;

public class User {
    private String id, first_name, last_name, email, image;

    public User() {
    }

    public User(String id, String first_name, String last_name, String email, String image) {
        this.id = id;
        this.first_name = first_name;
        this.last_name = last_name;
        this.email = email;
        this.image = image;
    }

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getFirst_name() {
        return first_name;
    }

    public void setFirst_name(String first_name) {
        this.first_name = first_name;
    }

    public String getLast_name() {
        return last_name;
    }

    public void setLast_name(String last_name) {
        this.last_name = last_name;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getImage() {
        return image;
    }

    public void setImage(String image) {
        this.image = image;
    }

    public String getImageURL(){
        if (this.image == null || this.image.equals(""))
            return "";

        return ConfigApp.URL_UPLOADS + "clients/images/" + this.image;
    }
}
