package com.example.administration_west.Pages;

import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Context;
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
import com.example.administration_west.Adapters.ProductsAdapter;
import com.example.administration_west.Listeners.ProductsListener;
import com.example.administration_west.Models.Categories;
import com.example.administration_west.Models.Products;
import com.example.administration_west.R;
import com.example.administration_west.Utils.CategoriesJsonParse;
import com.example.administration_west.Utils.ProductsJsonParse;
//import com.example.administration_west.slington.ProductsModel;
import com.google.gson.Gson;
import com.google.gson.GsonBuilder;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

import static java.security.AccessController.getContext;

public class ProductActivity extends AppCompatActivity {

    /*private RecyclerView recyclerViewCategories, recyclerViewProducts;
    private CategoriesAdapter adaptadorCategories;
    private ProductsAdapter adaptadorProducts;
    private ProductsModel modelproduct;*/

    private RecyclerView recyclerViewCategories;
    private CategoriesAdapter adapterCategories;
    private ArrayList<Categories> categoriesList;
    private RequestQueue requestQueue;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_product);

        recyclerViewCategories= findViewById(R.id.RecicleViewCategories);
        recyclerViewCategories.setHasFixedSize(true);
        recyclerViewCategories.setLayoutManager(new LinearLayoutManager(this, LinearLayoutManager.HORIZONTAL,false));

        categoriesList = new ArrayList<>();

        requestQueue = Volley.newRequestQueue(this);
        parseJSON(getApplicationContext());
    }

    private void parseJSON(final Context context){
        String url= "http://192.168.1.109/administration_west/web_codeigniter/restful/categories";
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
}


//Categories
     /*   ArrayList<Categories> categories = new ArrayList<>();
        categories.add(new Categories(R.drawable.ic_launcher_background, "Categoria 1"));


        recyclerViewCategories = (RecyclerView) view.findViewById(R.id.RecicleViewCategories);
        adaptadorCategories = new CategoriesAdapter(categories);
        recyclerViewCategories.setLayoutManager(new LinearLayoutManager(getContext(), LinearLayoutManager.HORIZONTAL, false));
        recyclerViewCategories.setAdapter(adaptadorCategories);
*/

//Products
//ArrayList<Products> products = new ArrayList<>();
//products.add(new Products(R.drawable.ic_launcher_background, "Produto 1", R.drawable.ic_launcher_foreground, 10.00));


       /* modelproduct = ProductsModel.getInstance(getApplicationContext());
        modelproduct.setProductsListenner(this);
        modelproduct.getAllProducts(getApplicationContext(), ProductsJsonParse.isConnectionInternet(getApplicationContext()));

        this.recyclerViewProducts = findViewById(R.id.RecicleViewProduct);
       // this.adaptadorProducts = new ProductsAdapter(ProductsModel.getInstance(getApplicationContext()).getRecycleViewProducts());
        this.recyclerViewProducts.setAdapter(adaptadorProducts);
        this.recyclerViewProducts.setLayoutManager(new LinearLayoutManager(getApplicationContext(), LinearLayoutManager.VERTICAL, false));
    }

    @Override
    public void onRefreshListProducts(ArrayList<Products> listProducts) {

    }
}

/*
package com.example.administration_west.Pages;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.os.Bundle;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;
import com.example.administration_west.Adapters.CategoriesAdapter;
import com.example.administration_west.Adapters.ProductsAdapter;
import com.example.administration_west.Models.Categories;
import com.example.administration_west.Models.Products;
import com.example.administration_west.R;
import com.google.gson.JsonArray;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class ProductActivity extends AppCompatActivity {

    private RecyclerView recyclerViewCategories, recyclerViewProducts;
    private CategoriesAdapter adaptadorCategories;
    private ProductsAdapter adaptadorProducts;
    private RequestQueue mQueue;
    private final static String url="http://127.0.0.1/administration_west/web_codeigniter/restful/products";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_product);

//Categories
        ArrayList<Categories> categories = new ArrayList<>();
        categories.add(new Categories(R.drawable.ic_launcher_background, "Categoria 1"));
        categories.add(new Categories(R.drawable.ic_launcher_background, "Categoria 2"));
        categories.add(new Categories(R.drawable.ic_launcher_background, "Categoria 3"));
        categories.add(new Categories(R.drawable.ic_launcher_background, "Categoria 4"));
        categories.add(new Categories(R.drawable.ic_launcher_background, "Categoria 5"));
        categories.add(new Categories(R.drawable.ic_launcher_background, "Categoria 6"));
        categories.add(new Categories(R.drawable.ic_launcher_background, "Categoria 7"));
        categories.add(new Categories(R.drawable.ic_launcher_background, "Categoria 8"));
        categories.add(new Categories(R.drawable.ic_launcher_background, "Categoria 9"));
        categories.add(new Categories(R.drawable.ic_launcher_background, "Categoria 10"));
        categories.add(new Categories(R.drawable.ic_launcher_background, "Categoria 11"));

        recyclerViewCategories = findViewById(R.id.RecicleViewCategories);
        adaptadorCategories = new CategoriesAdapter(categories);
        recyclerViewCategories.setLayoutManager(new LinearLayoutManager(this, LinearLayoutManager.HORIZONTAL,false));
        recyclerViewCategories.setAdapter(adaptadorCategories);


//Products
        mQueue = Volley.newRequestQueue(this);
        getProducts();

        ArrayList<Products> products = new ArrayList<>();
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 1", R.drawable.ic_launcher_foreground, 10.00));
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 2", R.drawable.ic_launcher_foreground, 10.00));
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 3", R.drawable.ic_launcher_foreground, 10.00));
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 4", R.drawable.ic_launcher_foreground, 10.00));
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 5", R.drawable.ic_launcher_foreground, 10.00));
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 6", R.drawable.ic_launcher_foreground, 10.00));
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 7", R.drawable.ic_launcher_foreground, 10.00));
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 8", R.drawable.ic_launcher_foreground, 10.00));
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 9", R.drawable.ic_launcher_foreground, 10.00));
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 10", R.drawable.ic_launcher_foreground, 10.00));
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 11", R.drawable.ic_launcher_foreground, 10.00));
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 12", R.drawable.ic_launcher_foreground, 10.00));

        recyclerViewProducts = findViewById(R.id.RecicleViewProduct);
        adaptadorProducts = new ProductsAdapter(products);
        recyclerViewProducts.setLayoutManager(new LinearLayoutManager(this, LinearLayoutManager.VERTICAL,false));
        recyclerViewProducts.setAdapter(adaptadorProducts);
    }

    private void getProducts(){

        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, url, null, new Response.Listener<JSONObject>() {
            @Override
            public void onResponse(JSONObject response) {
                try {
                    JSONArray jsonArray =  response.getJSONArray("products");
                    for(int i = 0; i < jsonArray.length();i++){
                        JSONObject product = jsonArray.getJSONObject(i);

                        Toast.makeText(ProductActivity.this, product.getString("product_name"), Toast.LENGTH_SHORT).show();
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                error.printStackTrace();
            }
        });
    }
}

*/