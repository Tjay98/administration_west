package com.example.administration_west.Pages;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.administration_west.Adapters.PagamentoAdapter;
import com.example.administration_west.Models.Pagamento;
import com.example.administration_west.Models.Products;
import com.example.administration_west.R;
import com.example.administration_west.Utils.PagamentoJsonParse;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

import static com.example.administration_west.Pages.ProductFragment.ip;

public  class PagamentoActivity extends AppCompatActivity implements PagamentoAdapter.OnItemClickListener{

    String URL_PGAMENTO = ip + "restful/payment_methods/";

    public static final String EXTRA_PAGAMENTO_ID = "pagamento_id";
    public static final String EXTRA_PAGAMENTO_NOME = "pagamento_nome";

    Button Pagamento;

    private RecyclerView recyclerViewPagamento;
    private PagamentoAdapter adapterPagamento;
    private ArrayList<Pagamento> pagamentoList;
    private RequestQueue requestQueue;

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

        recyclerViewPagamento= findViewById(R.id.RecicleViewPagamento);
        recyclerViewPagamento.setHasFixedSize(true);
        recyclerViewPagamento.setLayoutManager(new LinearLayoutManager(getApplicationContext(), LinearLayoutManager.VERTICAL,false));

        pagamentoList = new ArrayList<>();

        requestQueue = Volley.newRequestQueue(getApplicationContext());
        parseJSONPagamento(getApplicationContext());
    }

    public void parseJSONPagamento(final Context context){
            JsonArrayRequest request=new JsonArrayRequest(
                    Request.Method.GET,
                    URL_PGAMENTO,
                    null,
                    new Response.Listener<JSONArray>() {
                        @Override
                        public void onResponse(JSONArray response) {
                            pagamentoList = PagamentoJsonParse.parseJsonPagamento(response, context);
                            adapterPagamento = new PagamentoAdapter(getApplicationContext(), pagamentoList);
                            recyclerViewPagamento.setAdapter(adapterPagamento);
                            adapterPagamento.setOnItemClickListener(PagamentoActivity.this);

                        }
                    }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    error.printStackTrace();
                }
            });
            requestQueue.add(request);
        }




    private void mostrarMorada() {
        Intent intentMorada = new Intent(this, BillingAddressActivity.class);
        startActivity(intentMorada);
        finish();
    }


    @Override
    public void onItemClick(int position) {
        Intent detail = new Intent (getApplicationContext(), FinalizarCompraActivity.class);
        Pagamento clicked = pagamentoList.get(position);

        detail.putExtra(EXTRA_PAGAMENTO_ID, String.valueOf(clicked.getId()));
        detail.putExtra(EXTRA_PAGAMENTO_NOME, String.valueOf(clicked.getNome()));

        startActivity(detail);

    }
}