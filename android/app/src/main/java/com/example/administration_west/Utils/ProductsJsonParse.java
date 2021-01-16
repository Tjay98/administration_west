package com.example.administration_west.Utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.widget.Toast;

import com.example.administration_west.Models.Companies;
import com.example.administration_west.Models.Products;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class ProductsJsonParse {
    public static boolean isConnected(Context contexto){
        ConnectivityManager cm= (ConnectivityManager) contexto.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo= cm.getActiveNetworkInfo();

        return networkInfo != null&&networkInfo.isConnected();
    }

    public static ArrayList<Products> parseJsonProducts(JSONArray response, Context contexto){
        ArrayList<Products> lista= new ArrayList<Products>();
        try {
            for(int i =0; i<response.length(); i++){

                JSONObject productsapi = (JSONObject)response.get(i);

                Products products=new Products(productsapi.getInt("id"),
                        productsapi.getString("product_name"),
                        productsapi.getString("image"),
                        productsapi.getString("big_description"),
                        productsapi.getString("category_name"),
                        productsapi.getInt("category_id"),
                        productsapi.getString("company_name"),
                        productsapi.getInt("company_id"),
                        productsapi.getInt("quantity_in_stock"),
                        productsapi.getDouble("price"),
                        productsapi.getDouble("price_iva")
                );

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
            products =new Products(response.getInt("id"),
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
    }
}