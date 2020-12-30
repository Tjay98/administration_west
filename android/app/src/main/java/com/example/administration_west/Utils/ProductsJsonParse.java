package com.example.administration_west.Utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.widget.Toast;

import com.example.administration_west.Models.Products;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class ProductsJsonParse {
    public static boolean isConnectionInternet(Context contexto){
        ConnectivityManager cm= (ConnectivityManager) contexto.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo= cm.getActiveNetworkInfo();

        return networkInfo != null&&networkInfo.isConnected();
    }
/*
    public static ArrayList<Products> parseJsonProducts(JSONArray response, Context contexto){
        ArrayList<Products> lista= new ArrayList<Products>();
        try {
            for(int i =0; i<response.length(); i++){

                JSONObject productapi = (JSONObject)response.get(i);

                Products products=new Products(productapi.getLong("id"),
                        productapi.getString("product_name"),
                        productapi.getString("image"),
                        productapi.getString("big_description"),
                        productapi.getString("category_name"),
                        productapi.getInt("category_id"),
                        productapi.getString("company_name"),
                        productapi.getInt("company_id"),
                        productapi.getInt("quantity_in_stock"),
                        productapi.getDouble("price"),
                        productapi.getDouble("price_iva"));

                lista.add(products);
            }
        }catch (JSONException e) {
            e.printStackTrace();
            Toast.makeText(contexto, "ERRO:" + e.getMessage(), Toast.LENGTH_SHORT).show();
        }

        return lista;
    }

    public static Products parserJsonProducts(JSONObject response, Context contexto){
        Products products = null;
        try {
            products =new Products(response.getLong("id"),
                    response.getString("product_name"),
                    response.getString("image"),
                    response.getString("big_description"),
                    response.getString("category_name"),
                    response.getInt("category_id"),
                    response.getString("company_name"),
                    response.getInt("company_id"),
                    response.getInt("quantity_in_stock"),
                    response.getDouble("price"),
                    response.getDouble("price_iva"));
        }catch (JSONException e) {
            e.printStackTrace();
            Toast.makeText(contexto, "ERRO:" + e.getMessage(), Toast.LENGTH_SHORT).show();
        }
        return products;
    }*/

}