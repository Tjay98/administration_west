package com.example.administration_west.Pages;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.administration_west.Models.SessionUser;
import com.example.administration_west.R;
import com.google.android.material.textfield.TextInputLayout;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

import static com.example.administration_west.Pages.ProductFragment.ip;

public class ShippingAddressActivity  extends AppCompatActivity {

        TextInputLayout eTName, eTNIF, eTMobile, eTCidade, eTMorada, eTCodigo;
        Button buttonMorada, buttonVoltar;

        String SEND_SHIPPING_ADRRESS_URL = ip + "restful/create_shipping";

        SessionUser sessionUser;
        String getKey;

        @Override
        protected void onCreate(Bundle savedInstanceState) {
            super.onCreate(savedInstanceState);
            setContentView(R.layout.shipping_address);

            sessionUser= new SessionUser(getApplicationContext());
            sessionUser.checkLogin();


            HashMap<String, String> user = sessionUser.getUserDetail();
            getKey= user.get(sessionUser.UNIQUE_KEY);

            //procurar nas vistas os id para fazer o registo
            //EditText
            eTName=findViewById(R.id.eTNameShippingAdress);
            eTNIF=findViewById(R.id.eTNifShippingAdress);
            eTMobile=findViewById(R.id.eTMobileShippingAdress);
            eTCidade=findViewById(R.id.etCidadeShippingAdress);
            eTMorada=findViewById(R.id.eTmoradaShippingAdress);
            eTCodigo=findViewById(R.id.etcodigoShippingAdress);
            //Button
            buttonMorada=findViewById(R.id.buttonEnviarMoradaipping);
            buttonVoltar=findViewById(R.id.buttonVoltarShipping);


            //clicar no botao para ligar vista do Login no Registo
            buttonVoltar.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    cartShoppingPage();
                }
            });

            buttonMorada.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    validateName();
                    validateNif();
                    validadeMobile();
                    validateCidade();
                    validadeMorada();
                    validadeCodigo();
                    if(validateName() && validateNif() && validadeMobile() && validateCidade() && validadeMorada() && validadeCodigo()){
                        registarShippingAddress();
                    }
                }
            });
        }

        public void cartShoppingPage(){
            Intent intent=new Intent(this,CartActivity.class);
            startActivity(intent);
            finish();
        }

    public void BillingAddress(){
        Intent intent=new Intent(this,BillingAddressActivity.class);
        startActivity(intent);
        finish();
    }

        private void registarShippingAddress() {
            final String name = eTName.getEditText().getText().toString();
            final String nif = eTNIF.getEditText().getText().toString();
            final String mobile = eTMobile.getEditText().getText().toString();
            final String cidade = eTCidade.getEditText().getText().toString();
            final String morada = eTMorada.getEditText().getText().toString();
            final String codigo = eTCodigo.getEditText().getText().toString();


            StringRequest stringRequest = new StringRequest(Request.Method.POST, SEND_SHIPPING_ADRRESS_URL,
                    new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            try {
                                //converting response to json object
                                JSONObject jsonObject = new JSONObject(response);

                                String status = jsonObject.getString("status");

                                if (status.equals("200")) {
                                    Toast.makeText(ShippingAddressActivity.this, "Morada efetuado com sucesso!", Toast.LENGTH_LONG).show();
                                    BillingAddress();

                                }else{
                                    Toast.makeText(ShippingAddressActivity.this, status, Toast.LENGTH_LONG).show();
                                }


                            } catch (JSONException e) {
                                e.printStackTrace();
                                Toast.makeText(ShippingAddressActivity.this, "Erro no registo! " + e.toString(), Toast.LENGTH_LONG).show();

                            }
                        }
                    },
                    new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            Toast.makeText(ShippingAddressActivity.this, "Erro no registo! " + error.toString(), Toast.LENGTH_LONG).show();
                        }
                    }) {
                @Override
                protected Map<String, String> getParams() throws AuthFailureError {
                    Map<String, String> params = new HashMap<>();
                    params.put("profile_key", getKey);
                    params.put("name", name);
                    params.put("nif", nif);
                    params.put("contact", mobile);
                    params.put("city", cidade);
                    params.put("address", morada);
                    params.put("zip", codigo);

                    return params;
                }
            };

            RequestQueue requestQueue = Volley.newRequestQueue(this);
            requestQueue.add(stringRequest);

        }


        // validação de dados Nome
        public Boolean validateName(){
            String name = eTName.getEditText().getText().toString();
            if(name.isEmpty()) {
                eTName.setError("Nome não pode estar vazio");
                return false;
            } else if(name.length()<1 ||name.length()>255) {
                eTName.setError("O nome não tem o tamanho permitido");
                return false;
            } else {
                eTName.setError(null);
                return true;
            }
        }

        // validação de dados Email
        public Boolean validateNif(){
            String nif = eTNIF.getEditText().getText().toString();
            if(nif.isEmpty()) {
                eTNIF.setError("NIF não pode estar vazio");
                return false;
            } else if(nif.length()!=9) {
                eTNIF.setError("O NIF não tem o tamanho permitido");
                return false;
            }else if(nif.matches("(?=.*[0-9])")) {
                eTNIF.setError("O NIF tem de ser só números");
                    return false;
            } else {
                eTNIF.setError(null);
                return true;
            }
        }

        // validação de dados Password
        public Boolean validadeMobile(){
            String mobile = eTMobile.getEditText().getText().toString();
            if(mobile.isEmpty()) {
                eTMobile.setError("Telemóvel não pode estar vazio");
                return false;
            } else if(mobile.length()!=9) {
                eTMobile.setError("O Telemóvel não tem o tamanho permitido");
                return false;
            }
            else if(mobile.matches("(?=.*[0-9])")) {
                eTMobile.setError("O Telemóvel tem de ser só números");
                return false;
            } else {
                eTMobile.setError(null);
                return true;
            }
        }

        // validação de dados Password
        public Boolean validateCidade(){
            String cidade = eTCidade.getEditText().getText().toString();
            if(cidade.isEmpty()) {
                eTCidade.setError("A cidade não pode estar vazia");
                return false;
            } else if(cidade.length()<1 ||cidade.length()>255) {
                eTCidade.setError("A cidade não tem o tamanho permitido");
                return false;
            } else {
                eTCidade.setError(null);
                return true;
            }
        }

        // validação de dados Password
        public Boolean validadeMorada(){
            String morada = eTMorada.getEditText().getText().toString();
            if(morada.isEmpty()) {
                eTMorada.setError("A morada não pode estar vazia");
                return false;
            } else if(morada.length()<1 ||morada.length()>255) {
                eTMorada.setError("A morada não tem o tamanho permitido");
                return false;
            }
            else {
                eTMorada.setError(null);
                return true;
            }
        }

        public Boolean validadeCodigo(){
        String codigo = eTCodigo.getEditText().getText().toString();
        if(codigo.isEmpty()) {
            eTCodigo.setError("O código não pode estar vazia");
            return false;
        } else if(codigo.length()!=8) {
            eTCodigo.setError("O código não tem o tamanho permitido");
            return false;
        }
        else {
            eTCodigo.setError(null);
            return true;
        }
    }

    }
