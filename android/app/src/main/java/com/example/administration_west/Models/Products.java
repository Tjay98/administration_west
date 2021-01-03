package com.example.administration_west.Models;

public class Products {

    private int id;
    private String product_name;
    private String image;
    private double price;
/*private String big_description;
private String category_name;
private int category_id;
private String company_name;
private int company_id;
private int quantity_in_stock;
private double price_iva;*/


//construtor
/* public Products(long id, String product_name, String image, String big_description, String category_name, int category_id, String company_name, int company_id, int quantity_in_stock, double price, double price_iva){
this.setId(id);
this.setProduct_name(product_name);
this.setImage(image);
this.setBig_description(big_description);
this.setCategory_name(category_name);
this.setCategory_id(category_id);
this.setCompany_name(company_name);
this.setCompany_id(company_id);
this.setQuantity_in_stock(quantity_in_stock);
this.setPrice(price);
this.setPrice_iva(price_iva);
}*/

    public Products(int id, String product_name, double price , String image){
        this.id =id;
        this.product_name = product_name;
        this.price = price;
        this.image = image;
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

/* public String getBig_description() {
return big_description;
}

public void setBig_description(String big_description) {
this.big_description = big_description;
}

public String getCategory_name() {
return category_name;
}

public void setCategory_name(String category_name) {
this.category_name = category_name;
}

public int getCategory_id() {
return category_id;
}

public void setCategory_id(int category_id) {
this.category_id = category_id;
}

public String getCompany_name() {
return company_name;
}

public void setCompany_name(String company_name) {
this.company_name = company_name;
}

public int getCompany_id() {
return company_id;
}

public void setCompany_id(int company_id) {
this.company_id = company_id;
}

public int getQuantity_in_stock() {
return quantity_in_stock;
}

public void setQuantity_in_stock(int quantity_in_stock) {
this.quantity_in_stock = quantity_in_stock;
}



public double getPrice_iva() {
return price_iva;
}

public void setPrice_iva(double price_iva) {
this.price_iva = price_iva;
}*/
}