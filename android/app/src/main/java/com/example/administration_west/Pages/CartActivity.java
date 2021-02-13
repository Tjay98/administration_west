package com.example.administration_west.Pages;

import android.content.Context;
import android.content.Intent;
import android.database.Cursor;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.administration_west.Adapters.CartAdapter;
import com.example.administration_west.Adapters.ProductsAdapter;
import com.example.administration_west.Models.Cart;
import com.example.administration_west.Models.Products;
import com.example.administration_west.Models.SessionUser;
import com.example.administration_west.R;
import com.example.administration_west.Utils.ProductsJsonParse;
import com.squareup.picasso.Picasso;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.DecimalFormat;
import java.text.NumberFormat;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

import static com.example.administration_west.Pages.ProductFragment.EXTRA_PRODUCT_PRICE;
import static com.example.administration_west.Pages.ProductFragment.ip;

public class CartActivity extends AppCompatActivity implements CartAdapter.OnItemClickListener  {

    String URL_CART = ip + "restful/view_cart/";

    String URL_DELETE_CART = ip + "restful/delete_product_cart/";

    CartAdapter cartAdapter;
    RecyclerView mRecyclerView;
    Double totalPrice;
    SessionUser sessionUser;

    ArrayList<Cart> cartList;

    TextView Total;

    String getKey;
    int getProductID;

    NumberFormat formatter = new DecimalFormat("#0.00");


    public static final Double EXTRA_TOTAL_PRECO = 0.0;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cart);


        sessionUser= new SessionUser(getApplicationContext());
        sessionUser.checkLogin();


        HashMap<String, String> user = sessionUser.getUserDetail();
        getKey= user.get(sessionUser.UNIQUE_KEY);

        Total =findViewById(R.id.PrecoTotalCart);




        Button Compra = findViewById(R.id.buttonContinuarComprar);
        Button Pagamento = findViewById(R.id.buttonFinalizarCompras);

        mRecyclerView= findViewById(R.id.RecycleViewCart);
        mRecyclerView.setHasFixedSize(true);
        mRecyclerView.setLayoutManager(new LinearLayoutManager(getApplicationContext(), LinearLayoutManager.VERTICAL,false));
        cartList = new ArrayList<>();

        cartAdapter=new CartAdapter(getApplicationContext(), cartList);
        mRecyclerView.setAdapter(cartAdapter);


        getCartDetail();




        Compra.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                mostrarMainAcivity();
            }
        });

        Pagamento.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(cartList.isEmpty()){
                    getCartDetail();
                }else{
                    mostrarMorada();
                }
            }
        });
    }

    private void mostrarMainAcivity() {
        Intent intentMain = new Intent(this, MainActivity.class);
        startActivity(intentMain);
        finish();
    }

    private void mostrarMorada() {
        Intent intentMorada = new Intent(this, ShippingAddressActivity.class);
        startActivity(intentMorada);
        finish();
    }

    private void getCartDetail(){
        StringRequest stringRequest = new StringRequest(Request.Method.POST, URL_CART,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        ArrayList<Cart> lista= new ArrayList<Cart>();

                        try {
                            JSONObject jsonObject = new JSONObject(response);
                            String status = jsonObject.getString("status");
                            JSONArray jsonArray = jsonObject.getJSONArray("cart");

                            if( status.equals("200") ){
                                totalPrice=0.00;
                                    for (int i = 0; i < jsonArray.length(); i++) {

                                        JSONObject obj = jsonArray.getJSONObject(i);
                                        double final_price = 0.0;
                                        final_price = obj.getDouble("price") * obj.getInt("quantity");
                                        totalPrice += final_price;
                                        Cart products = new Cart(
                                                obj.getInt("product_id"),
                                                obj.getString("product_name"),
                                                obj.getString("image"),
                                                final_price,
                                                obj.getInt("quantity")
                                        );
                                        lista.add(products);
                                }
                                Total.setText(formatter.format(totalPrice) + " €");

                                cartAdapter.addItems(lista);
                                mRecyclerView.setAdapter(cartAdapter);
                                cartAdapter.setOnItemClickListener(CartActivity.this);

                            }else{
                                Toast.makeText(CartActivity.this, "Não tem produtos no carrinho!", Toast.LENGTH_LONG).show();
                            }
                        } catch (JSONException e){
                            e.printStackTrace();
                           // Toast.makeText(getApplicationContext(), "Erro " +e.toString(),Toast.LENGTH_LONG).show();
                        }

                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getApplicationContext(), "Erro " +error.toString(),Toast.LENGTH_LONG).show();


                    }
                }) {
            @Override
            protected Map<String, String>getParams() throws AuthFailureError{
                Map<String, String> params = new HashMap<>();
                params.put("profile_key", getKey);
                return params;
            }
        };

        RequestQueue requestQueue= Volley.newRequestQueue(getApplicationContext());
        requestQueue.add(stringRequest);
    }




    @Override
    public void onItemClick(int position) {
        Cart clicked = cartList.get(position);

        getProductID=clicked.getId();

        StringRequest stringRequest = new StringRequest(Request.Method.POST, URL_DELETE_CART,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            //converting response to json object
                            JSONObject jsonObject = new JSONObject(response);

                            String status = jsonObject.getString("status");

                            if (status.equals("200")) {
                                Toast.makeText(CartActivity.this, "Produto eliminado com sucesso!", Toast.LENGTH_LONG).show();


                            }else{
                                Toast.makeText(CartActivity.this, status, Toast.LENGTH_LONG).show();
                            }


                        } catch (JSONException e) {
                            e.printStackTrace();
                            Toast.makeText(CartActivity.this, "Erro! " + e.toString(), Toast.LENGTH_LONG).show();

                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(CartActivity.this, "Erro! " + error.toString(), Toast.LENGTH_LONG).show();
                    }
                }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("profile_key", getKey);
                params.put("product", String.valueOf(getProductID));


                return params;
            }
        };

        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);

       // cartList.remove(position);
        cartAdapter.clear();
        mostrarMainAcivity();
        //getCartDetail();


    }
}





