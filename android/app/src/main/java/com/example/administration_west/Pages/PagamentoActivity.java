package com.example.administration_west.Pages;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import androidx.appcompat.app.AppCompatActivity;

import com.example.administration_west.R;

public  class PagamentoActivity extends AppCompatActivity {

    Button Pagamento;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pagamento);

        Pagamento = findViewById(R.id.buttonProsseguirPagamento);


        Pagamento.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                mostrarMorada();
            }
        });
    }


    private void mostrarMorada() {
        Intent intentMorada = new Intent(this, FinalizarCompraActivity.class);
        startActivity(intentMorada);
        finish();
    }

}