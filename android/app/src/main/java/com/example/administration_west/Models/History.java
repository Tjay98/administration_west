package com.example.administration_west.Models;

public class History {

    private int id;
    private double total_price;
    private double total_iva;
    private String created_date;
    private String status;



    //construtor
    public History(int id, double total_price, double total_iva, String created_date, String status){
        this.id=id;
        this.total_price = total_price;
        this.total_iva = total_iva;
        this.created_date = created_date;
        this.status = status;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public double getTotal_price() {
        return total_price;
    }

    public void setTotal_price(double total_price) {
        this.total_price = total_price;
    }

    public double getTotal_iva() {
        return total_iva;
    }

    public void setTotal_iva(double total_iva) {
        this.total_iva = total_iva;
    }

    public String getCreated_date(){ return created_date; }

    public void setCreated_date(String created_date){
        this.created_date = created_date;
    }

    public String getStatus(){ return status; }

    public void setStatus(String status){
        this.status = status;
    }
}
