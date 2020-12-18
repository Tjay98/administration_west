package com.example.administration_west.Models;

public class Categories {

        private int id;
        private String category_name;


        //construtor
        public Categories(int id, String category_name){
            this.setId(id);
            this.setCategory_name(category_name);
        }


        public int getId() {
            return id;
        }

        public void setId(int id) {
            this.id = id;
        }

        public String getCategory_name() {
            return category_name;
        }

        public void setCategory_name(String category_name) {
            this.category_name = category_name;
        }
}
