package com.example.administration_west.Pages;


import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;
import com.example.administration_west.Models.Users;
import com.example.administration_west.R;

public class ProfileActivity extends AppCompatActivity {

    TextView tVNome, tVEmail, tVMobile, tVData;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);

//        //if the user is not logged in
//        //starting the login activity
//        if (!SharedPrefManager.getInstance(this).isLoggedIn()) {
//            finish();
//            startActivity(new Intent(this, LoginActivity.class));
//        }
//
//        tVNome = (TextView) findViewById(R.id.tVNomeProfile);
//        tVEmail = (TextView) findViewById(R.id.tVEmailProfile);
//        tVMobile = (TextView) findViewById(R.id.tVMobileProfile);
//        tVData = (TextView) findViewById(R.id.tVDataProfile);
//
//        Users user = SharedPrefManager.getInstance(this).getUser();
//
//        //setting the values to the textviews
//        tVNome.setText(String.valueOf(user.getUsername()));
//        tVEmail.setText(user.getEmail());
//        tVMobile.setText(user.getMobile());
//        tVData.setText(user.getBirthday_date());


    }
}
