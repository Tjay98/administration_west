package com.example.administration_west.Models;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;

import com.example.administration_west.Pages.LoginActivity;
import com.example.administration_west.Pages.MainActivity;

import java.util.HashMap;

public class SessionUser {

    SharedPreferences sharedPreferences;
    public SharedPreferences.Editor editor;
    public Context context;
    int PRIVATE_MODE = 0;

    private static final String PREF_NAME = "LOGIN";
    private  static final String LOGIN = "IS_LOGIN";
    public static final String EMAIL = "EMAIL";
    public static final String UNIQUE_KEY = "UNIQUE_KEY";


    public SessionUser(Context context){
        this.context = context;
        sharedPreferences = context.getSharedPreferences("LOGIN", PRIVATE_MODE);
        editor=sharedPreferences.edit();
    }

    public void createSession(String email, String key){
        editor.putBoolean(LOGIN, true);
        editor.putString(EMAIL, email);
        editor.putString(UNIQUE_KEY, email);
        editor.apply();
    }

    public boolean isLogin(){
        return  sharedPreferences.getBoolean(LOGIN, false);
    }

    public void checkLogin(){
        if(!this.isLogin()){
            Intent intent = new Intent(context, LoginActivity.class);
            context.startActivity(intent);
            ((MainActivity)context).finish();
        }
    }

    public HashMap<String, String> getUserDetail(){
        HashMap<String, String> user = new HashMap<>();
        user.put(EMAIL, sharedPreferences.getString(EMAIL, null));
        user.put(UNIQUE_KEY, sharedPreferences.getString(UNIQUE_KEY, null));

        return user;
    }

    public void logout(){
        editor.clear();
        editor.commit();
        Intent intent = new Intent(context, LoginActivity.class);
        context.startActivity(intent);
        ((MainActivity) context).finish();
    }

}
