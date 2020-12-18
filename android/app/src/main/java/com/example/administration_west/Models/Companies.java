package com.example.administration_west.Models;

public class Companies {
    private int id;
    private String company_name;
    private String image;
    private String description;


    //construtor
    public Companies(int id, String company_name, String image, String description){
        this.setId(id);
        this.setCompany_name(company_name);
    }


    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getCompany_name() {
        return company_name;
    }

    public void setCompany_name(String company_name) {
        this.company_name = company_name;
    }

    public String getImage() {
        return image;
    }

    public void setImage(String image) {
        this.image = image;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }
}
