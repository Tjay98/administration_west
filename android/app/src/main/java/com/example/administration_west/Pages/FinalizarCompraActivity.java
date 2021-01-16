package com.example.administration_west.Pages;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.example.administration_west.R;

public class FinalizarCompraActivity extends AppCompatActivity {

    Button Main, FinalizarCompra;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_finalizar_compra);

        Main = findViewById(R.id.buttonVoltarBillingAddress);

        FinalizarCompra = findViewById(R.id.buttonFinalizarCompra);


        Main.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                mostrarMain();
            }
        });

        FinalizarCompra.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Toast.makeText(FinalizarCompraActivity.this, "Compra efetuada com sucesso",Toast.LENGTH_LONG).show();

            }
        });

    }
    private void mostrarMain() {
        Intent intentMain = new Intent(this, MainActivity.class);
        startActivity(intentMain);
        finish();
    }
}
