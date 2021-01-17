package com.example.administration_west.Pages;

import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import android.content.Context;
import android.content.Intent;
import android.database.sqlite.SQLiteDatabase;
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
import com.android.volley.toolbox.Volley;
import com.example.administration_west.Adapters.CategoriesAdapter;
import com.example.administration_west.Adapters.ProductsAdapter;
import com.example.administration_west.Models.Categories;
import com.example.administration_west.Models.Products;
import com.example.administration_west.Models.ProductsDBHelper;
import com.example.administration_west.R;
import com.example.administration_west.Utils.CategoriesJsonParse;
import com.example.administration_west.Utils.ProductsJsonParse;
//import com.example.administration_west.slington.ProductsModel;

import org.json.JSONArray;

import java.util.ArrayList;

public class ProductFragment extends Fragment implements ProductsAdapter.OnItemClickListener, CategoriesAdapter.OnItemClickListener {

    public static final String EXTRA_PRODUCT_ID = "product_id";
    public static final String EXTRA_PRODUCT_IMAGE = "product_image";
    public static final String EXTRA_PRODUCT_NAME = "product_name";
    public static final String EXTRA_PRODUCT_CATEGORY = "product_category";
    public static final String EXTRA_PRODUCT_COMPANY = "product_company";
    public static final String EXTRA_PRODUCT_PRICE = "product_price";
    public static final String EXTRA_PRODUCT_DESCRIPTION = "product_description";



    private RecyclerView recyclerViewCategories;
    private RecyclerView recyclerViewProducts;
    private CategoriesAdapter adapterCategories;
    private ProductsAdapter adapterProducts;
    private ArrayList<Categories> categoriesList;
    private ArrayList<Products> productsList;
    private RequestQueue requestQueue;




    public static final String ip = "http://192.168.1.67/administration_west/web_codeigniter/";
//    public static final String ip = "http://192.168.1.109/administration_west/web_codeigniter/";


    public ProductFragment(){

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_product, container, false);


        final SwipeRefreshLayout refreshLayoutProducts;

        refreshLayoutProducts = (SwipeRefreshLayout) view.findViewById(R.id.swiperefreshMainProduct);



        //Categories
        recyclerViewCategories= view.findViewById(R.id.RecicleViewCategories);
        recyclerViewCategories.setHasFixedSize(true);
        recyclerViewCategories.setLayoutManager(new LinearLayoutManager(getContext(), LinearLayoutManager.HORIZONTAL,false));

        categoriesList = new ArrayList<>();

        requestQueue = Volley.newRequestQueue(getContext());
        parseJSONCategories(getContext());

        //Products
        recyclerViewProducts= view.findViewById(R.id.RecicleViewProduct);
        recyclerViewProducts.setHasFixedSize(true);
        recyclerViewProducts.setLayoutManager(new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL,false));

        productsList = new ArrayList<>();

        requestQueue = Volley.newRequestQueue(getContext());
        parseJSONProducts(getContext(),ProductsJsonParse.isConnected(getContext()));


        refreshLayoutProducts.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                refreshLayoutProducts.setRefreshing(true);
                parseJSONCategories(getContext());
                parseJSONProducts(getContext(), ProductsJsonParse.isConnected(getContext()));
                adapterCategories.notifyDataSetChanged();
                adapterProducts.notifyDataSetChanged();
                refreshLayoutProducts.setRefreshing(false);
            }
        });


        return view;
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
                        adapterCategories=new CategoriesAdapter(getContext(), categoriesList);
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
    private void parseJSONCategoriesProducts(final Context context, String category_id){

        String url= ip + "restful/products_category/"+category_id;
        JsonArrayRequest request=new JsonArrayRequest(
                Request.Method.GET,
                url,
                null,
                new Response.Listener<JSONArray>() {
                    @Override
                    public void onResponse(JSONArray response) {
                        productsList = ProductsJsonParse.parseJsonProducts(response, context);
                        adapterProducts=new ProductsAdapter(getContext(), productsList);
                        recyclerViewCategories.setAdapter(adapterProducts);
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                error.printStackTrace();
            }
        });
        requestQueue.add(request);
    }

    public void parseJSONProducts(final Context context, final boolean isConnected){
        if(!isConnected){
            Toast.makeText(context, "Não tem ligação à internet", Toast.LENGTH_SHORT).show();

            ProductsDBHelper Pbd = new ProductsDBHelper(getContext());
            productsList = Pbd.getAllProducts();

            adapterProducts = new ProductsAdapter(getContext(), productsList);
            recyclerViewProducts.setAdapter(adapterProducts);
            adapterProducts.setOnItemClickListener(ProductFragment.this);

        }else{

            String url= ip + "restful/products";
            JsonArrayRequest request=new JsonArrayRequest(
                    Request.Method.GET,
                    url,
                    null,
                    new Response.Listener<JSONArray>() {
                        @Override
                        public void onResponse(JSONArray response) {
                            productsList = ProductsJsonParse.parseJsonProducts(response, context);


                            adapterProducts = new ProductsAdapter(getContext(), productsList);
                            recyclerViewProducts.setAdapter(adapterProducts);
                            adapterProducts.setOnItemClickListener(ProductFragment.this);

                            adicionarProdutosDB(productsList);
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

    public void adicionarProdutosDB(ArrayList<Products> lista){
        ProductsDBHelper Pbd = new ProductsDBHelper(getContext());
        Pbd.removerAllProductsDB();
        for(Products products: lista){
            Pbd.addProductsdb(products);
        }
      //  db.close();

    }

    @Override
    public void onItemClick(int position) {
        Intent detail = new Intent (getContext(), DetailsProductsActivity.class);
        Products clicked = productsList.get(position);

        detail.putExtra(EXTRA_PRODUCT_ID, String.valueOf(clicked.getId()));
        detail.putExtra(EXTRA_PRODUCT_IMAGE, ip + "uploads/products/" + clicked.getImage());
        detail.putExtra(EXTRA_PRODUCT_NAME, clicked.getProduct_name());
        detail.putExtra(EXTRA_PRODUCT_CATEGORY, clicked.getCategory_name());
        detail.putExtra(EXTRA_PRODUCT_COMPANY, clicked.getCompany_name());
        detail.putExtra(EXTRA_PRODUCT_PRICE, String.valueOf(clicked.getPrice()));
        detail.putExtra(EXTRA_PRODUCT_DESCRIPTION, clicked.getBig_description());

        startActivity(detail);

    }

    @Override
    public void onCategoryClick(int position) {
        Categories clicked = categoriesList.get(position);

        Toast.makeText(getContext(), position, Toast.LENGTH_SHORT).show();
//
//        String id = String.valueOf(clicked.getId());
//        parseJSONCategoriesProducts(getContext(),id);

    }
}

