package com.example.administration_west.Models;

public class DetailsHistory {

    private int id;
    private String product_name;
    private double price;
    private double price_iva;
    private int quantity;

    public DetailsHistory(int id, String product_name, double price, double price_iva, int quantity){
        this.setId(id);
        this.setProduct_name(product_name);
        this.setPrice(price);
        this.setPriceIva(price_iva);
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


    public double getPrice() {
        return price;
    }

    public void setPrice(double price) {
        this.price = price;
    }

    public double getPriceIva() {
        return price_iva;
    }

    public void setPriceIva(double price_iva) {
        this.price_iva = price_iva;
    }

    public int getQuantity() {
        return quantity;
    }

    public void setQuantity(int quantity) {
        this.quantity = quantity;
    }


}
