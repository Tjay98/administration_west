package com.example.administration_west.Pages;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import androidx.appcompat.app.AppCompatActivity;

import com.example.administration_west.R;

public class MoradasActivity extends AppCompatActivity {


    Button Editar, Prosseguir;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_moradas);

        Editar = findViewById(R.id.buttonEditar);
        Prosseguir = findViewById(R.id.buttonProsseguirMoradas);

        Editar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                mostrarMainAcivity();
            }
        });

        Prosseguir.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                mostrarPagamentos();
            }
        });

    }

    private void mostrarMainAcivity() {
        Intent intentMain = new Intent(this, MainActivity.class);
        startActivity(intentMain);
        finish();
    }

    private void mostrarPagamentos() {
        Intent intentMorada = new Intent(this, PagamentoActivity.class);
        startActivity(intentMorada);
        finish();
    }

}
