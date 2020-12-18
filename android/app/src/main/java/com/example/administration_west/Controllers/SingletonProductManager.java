package com.example.administration_west.Controllers;

import android.content.Context;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.administration_west.Models.Products;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.security.AccessControlContext;
import java.util.ArrayList;

public class SingletonProductManager {
    private ArrayList<Products> productlist;

    private static SingletonProductManager INSTANCE;

    //get product url
    private static final String mUrlApiProductsGet = "http://localhost/administration_west/web_codeigniter/restful/products";

    //volley
    private static RequestQueue volleyQueue;

    public static synchronized SingletonProductManager getInstance(Context context) {

        if (INSTANCE == null) {
            INSTANCE = new SingletonProductManager(context);
            
            volleyQueue = Volley.newRequestQueue(context);
        }

        return(INSTANCE);

    }

    private SingletonProductManager(Context context){
        this.productlist = new ArrayList<Products>();
    }
    

    public ArrayList<Products> getProductlist(){
        return this.productlist;
    }
    
    public Products getProducts(long id){
        for(Products product: this.productlist){
            if(product.getId() == id)
                return product;
        }
        return null;
    }



}
