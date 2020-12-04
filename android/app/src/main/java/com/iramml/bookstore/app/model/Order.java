package com.iramml.bookstore.app.model;

import com.iramml.bookstore.app.common.ConfigApp;

public class Order {
    private String id, title, author, editorial, num_pages, description, category_name, cost, stock, is_archived, pdf, image, order_id, is_pdf, created_date;

    public Order() {
    }

    public Order(String id, String title, String author, String editorial, String num_pages, String description, String category_name, String cost, String stock, String is_archived, String pdf, String image, String order_id, String is_pdf, String created_date) {
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
        this.order_id = order_id;
        this.is_pdf = is_pdf;
        this.created_date = created_date;
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

    public String getOrder_id() {
        return order_id;
    }

    public void setOrder_id(String order_id) {
        this.order_id = order_id;
    }

    public String getIs_pdf() {
        return is_pdf;
    }

    public void setIs_pdf(String is_pdf) {
        this.is_pdf = is_pdf;
    }

    public String getCreated_date() {
        return created_date;
    }

    public void setCreated_date(String created_date) {
        this.created_date = created_date;
    }

    public String getBookImageURL(){
        return ConfigApp.URL_UPLOADS + "books/images/" + this.image;
    }

    public String getBookPDFURL(){
        return ConfigApp.URL_UPLOADS + "books/pdf/" + this.pdf;
    }
}
