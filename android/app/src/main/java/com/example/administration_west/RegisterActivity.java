package com.example.administration_west;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

public class RegisterActivity extends AppCompatActivity {

    EditText eTName, eTEmail, eTNif, eTDataNascimento, eTPassword, eTPassword2;
    Button buttonRegister, buttonDoLogin;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        //procurar nas vistas os id para fazer o registo
        //EditText
        eTName=findViewById(R.id.eTNameRegister);
        eTEmail=findViewById(R.id.eTEmailRegister);
        eTNif=findViewById(R.id.eTNIFRegister);
        eTDataNascimento=findViewById(R.id.etDataRegister);
        eTPassword=findViewById(R.id.eTPasswordRegister);
        eTPassword2=findViewById(R.id.etPasswordRegister2);
        //Button
        buttonRegister=findViewById(R.id.buttonRegister);
        buttonDoLogin=findViewById(R.id.buttonLoginRegister);


        //clicar no botao para ligar vista do Login no Registo
        buttonDoLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent=new Intent(RegisterActivity.this,LoginActivity.class);
                startActivity(intent);
            }
        });
    }

    // validação de dados Nome
    public Boolean validateName(){
        String name = eTName.getText().toString();
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
    public Boolean validateEmail(){
        String email = eTEmail.getText().toString();
        if(email.isEmpty()) {
            eTEmail.setError("Email não pode estar vazio");
            return false;
        } else if(email.length()<6 ||email.length()>255) {
            eTEmail.setError("O email não tem o tamanho permitido");
            return false;
        } else {
            eTEmail.setError(null);
            return true;
        }
    }

    // validação de dados Password
    public Boolean validadeNif(){
        String nif = eTNif.getText().toString();
        if(nif.isEmpty()) {
            eTNif.setError("NIF não pode estar vazio");
            return false;
        } else if(nif.length()!=9) {
            eTNif.setError("O NIF não tem o tamanho permitido");
            return false;
        } else {
            eTNif.setError(null);
            return true;
        }
    }

    // validação de dados Password
    public Boolean validadeData(){
        String data = eTDataNascimento.getText().toString();
        if(data.isEmpty()) {
            eTDataNascimento.setError("A data de nascimento não pode estar vazio");
            return false;
        } else {
            eTDataNascimento.setError(null);
            return true;
        }
    }

    // validação de dados Password
    public Boolean validadePassword(){
        String password = eTPassword.getText().toString();
        String password2 = eTPassword2.getText().toString();

        if(password.isEmpty()) {
            eTPassword.setError("Password não pode estar vazio @string/login_2");
            return false;
        } else if(password2.isEmpty()) {
            eTPassword2.setError("Repetir password não pode estar vazio");
            return false;
        }else if(password!=password2) {
            eTPassword2.setError("A password repetida tem de ser igual a password");
            return false;
        }else if(password.length()<6 ||password.length()>25) {
            eTPassword.setError("A password não tem o tamanho permitido");
            return false;

        }else if(password.matches("(?=.*[a-z])")) {
            eTPassword.setError("A password tem de ter letra minúscula");
            return false;
        }else if(password.matches("(?=.*[A-Z])")) {
            eTPassword.setError("A password tem de ter letra maiúscula");
            return false;
        }else if(password.matches("(?=.*[0-9])")) {
            eTPassword.setError("A password tem de ter um número");
            return false;
        }else if(password.matches("(?=.*[@#$%^&+=])")) {
            eTPassword.setError("A password tem de ter um caracter especial");
            return false;
        } else {
            eTPassword.setError(null);
            return true;
        }
    }


}