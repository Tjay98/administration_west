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
import com.google.android.material.textfield.TextInputEditText;
import com.google.android.material.textfield.TextInputLayout;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

import static com.example.administration_west.Pages.ProductFragment.ip;

public class BillingAddressActivity extends AppCompatActivity {


    TextInputLayout eTName, eTNIF, eTMobile, eTCidade, eTMorada, eTCodigo;
    TextInputEditText Name, NIF, Mobile, Cidade, Morada, Codigo;

    Button buttonMorada, buttonVoltar;

    String SEND_BILLING_ADRRESS_URL = ip + "restful/create_billing";
    String BILLING_ADDRESS = ip +"/restful/users/billing_address";


    SessionUser sessionUser;
    String getKey;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.billing_address);

        sessionUser= new SessionUser(getApplicationContext());
        sessionUser.checkLogin();


        HashMap<String, String> user = sessionUser.getUserDetail();
        getKey= user.get(sessionUser.UNIQUE_KEY);

        //procurar nas vistas os id para fazer o registo
        //EditText
        eTName=findViewById(R.id.eTNameBillingAddress);
        eTNIF=findViewById(R.id.eTNifBillingAddress);
        eTMobile=findViewById(R.id.eTMobileBillingAddress);
        eTCidade=findViewById(R.id.etCidadeBillingAddress);
        eTMorada=findViewById(R.id.eTmoradaBillingAddress);
        eTCodigo=findViewById(R.id.etcodigoBillingAddress);

            Name=findViewById(R.id.NameBillingAddress);
            NIF=findViewById(R.id.NifBillingAddress);
            Mobile=findViewById(R.id.MobileBillingAddress);
            Cidade=findViewById(R.id.CidadeBillingAddress);
            Morada=findViewById(R.id.moradaBillingAddress);
            Codigo=findViewById(R.id.codigoBillingAddress);

        //Button
        buttonMorada=findViewById(R.id.buttonEnviarBillingAddress);
        buttonVoltar=findViewById(R.id.buttonVoltarBillingAddress);

        getBillingAddress();

        //clicar no botao para ligar vista do Login no Registo
        buttonVoltar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                shippingPage();
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
                    registarBillingAddress();
                }
            }
        });
    }

    public void shippingPage(){
        Intent intent=new Intent(this,ShippingAddressActivity.class);
        startActivity(intent);
        finish();
    }

    public void Pagamentos(){
        Intent intent=new Intent(this,PagamentoActivity.class);
        startActivity(intent);
        finish();
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
                                    String nif_billing = jsonArray.getString("nif");
                                    String telemovel_billing = jsonArray.getString("contact_number");
                                    String city_billing = jsonArray.getString("city");
                                    String morada_billing = jsonArray.getString("address");
                                    String codigo_billing = jsonArray.getString("zip_code");


                                    Name.setText(nome_billing);
                                    NIF.setText(nif_billing);
                                    Mobile.setText(telemovel_billing);
                                    Cidade.setText(city_billing);
                                    Morada.setText(morada_billing);
                                    Codigo.setText(codigo_billing);
                                }
                            }
                        } catch (JSONException e){
                            e.printStackTrace();
                            //Toast.makeText(getApplicationContext(), "Error" +e.toString(),Toast.LENGTH_LONG).show();

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

    private void registarBillingAddress() {
        final String name = eTName.getEditText().getText().toString();
        final String nif = eTNIF.getEditText().getText().toString();
        final String mobile = eTMobile.getEditText().getText().toString();
        final String cidade = eTCidade.getEditText().getText().toString();
        final String morada = eTMorada.getEditText().getText().toString();
        final String codigo = eTCodigo.getEditText().getText().toString();


        StringRequest stringRequest = new StringRequest(Request.Method.POST, SEND_BILLING_ADRRESS_URL,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            //converting response to json object
                            JSONObject jsonObject = new JSONObject(response);

                            String status = jsonObject.getString("status");

                            if (status.equals("200")) {
                                Toast.makeText(BillingAddressActivity.this, "Morada registada com sucesso!", Toast.LENGTH_LONG).show();
                                Pagamentos();

                            }else{
                                Toast.makeText(BillingAddressActivity.this, status, Toast.LENGTH_LONG).show();
                            }


                        } catch (JSONException e) {
                            e.printStackTrace();
                            Toast.makeText(BillingAddressActivity.this, "Erro no registo! " + e.toString(), Toast.LENGTH_LONG).show();

                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(BillingAddressActivity.this, "Erro no registo! " + error.toString(), Toast.LENGTH_LONG).show();
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
