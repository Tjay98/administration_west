package com.example.administration_west.Pages;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.administration_west.Models.Cart;
import com.example.administration_west.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

import static com.example.administration_west.Pages.ProductFragment.ip;

public  class PagamentoActivity extends AppCompatActivity {

    String URL_PGAMENTO = ip + "restful/payment_methods/";


    Button Pagamento;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pagamento);

        Pagamento = findViewById(R.id.buttonVoltarBillingAddress);


        Pagamento.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                mostrarMorada();
            }
        });
    }


    private void mostrarMorada() {
        Intent intentMorada = new Intent(this, BillingAddressActivity.class);
        startActivity(intentMorada);
        finish();
    }



}