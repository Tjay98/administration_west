package com.example.administration_west.Models;

public class Users {
    private int id;
    private String username;
    private String email;
    private String birthday_date;
    private String mobile;

    public Users(int id, String username, String email, String birthday_date,  String mobile){
        this.setId(id);
        this.setUsername(username);
        this.setEmail(email);
        this.setBirthday_date(birthday_date);
        this.setMobile(mobile);
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getBirthday_date() {
        return birthday_date;
    }

    public void setBirthday_date(String birthday_date) {
        this.birthday_date = birthday_date;
    }

    public String getMobile() {
        return mobile;
    }

    public void setMobile(String mobile) {
        this.mobile = mobile;
    }
}
