package com.example.administration_west.Pages;


import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import androidx.fragment.app.Fragment;

//import com.example.administration_west.Controllers.SharedPrefManager;
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

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

import static com.example.administration_west.Pages.ProductFragment.ip;

public class ProfileFragment extends Fragment {

    TextView tVNome, tVEmail, tVMobile, tVData;
    Button ChangePassword;
    SessionUser sessionUser;
    String getKey;
    String URL_PROFILE = ip + "restful/users/profile";



    public ProfileFragment(){

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_profile, container, false);


        sessionUser= new SessionUser(getContext());
        sessionUser.checkLogin();


        HashMap<String, String> user = sessionUser.getUserDetail();
        getKey= user.get(sessionUser.UNIQUE_KEY);

        tVNome = (TextView) view.findViewById(R.id.tVNomeProfile);
        tVEmail = (TextView) view.findViewById(R.id.tVEmailEditProfile);
        tVMobile = (TextView) view.findViewById(R.id.tVMobileEditProfile);
        tVData = (TextView) view.findViewById(R.id.tVDataEditProfile);
        ChangePassword = (Button) view.findViewById(R.id.buttonMudarPasswordProfile);


        ChangePassword.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                changePasssword();
            }
        });

    return view;
    }

    private void changePasssword() {
        Intent intentMain = new Intent(getContext(), ChangePasswordActivity.class);
        startActivity(intentMain);
    }


    private void getUserDetail(){
        StringRequest stringRequest = new StringRequest(Request.Method.POST, URL_PROFILE,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONObject jsonObject = new JSONObject(response);
                            String status = jsonObject.getString("status");
                            JSONObject jsonArray = jsonObject.getJSONObject("profile");

                            if(status.equals("200")){

                                for(int i=0; i<jsonArray.length();i++) {


                                    String username = jsonArray.getString("username");
                                    String email = jsonArray.getString("email");
                                    String phone_number = jsonArray.getString("phone_number");
                                    String birthday_date = jsonArray.getString("birthday_date");

                                    tVNome.setText(username);
                                    tVEmail.setText(email);
                                    tVMobile.setText(phone_number);
                                    tVData.setText(birthday_date);

                                }
                            }
                        } catch (JSONException e){
                            e.printStackTrace();
                            Toast.makeText(getContext(), "Error" +e.toString(),Toast.LENGTH_LONG).show();

                        }

                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getContext(), "Error" +error.toString(),Toast.LENGTH_LONG).show();


                    }
                }) {
            @Override
            protected Map<String, String>getParams() throws AuthFailureError{
                Map<String, String> params = new HashMap<>();
                params.put("profile_key", getKey);
                return params;
            }
        };

        RequestQueue requestQueue= Volley.newRequestQueue(getContext());
        requestQueue.add(stringRequest);
    }
    @Override
    public void onResume(){
        super.onResume();
        getUserDetail();
    }
}
