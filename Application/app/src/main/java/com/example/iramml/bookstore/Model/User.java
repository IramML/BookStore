package com.example.iramml.bookstore.Model;

import android.net.Uri;

import com.google.gson.annotations.SerializedName;

public class User {
    private String name, phone, age, email, password;
    private Uri imgAvatar;
    @SerializedName("last_name")
    private String lastName;
    @SerializedName("image")
    private String urlImage;
    public User() {
    }

    public User(String name, String lastName, String phone, String age, String email, String password, Uri imgAvatar) {
        this.name = name;
        this.lastName = lastName;
        this.phone = phone;
        this.age = age;
        this.email = email;
        this.password = password;
    }

    public User(String name, String lastName, String phone, String age, String email, String password, String urlImage) {
        this.name = name;
        this.lastName = lastName;
        this.phone = phone;
        this.age = age;
        this.email = email;
        this.password = password;
        this.urlImage = urlImage;
    }

    public String getUrlImage() {
        return urlImage;
    }

    public void setUrlImage(String urlImage) {
        this.urlImage = urlImage;
    }

    public Uri getImgAvatar() {
        return imgAvatar;
    }

    public void setImgAvatar(Uri imgAvatar) {
        this.imgAvatar = imgAvatar;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getLastName() {
        return lastName;
    }

    public void setLastName(String lastName) {
        this.lastName = lastName;
    }

    public String getPhone() {
        return phone;
    }

    public void setPhone(String phone) {
        this.phone = phone;
    }

    public String getAge() {
        return age;
    }

    public void setAge(String age) {
        this.age = age;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }
}
