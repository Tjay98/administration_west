package com.example.administration_west.Pages;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import androidx.appcompat.app.AppCompatActivity;

import com.example.administration_west.R;

public class CartActivity extends AppCompatActivity {


    Button Compra, Pagamento;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cart);


        Compra = findViewById(R.id.buttonContinuarComprar);
        Pagamento = findViewById(R.id.buttonFinalizarCompras);

        Compra.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                mostrarMainAcivity();
            }
        });

        Pagamento.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                mostrarMorada();
            }
        });
    }

    private void mostrarMainAcivity() {
        Intent intentMain = new Intent(this, MainActivity.class);
        startActivity(intentMain);
        finish();
    }

    private void mostrarMorada() {
        Intent intentMorada = new Intent(this, MoradasActivity.class);
        startActivity(intentMorada);
        finish();
    }


}