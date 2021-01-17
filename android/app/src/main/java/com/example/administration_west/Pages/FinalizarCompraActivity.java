package com.example.administration_west.Pages;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.TextView;
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
import com.example.administration_west.Models.SessionUser;
import com.example.administration_west.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;


import static com.example.administration_west.Pages.CartActivity.EXTRA_TOTAL_PRECO;
import static com.example.administration_west.Pages.PagamentoActivity.EXTRA_PAGAMENTO_ID;
import static com.example.administration_west.Pages.PagamentoActivity.EXTRA_PAGAMENTO_NOME;
import static com.example.administration_west.Pages.ProductFragment.EXTRA_PRODUCT_PRICE;
import static com.example.administration_west.Pages.ProductFragment.ip;


public class FinalizarCompraActivity extends AppCompatActivity {

    Button Main, FinalizarCompra;

    String CREATE_SALE_URL = ip + "restful/new_create_sale";
    String SHIPPING_ADDRESS = ip +"/restful/users/shipping_address";
    String BILLING_ADDRESS = ip +"/restful/users/billing_address";
    TextView nome_entrega, telemovel_entrega, morada_entrega, codigo_entrega;
    TextView nome_fatura, telemovel_fatura, morada_fatura, codigo_fatura;
    TextView pagamento, preco_total;
    SessionUser sessionUser;
    String getKey;
    String getPagamento;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_finalizar_compra);

        sessionUser= new SessionUser(getApplicationContext());
        sessionUser.checkLogin();

        HashMap<String, String> user = sessionUser.getUserDetail();
        getKey= user.get(sessionUser.UNIQUE_KEY);

        Intent intent = getIntent();
        String pagamento_id = intent.getExtras().getString(EXTRA_PAGAMENTO_ID);
        String pagamento_nome = intent.getExtras().getString(EXTRA_PAGAMENTO_NOME);


        getPagamento= pagamento_id;
        //Shipping
        nome_entrega = findViewById(R.id.tVNomeEntregaFC);
        telemovel_entrega = findViewById(R.id.tVTelemovelEntregaFC);
        morada_entrega = findViewById(R.id.tVMoradaEntregaFC);
        codigo_entrega = findViewById(R.id.tVCodigoPostalEntregaFC);

        //Billing
        nome_fatura = findViewById(R.id.tVNomeFaturacaoFC);
        telemovel_fatura = findViewById(R.id.tVTelemovelFaturacaoFC);
        morada_fatura = findViewById(R.id.tVMoradaFaturacaoFC);
        codigo_fatura = findViewById(R.id.tVCodigoPostalFaturacaoFC);

        pagamento = findViewById(R.id.tVPagamentoFC);


        pagamento.setText(pagamento_nome);

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
                createSale();
            }
        });

        getShippingAddress();
        getBillingAddress();
    }
    private void mostrarMain() {
        Intent intentMain = new Intent(this, MainActivity.class);
        startActivity(intentMain);
        finish();
    }

    private void getShippingAddress(){
        StringRequest stringRequest = new StringRequest(Request.Method.POST, SHIPPING_ADDRESS,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONObject jsonObject = new JSONObject(response);
                            String status = jsonObject.getString("status");
                            JSONObject jsonArray = jsonObject.getJSONObject("shipping_address");
                            if(status.equals("200")){
                                for(int i=0; i<jsonArray.length();i++) {

                                    String nome_shipping = jsonArray.getString("name");
                                   // String email = jsonArray.getString("nif");
                                    String telemovel_shipping = jsonArray.getString("contact_number");
                                    //String phone_number = jsonArray.getString("city");
                                    String morada_shipping = jsonArray.getString("address");
                                    String codigo_shipping = jsonArray.getString("zip_code");


                                    nome_entrega.setText(nome_shipping);
                                    telemovel_entrega.setText(telemovel_shipping);
                                    morada_entrega.setText(morada_shipping);
                                    codigo_entrega.setText(codigo_shipping);
                                }
                            }
                        } catch (JSONException e){
                            e.printStackTrace();
                            Toast.makeText(getApplicationContext(), "Error" +e.toString(),Toast.LENGTH_LONG).show();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getApplicationContext(), "Error" +error.toString(),Toast.LENGTH_LONG).show();


                    }
                }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("profile_key", getKey);
                return params;
            }
        };

        RequestQueue requestQueue= Volley.newRequestQueue(getApplicationContext());
        requestQueue.add(stringRequest);
    }

    private void getBillingAddress(){
        StringRequest stringRequest = new StringRequest(Request.Method.POST, BILLING_ADDRESS,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONObject jsonObject = new JSONObject(response);
                            String status = jsonObject.getString("status");
                            JSONObject jsonArray = jsonObject.getJSONObject("billing_address");
                            if(status.equals("200")){
                                for(int i=0; i<jsonArray.length();i++) {

                                    String nome_billing = jsonArray.getString("name");
                                    // String email = jsonArray.getString("nif");
                                    String telemovel_billing = jsonArray.getString("contact_number");
                                    //String phone_number = jsonArray.getString("city");
                                    String morada_billing = jsonArray.getString("address");
                                    String codigo_billing = jsonArray.getString("zip_code");


                                    nome_fatura.setText(nome_billing);
                                    telemovel_fatura.setText(telemovel_billing);
                                    morada_fatura.setText(morada_billing);
                                    codigo_fatura.setText(codigo_billing);

                                }
                            }
                        } catch (JSONException e){
                            e.printStackTrace();
                            Toast.makeText(getApplicationContext(), "Error" +e.toString(),Toast.LENGTH_LONG).show();

                        }

                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getApplicationContext(), "Error" +error.toString(),Toast.LENGTH_LONG).show();


                    }
                }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("profile_key", getKey);
                return params;
            }
        };

        RequestQueue requestQueue= Volley.newRequestQueue(getApplicationContext());
        requestQueue.add(stringRequest);
    }

    private void createSale(){
        StringRequest stringRequest = new StringRequest(Request.Method.POST, CREATE_SALE_URL,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try{
                            JSONObject jsonObject = new JSONObject(response);
                            String status = jsonObject.getString("status");
                            if (status.equals("200")){
                                Toast.makeText(FinalizarCompraActivity.this, "Compra efetuada com sucesso!",Toast.LENGTH_LONG).show();
                            } else if(status.equals("412")) {
                                Toast.makeText(FinalizarCompraActivity.this, "Falta de stock num dos produtos. Contacte-nos",Toast.LENGTH_LONG).show();
                            } else{
                                Toast.makeText(FinalizarCompraActivity.this, "Alguma informação está errada. Contacte-nos",Toast.LENGTH_LONG).show();
                            }
                        } catch (JSONException e){
                            e.printStackTrace();
                            Toast.makeText(getApplicationContext(), "Erro " +e.toString(),Toast.LENGTH_LONG).show();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getApplicationContext(), "Erro " +error.toString(),Toast.LENGTH_LONG).show();
                    }
                }) {
            @Override
            protected Map<String, String>getParams() throws AuthFailureError{
                Map<String, String> params = new HashMap<>();
                params.put("profile_key", getKey);
                params.put("payment_id", getPagamento);
                return params;
            }
        };

        RequestQueue requestQueue= Volley.newRequestQueue(getApplicationContext());
        requestQueue.add(stringRequest);
    }

}
