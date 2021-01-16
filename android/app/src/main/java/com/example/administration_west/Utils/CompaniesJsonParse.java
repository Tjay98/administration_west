package com.example.administration_west.Utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.widget.Toast;

import com.example.administration_west.Models.Companies;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class CompaniesJsonParse {
    public static boolean isConnected(Context contexto){
        ConnectivityManager cm= (ConnectivityManager) contexto.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo= cm.getActiveNetworkInfo();

        return networkInfo != null&&networkInfo.isConnected();
    }

    public static ArrayList<Companies> parseJsonCompanies(JSONArray response, Context contexto){
        ArrayList<Companies> lista= new ArrayList<Companies>();
        try {
            for(int i =0; i<response.length(); i++){

                JSONObject companiesapi = (JSONObject)response.get(i);

                Companies companies=new Companies(companiesapi.getInt("id"),
                        companiesapi.getString("company_name"),
                        companiesapi.getString("image"),
                        companiesapi.getString("description"));


                lista.add(companies);
            }
        }catch (JSONException e) {
            e.printStackTrace();
            Toast.makeText(contexto, "ERRO:" + e.getMessage(), Toast.LENGTH_SHORT).show();
        }

        return lista;
    }


    public static Companies parserJsonCompanies(JSONObject response, Context contexto){
        Companies companies = null;
        try {
            companies =new Companies(response.getInt("id"),
                    response.getString("company_name"),
                    response.getString("image"),
                    response.getString("description"));

        }catch (JSONException e) {
            e.printStackTrace();
            Toast.makeText(contexto, "ERRO:" + e.getMessage(), Toast.LENGTH_SHORT).show();
        }
        return companies;
    }


}