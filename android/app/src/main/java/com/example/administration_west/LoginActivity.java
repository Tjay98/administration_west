package com.example.administration_west;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import androidx.appcompat.app.AppCompatActivity;

public class LoginActivity extends AppCompatActivity {

    Button SignUp, DoLogin;
    EditText etEmail, etPassword;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);


        //procurar nas vistas os id para fazer o login
        //EditText
        etEmail=findViewById(R.id.eTEmailLogin);
        etPassword=findViewById(R.id.eTPasswordLogin);
        //Button
        SignUp=findViewById(R.id.buttonDoRegistLogin);
        DoLogin=findViewById(R.id.buttonLogin);

        //clicar no botao para ligar vista do Registo no Login
        SignUp.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View view){
                Intent intent= new Intent(LoginActivity.this,RegisterActivity.class);
                startActivity(intent);
            }
        });
    }

    // validação de dados Email
    public Boolean validateEmail(){
        String email = etEmail.getText().toString();
        if(email.isEmpty()) {
            etEmail.setError("Email não pode estar vazio");
            return false;
        } else if(email.length()<6 ||email.length()>255) {
            etEmail.setError("O email não tem o tamanho permitido");
            return false;
        } else {
            etEmail.setError(null);
            return true;
        }
    }

    // validação de dados Password
    public Boolean validadePassword(){
        String password = etPassword.getText().toString();
        if(password.isEmpty()) {
            etEmail.setError("Password não pode estar vazio");
            return false;
        } else if(password.length()<6 ||password.length()>255) {
            etEmail.setError("A pasword não tem o tamanho permitido");
            return false;
        } else {
            etEmail.setError(null);
            return true;
        }
    }





}
