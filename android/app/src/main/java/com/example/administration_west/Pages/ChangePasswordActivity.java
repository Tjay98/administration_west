package com.example.administration_west.Pages;

import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.content.Intent;
import android.os.Bundle;
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
import com.example.administration_west.R;
import com.google.android.material.textfield.TextInputLayout;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

import static com.example.administration_west.Pages.ProductFragment.ip;

public class ChangePasswordActivity extends AppCompatActivity {

    TextInputLayout eTOldPassword, eTNewPassword, eTRepeatPassword;
    Button buttonChange;
    SessionUser sessionUser;
    String getKey;
    Button buttonVoltarProfile;


    String CHANGE_URL = ip + "restful/users/password";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_change_password);

        sessionUser = new SessionUser(getApplicationContext());
        sessionUser.checkLogin();

        HashMap<String, String> user = sessionUser.getUserDetail();
        getKey = user.get(sessionUser.UNIQUE_KEY);

        //EditText
        eTOldPassword = findViewById(R.id.eTOldPasswordProfile);
        eTNewPassword = findViewById(R.id.eTNewPasswordProfile);
        eTRepeatPassword = findViewById(R.id.eTRepetirPasswordProfile);
        //button
        buttonChange = findViewById(R.id.ButtonChange);
        buttonVoltarProfile = findViewById(R.id.buttonVoltarProfile);


        buttonChange.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                validadePassword();
                if (validadePassword()) {
                    changePassword();
                }
            }
        });

        buttonVoltarProfile.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                mainactivity();
            }
        });
    }
    private void mainactivity() {
        Intent intentMain = new Intent(this, MainActivity.class);
        startActivity(intentMain);
        finish();
    }

    public Boolean validadePassword() {
        String oldPassword = eTOldPassword.getEditText().getText().toString();
        String password = eTNewPassword.getEditText().getText().toString();
        String repeatPassword = eTRepeatPassword.getEditText().getText().toString();

        Boolean verify_password = true;
        Boolean verify_repeat = true;

        //Empty verify
        if (oldPassword.isEmpty()) {
            eTOldPassword.setError("A password não pode estar vazia");
            verify_password = false;
        }

        if (password.isEmpty()) {
            eTNewPassword.setError("A password não pode estar vazia");
            verify_password = false;
        }

        if (repeatPassword.isEmpty()) {
            eTRepeatPassword.setError("A password não pode estar vazia");
            verify_repeat = false;
        }

        //repetir
        if (!password.equals(repeatPassword)) {
            eTRepeatPassword.setError("A password repetida tem de ser igual à password");
            verify_repeat = false;
        }

        //tamanho
        if (password.length() < 6 || password.length() > 25) {
            eTNewPassword.setError("A password não tem o tamanho permitido");
            verify_password = false;
        } else if (!password.matches(".*[a-z].*")) {
            eTNewPassword.setError("A password deve conter 1 letra minúscula, 1 maiúscula, 1 número e 1 caractere especial");
            verify_password = false;
        } else if (!password.matches(".*[A-Z].*")) {
            eTNewPassword.setError("A password deve conter 1 letra minúscula, 1 maiúscula, 1 número e 1 caractere especial");
            verify_password = false;
        } else if (!password.matches(".*[!@#$%^&*+=?-].*")) {
            eTNewPassword.setError("A password deve conter 1 letra minúscula, 1 maiúscula, 1 número e 1 caractere especial");
            verify_password = false;
        }


        if (verify_repeat) {
            eTRepeatPassword.setError(null);
        }

        if (verify_password) {
            eTNewPassword.setError(null);
        }

        if (verify_repeat && verify_password) {
            return true;
        } else {
            return false;
        }
    }

    /*private void profilePage() {
        getSupportFragmentManager().beginTransaction()
                .replace(R.id.contentFragment, new ProfileFragment()).commit();

    }
*/



    private void changePassword() {
        final String oldPassword = eTOldPassword.getEditText().getText().toString();
        final String password = eTNewPassword.getEditText().getText().toString();


        StringRequest stringRequest = new StringRequest(Request.Method.POST, CHANGE_URL,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            //converting response to json object
                            JSONObject jsonObject = new JSONObject(response);

                            String status = jsonObject.getString("status");

                            if (status.equals("200")) {
                                Toast.makeText(ChangePasswordActivity.this, "Password mudada com sucesso!", Toast.LENGTH_LONG).show();
                               // profilePage();

                            }else{
                                Toast.makeText(ChangePasswordActivity.this, status, Toast.LENGTH_LONG).show();
                            }


                        } catch (JSONException e) {
                            e.printStackTrace();
                            Toast.makeText(ChangePasswordActivity.this, "Erro a mudar password! " + e.toString(), Toast.LENGTH_LONG).show();

                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(ChangePasswordActivity.this, "Erro a mudar password! " + error.toString(), Toast.LENGTH_LONG).show();
                    }
                }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("profile_key", getKey);
                params.put("old_password", oldPassword);
                params.put("new_password", password);


                return params;
            }
        };

        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);

    }
}