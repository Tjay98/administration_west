package com.example.administration_west.Pages;

import android.content.Intent;
import android.os.Bundle;
import android.util.Patterns;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import com.example.administration_west.Models.SessionUser;
import com.example.administration_west.Models.Users;

import com.example.administration_west.R;
import com.example.administration_west.Utils.ProductsJsonParse;
import com.google.android.material.textfield.TextInputLayout;


import androidx.appcompat.app.AppCompatActivity;

import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

import static com.example.administration_west.Pages.ProductFragment.ip;

public class LoginActivity extends AppCompatActivity {

    Button SignUp, DoLogin;
    TextInputLayout etEmail, etPassword;

    String LOGIN_URL = ip + "restful/login";
    SessionUser sessionUser;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        sessionUser= new SessionUser(this);

        //procurar nas vistas os id para fazer o login
        //EditText
        etEmail = findViewById(R.id.eTEmailLogin);
        etPassword = findViewById(R.id.eTPasswordLogin);
        //Button
        DoLogin = findViewById(R.id.buttonLogin);
        SignUp = findViewById(R.id.buttonDoRegistLogin);


        //clicar no botao para ligar vista do Registo no Login
        SignUp.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                mostraRegisto();
            }
        });

        DoLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (!ProductsJsonParse.isConnected(getApplicationContext())) {
                    Toast.makeText(getApplicationContext(), "Não tem ligação à internet", Toast.LENGTH_SHORT).show();
                } else {
                    validateEmail();
                    validatePassword();
                    login();
                }
            }
        });

    }

    private boolean isEmailValid(String email) {
        return Patterns.EMAIL_ADDRESS.matcher(email).matches();
    }

    private void mostraRegisto() {
        Intent intentRegist = new Intent(this, RegisterActivity.class);
        startActivity(intentRegist);
        finish();
    }

    private void mainactivity() {
        Intent intentMain = new Intent(this, MainActivity.class);
        startActivity(intentMain);
        finish();
    }


    // validação de dados Email
    public Boolean validateEmail() {
        String email = etEmail.getEditText().getText().toString();
        if (isEmailValid(email)) {
            if (email.isEmpty()) {
                etEmail.setError("Email não pode estar vazio");
                return false;
            } else if (email.length() < 6 || email.length() > 255) {
                etEmail.setError("O email não tem o tamanho permitido");
                return false;
            } else {
                etEmail.setError(null);
                return true;
            }
        }else{
            etEmail.setError("Escreva um email");
            return false;
        }
    }

    // validação de dados Password
    public Boolean validatePassword() {
        String password = etPassword.getEditText().getText().toString();
        if (password.isEmpty()) {
            etPassword.setError("Password não pode estar vazio");
            return false;
        } else if (password.length() < 6 || password.length() > 255) {
            etPassword.setError("A pasword não tem o tamanho permitido");
            return false;
        } else {
            etPassword.setError(null);
            return true;
        }
    }

    private void login() {

        final String email = etEmail.getEditText().getText().toString();
        final String password = etPassword.getEditText().getText().toString();

        StringRequest request = new StringRequest(Request.Method.POST, LOGIN_URL, new Response.Listener<String>(){


            @Override
            public void onResponse(String response) {
                try{
                    JSONObject jsonObject = new JSONObject(response);
                    String status = jsonObject.getString("status");
                    if (status.equals("200")){
                            String key = jsonObject.getString("key");
                            sessionUser.createSession(key);
                            Toast.makeText(LoginActivity.this, "Bem Vindo!",Toast.LENGTH_LONG).show();
                            mainactivity();
                        }
                    else{
                        Toast.makeText(LoginActivity.this, "Aconteceu algum problema! Verifique se o email e a password estão corretas.",Toast.LENGTH_LONG).show();

                    }


                } catch (Exception e) {
                    e.printStackTrace();
                    Toast.makeText(LoginActivity.this, "Error" +e.toString(),Toast.LENGTH_LONG).show();

                }
            }
        },new Response.ErrorListener(){
            @Override
            public void onErrorResponse(VolleyError volleyError) {
                Toast.makeText(LoginActivity.this, "Error" +volleyError.toString(),Toast.LENGTH_LONG).show();

            }
        }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("email", email);
                params.put("password", password);
                return params;
            }
        };

        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(request);

    }
}