package com.example.administration_west.Models;

public class Cart {
    private int id;
    private String product_name;
    private String image;
    private double price;
    private int quantity;


    //construtor
    public Cart(int id, String product_name, String image, double price, int quantity){
        this.setId(id);
        this.setProduct_name(product_name);
        this.setImage(image);
        this.setPrice(price);
        this.setQuantity(quantity);

    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getProduct_name() {
        return product_name;
    }

    public void setProduct_name(String product_name) {
        this.product_name = product_name;
    }

    public String getImage() {
        return image;
    }

    public void setImage(String image) {
        this.image = image;
    }

    public double getPrice() {
        return price;
    }

    public void setPrice(double price) {
        this.price = price;
    }

    public int getQuantity() {
        return quantity;
    }

    public void setQuantity(int quantity) {
        this.quantity = quantity;
    }

}
