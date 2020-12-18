package com.example.administration_west.Models;

public class Users {
    private long id;
    private String username;
    private String email;
    private int nif;
    private String birthday_date;

    public Users(long id, String username, String email, int nif, String birthday_date){
        this.setId(id);
        this.setUsername(username);
        this.setEmail(email);
        this.setNif(nif);
        this.setBirthday_date(birthday_date);
    }

    public long getId() {
        return id;
    }

    public void setId(long id) {
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

    public int getNif() {
        return nif;
    }

    public void setNif(int nif) {
        this.nif = nif;
    }

    public String getBirthday_date() {
        return birthday_date;
    }

    public void setBirthday_date(String birthday_date) {
        this.birthday_date = birthday_date;
    }
}
