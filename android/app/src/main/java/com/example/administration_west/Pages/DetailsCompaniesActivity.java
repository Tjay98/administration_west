package com.example.administration_west.Pages;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;

import com.example.administration_west.R;

public class DetailsCompaniesActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_details_companies);
    }

    public static class FinalizarCompraActivity extends AppCompatActivity {

        @Override
        protected void onCreate(Bundle savedInstanceState) {
            super.onCreate(savedInstanceState);
            setContentView(R.layout.activity_finalizar_compra);
        }
    }
}