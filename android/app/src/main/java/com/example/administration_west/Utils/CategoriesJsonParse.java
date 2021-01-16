package com.example.administration_west.Utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.widget.Toast;

import com.example.administration_west.Models.Categories;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class CategoriesJsonParse {

    public static boolean isConnected(Context contexto){
        ConnectivityManager cm= (ConnectivityManager) contexto.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo= cm.getActiveNetworkInfo();

        return networkInfo != null&&networkInfo.isConnected();
    }


    public static ArrayList<Categories> parseJsonCategories(JSONArray resposta, Context contexto){
        ArrayList<Categories> lista= new ArrayList<Categories>();
        try {

            for(int i =0; i<resposta.length(); i++){

                JSONObject categoriesapi = (JSONObject)resposta.get(i);

                Categories categories=new Categories(categoriesapi.getInt("id"),
                        categoriesapi.getString("category_name"));


                lista.add(categories);
            }
        }catch (JSONException e) {
            e.printStackTrace();
            Toast.makeText(contexto, "ERRO:" + e.getMessage(), Toast.LENGTH_SHORT).show();
        }

        return lista;

    }

    public static Categories parserJsonCategories(JSONObject resposta, Context contexto){
        Categories categories = null;
        try {
            categories =new Categories(resposta.getInt("id"),
                    resposta.getString("category_name"));

        }catch (JSONException e) {
            e.printStackTrace();
            Toast.makeText(contexto, "ERRO:" + e.getMessage(), Toast.LENGTH_SHORT).show();
        }
        return categories;
    }
    //1.5.3 para limpar os dados da tabela



}
