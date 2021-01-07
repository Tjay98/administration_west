package com.example.administration_west.Pages;

import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.administration_west.Adapters.CategoriesAdapter;
import com.example.administration_west.Adapters.CompaniesAdapter;
import com.example.administration_west.Adapters.ProductsAdapter;
import com.example.administration_west.Models.Categories;
import com.example.administration_west.Models.Companies;
import com.example.administration_west.Models.Products;
import com.example.administration_west.R;
import com.example.administration_west.Utils.CategoriesJsonParse;
import com.example.administration_west.Utils.ProductsJsonParse;
//import com.example.administration_west.slington.ProductsModel;
import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import com.google.gson.JsonArray;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

import static java.security.AccessController.getContext;

public class ProductActivity extends AppCompatActivity implements ProductsAdapter.OnItemClickListener {

    public static final String EXTRA_PRODUCT_IMAGE = "product_image";
    public static final String EXTRA_PRODUCT_NAME = "product_name";
    public static final String EXTRA_PRODUCT_CATEGORY = "product_category";
    public static final String EXTRA_PRODUCT_COMPANY = "product_company";
    public static final String EXTRA_PRODUCT_DESCRIPTION = "product_description";



    private RecyclerView recyclerViewCategories;
    private RecyclerView recyclerViewProducts;
    private CategoriesAdapter adapterCategories;
    private ProductsAdapter adapterProducts;
    private ArrayList<Categories> categoriesList;
    private ArrayList<Products> productsList;
    private RequestQueue requestQueue;


    public static final String ip = "http://192.168.1.67/administration_west/web_codeigniter/";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_product);

        //Categories
        recyclerViewCategories= findViewById(R.id.RecicleViewCategories);
        recyclerViewCategories.setHasFixedSize(true);
        recyclerViewCategories.setLayoutManager(new LinearLayoutManager(this, LinearLayoutManager.HORIZONTAL,false));

        categoriesList = new ArrayList<>();

        requestQueue = Volley.newRequestQueue(this);
        parseJSONCategories(getApplicationContext());

        //Products
        recyclerViewProducts= findViewById(R.id.RecicleViewProduct);
        recyclerViewProducts.setHasFixedSize(true);
        recyclerViewProducts.setLayoutManager(new LinearLayoutManager(this, LinearLayoutManager.VERTICAL,false));

        productsList = new ArrayList<>();

        requestQueue = Volley.newRequestQueue(this);
        parseJSONProducts(getApplicationContext());
    }

    private void parseJSONCategories(final Context context){
        String url= ip + "restful/categories";
        JsonArrayRequest request=new JsonArrayRequest(
                Request.Method.GET,
                url,
                null,
                new Response.Listener<JSONArray>() {
                    @Override
                    public void onResponse(JSONArray response) {
                        categoriesList = CategoriesJsonParse.parseJsonCategories(response, context);
                        adapterCategories=new CategoriesAdapter(ProductActivity.this, categoriesList);
                        recyclerViewCategories.setAdapter(adapterCategories);
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                error.printStackTrace();
            }
        });
        requestQueue.add(request);
    }

    private void parseJSONProducts(final Context context){
        String url= ip + "restful/products";
        JsonArrayRequest request=new JsonArrayRequest(
                Request.Method.GET,
                url,
                null,
                new Response.Listener<JSONArray>() {
                    @Override
                    public void onResponse(JSONArray response) {
                        productsList = ProductsJsonParse.parseJsonProducts(response, context);
                        adapterProducts = new ProductsAdapter(ProductActivity.this, productsList);
                        recyclerViewProducts.setAdapter(adapterProducts);
                        adapterProducts.setOnItemClickListener(ProductActivity.this);

                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                error.printStackTrace();
            }
        });
        requestQueue.add(request);
    }

    @Override
    public void onItemClick(int position) {
        Intent detail = new Intent (this, DetailsProductsActivity.class);
        Products clicked = productsList.get(position);

        detail.putExtra(EXTRA_PRODUCT_IMAGE, ip + "uploads/products/" + clicked.getImage());
        detail.putExtra(EXTRA_PRODUCT_NAME, clicked.getProduct_name());
        detail.putExtra(EXTRA_PRODUCT_CATEGORY, clicked.getCategory_name());
        detail.putExtra(EXTRA_PRODUCT_COMPANY, clicked.getCompany_name());
        detail.putExtra(EXTRA_PRODUCT_DESCRIPTION, clicked.getBig_description());

        startActivity(detail);

    }
}

