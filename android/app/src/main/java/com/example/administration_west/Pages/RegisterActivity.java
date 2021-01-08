package com.example.administration_west.Pages;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.administration_west.Models.Users;
import com.example.administration_west.R;
import com.google.android.material.textfield.TextInputLayout;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import static com.example.administration_west.Pages.ProductActivity.ip;

public class RegisterActivity extends AppCompatActivity {

    TextInputLayout eTName, eTEmail, eTMobile, eTDataNascimento, eTPassword, eTPassword2;
    Button buttonRegister, buttonDoLogin;

    String SIGN_IN_URL = ip + "restful/register";


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        //procurar nas vistas os id para fazer o registo
        //EditText
        eTName=findViewById(R.id.eTNameRegister);
        eTEmail=findViewById(R.id.eTEmailRegister);
        eTMobile=findViewById(R.id.eTMobileRegister);
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
                loginPage();
            }
        });

        buttonRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                validateName();
                validateEmail();
                validadeMobile();
                validateData();
                validadePassword();
                if(validateName() && validateEmail() && validadeMobile() && validateData() && validadePassword()){
                    registerUser();
                }
            }
        });
    }

    public void loginPage(){
        Intent intent=new Intent(this,LoginActivity.class);
        startActivity(intent);
        finish();
    }

    private void registerUser() {
        final String name = eTName.getEditText().getText().toString();
        final String email = eTEmail.getEditText().getText().toString();
        final String mobile = eTMobile.getEditText().getText().toString();
        final String data = eTDataNascimento.getEditText().getText().toString();
        final String password = eTPassword.getEditText().getText().toString();


        StringRequest stringRequest = new StringRequest(Request.Method.POST, SIGN_IN_URL,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            //converting response to json object
                            JSONObject jsonObject = new JSONObject(response);

                            String status = jsonObject.getString("status");

                            if (status.equals("200")) {
                                Toast.makeText(RegisterActivity.this, "Registo efetuado com sucesso!", Toast.LENGTH_LONG).show();
                                loginPage();

                            }else{
                                Toast.makeText(RegisterActivity.this, status, Toast.LENGTH_LONG).show();
                            }


                        } catch (JSONException e) {
                            e.printStackTrace();
                            Toast.makeText(RegisterActivity.this, "Erro no registo! " + e.toString(), Toast.LENGTH_LONG).show();

                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(RegisterActivity.this, "Erro no registo! " + error.toString(), Toast.LENGTH_LONG).show();
                    }
                }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("username", name);
                params.put("email", email);
                params.put("password", password);
                params.put("phone_number", mobile);
                params.put("birthday", data);

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
    public Boolean validateEmail(){
        String email = eTEmail.getEditText().getText().toString();
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
    public Boolean validateData(){
        String data = eTDataNascimento.getEditText().getText().toString();
        if(data.isEmpty()) {
            eTDataNascimento.setError("A data de nascimento não pode estar vazia");
            return false;
        } else {
            eTDataNascimento.setError(null);
            return true;
        }
    }

    // validação de dados Password
    public Boolean validadePassword(){

        String password = eTPassword.getEditText().getText().toString();
        String password2 = eTPassword2.getEditText().getText().toString();

        Boolean verify_password = true;
        Boolean verify_repeat = true;

        if(password2.isEmpty()) {
            eTPassword2.setError("Repetir password não pode estar vazia");
            verify_repeat = false;
        }
        if(!password.equals(password2)) {
            eTPassword2.setError("A password repetida tem de ser igual à password");
            verify_repeat = false;
        }


         if(password.length()<6 ||password.length()>25) {
            eTPassword.setError("A password não tem o tamanho permitido");
            verify_password = false;
        }else if (!password.matches(".*[a-z].*")) {
            eTPassword.setError("A password deve conter 1 letra minúscula, 1 maiúscula, 1 número e 1 caractere especial");
            verify_password = false;
        }else if(!password.matches(".*[A-Z].*")){
            eTPassword.setError("A password deve conter 1 letra minúscula, 1 maiúscula, 1 número e 1 caractere especial");
            verify_password = false;
        }else if (!password.matches(".*[!@#$%^&*+=?-].*")) {
            eTPassword.setError("A password deve conter 1 letra minúscula, 1 maiúscula, 1 número e 1 caractere especial");
            verify_password = false;
        }


        if(verify_repeat){
            eTPassword2.setError(null);
        }

        if(verify_password){
            eTPassword.setError(null);
        }

        if(verify_repeat && verify_password){

            return true;
        }else{
            return false;
        }
    }




}