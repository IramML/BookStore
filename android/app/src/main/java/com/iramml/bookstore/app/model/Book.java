package com.iramml.bookstore.app.model;

import com.google.gson.annotations.SerializedName;
import com.iramml.bookstore.app.common.ConfigApp;

public class Book{
    private String id, title, author, editorial, num_pages, description, category_name, cost, stock, is_archived, pdf, image;

    public Book() {
    }

    public Book(String id, String title, String author, String editorial, String num_pages, String description, String category_name, String cost, String stock, String is_archived, String pdf, String image) {
        this.id = id;
        this.title = title;
        this.author = author;
        this.editorial = editorial;
        this.num_pages = num_pages;
        this.description = description;
        this.category_name = category_name;
        this.cost = cost;
        this.stock = stock;
        this.is_archived = is_archived;
        this.pdf = pdf;
        this.image = image;
    }

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getAuthor() {
        return author;
    }

    public void setAuthor(String author) {
        this.author = author;
    }

    public String getEditorial() {
        return editorial;
    }

    public void setEditorial(String editorial) {
        this.editorial = editorial;
    }

    public String getNum_pages() {
        return num_pages;
    }

    public void setNum_pages(String num_pages) {
        this.num_pages = num_pages;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getCategory_name() {
        return category_name;
    }

    public void setCategory_name(String category_name) {
        this.category_name = category_name;
    }

    public String getCost() {
        return cost;
    }

    public void setCost(String cost) {
        this.cost = cost;
    }

    public String getStock() {
        return stock;
    }

    public void setStock(String stock) {
        this.stock = stock;
    }

    public String getIs_archived() {
        return is_archived;
    }

    public void setIs_archived(String is_archived) {
        this.is_archived = is_archived;
    }

    public String getPdf() {
        return pdf;
    }

    public void setPdf(String pdf) {
        this.pdf = pdf;
    }

    public String getImage() {
        return image;
    }

    public void setImage(String image) {
        this.image = image;
    }

    public String getImageURL(){
        return ConfigApp.URL_UPLOADS + "books/images/" + this.image;
    }

    public String getBookPDFURL(){
        return ConfigApp.URL_UPLOADS + "books/pdf/" + this.pdf;
    }
}
