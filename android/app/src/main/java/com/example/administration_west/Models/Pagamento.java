package com.example.administration_west.Models;

public class Pagamento {
    private int id;
    private String nome;

    public Pagamento(int id, String nome){
        this.setId(id);
        this.setNome(nome);
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

}
