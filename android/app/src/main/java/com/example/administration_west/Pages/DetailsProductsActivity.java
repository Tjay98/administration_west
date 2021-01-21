package com.example.administration_west.Pages;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.administration_west.Models.SessionUser;
import com.example.administration_west.R;
import com.squareup.picasso.Picasso;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

import static com.example.administration_west.Pages.ProductFragment.EXTRA_PRODUCT_CATEGORY;
import static com.example.administration_west.Pages.ProductFragment.EXTRA_PRODUCT_COMPANY;
import static com.example.administration_west.Pages.ProductFragment.EXTRA_PRODUCT_DESCRIPTION;
import static com.example.administration_west.Pages.ProductFragment.EXTRA_PRODUCT_ID;
import static com.example.administration_west.Pages.ProductFragment.EXTRA_PRODUCT_IMAGE;
import static com.example.administration_west.Pages.ProductFragment.EXTRA_PRODUCT_NAME;
import static com.example.administration_west.Pages.ProductFragment.EXTRA_PRODUCT_PRICE;
import static com.example.administration_west.Pages.ProductFragment.ip;

public class DetailsProductsActivity extends AppCompatActivity {

    SessionUser sessionUser;
    String getKey;

    String ADD_TO_CART_URL = ip + "restful/add_product_cart";
    String product_id;




    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_details_products);

        sessionUser= new SessionUser(getApplicationContext());
        sessionUser.checkLogin();

        Intent intent = getIntent();
        product_id =  intent.getExtras().getString(EXTRA_PRODUCT_ID);
        String product_image = intent.getExtras().getString(EXTRA_PRODUCT_IMAGE);
        String product_name = intent.getExtras().getString(EXTRA_PRODUCT_NAME);
        String product_category_name = intent.getExtras().getString(EXTRA_PRODUCT_CATEGORY);
        String product_company_name = intent.getExtras().getString(EXTRA_PRODUCT_COMPANY);
        String product_price = intent.getExtras().getString(EXTRA_PRODUCT_PRICE);
        String product_description = intent.getExtras().getString(EXTRA_PRODUCT_DESCRIPTION);


        ImageView image = findViewById(R.id.iVDetailProduct);
        TextView name = findViewById(R.id.tVNomeProdutoDP);
        TextView category_name = findViewById(R.id.tVCategoriaProdutoDP);
        TextView product_company_name1 = findViewById(R.id.tVEmpresaProdutoDP);
        TextView product_price1 = findViewById(R.id.tVPriceProdutoDP);
        TextView product_description2 = findViewById(R.id.tVDescricaoProdutoDP);
        ImageButton addToCart = findViewById(R.id.BAdicionarDP);

        Picasso.with(this).load(product_image)
                .placeholder(R.drawable.sem_imagem)
                .error(R.drawable.sem_imagem)
                .fit()
                .centerInside()
                .into(image);

        name.setText(product_name);
        category_name.setText(product_category_name);
        product_company_name1.setText(product_company_name);
        product_description2.setText(product_description);
        product_price1.setText(product_price + " €");


        addToCart.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                addToCart();
                mainactivity();
            }
        });

    }

    private void addToCart() {
        Intent intent = getIntent();


        EditText _quantity = findViewById(R.id.editQuantCart);

        HashMap<String, String> user = sessionUser.getUserDetail();
        getKey= user.get(sessionUser.UNIQUE_KEY);

        String quantity = _quantity.getText().toString();
        int mQuantity=Integer.parseInt(quantity);


        StringRequest stringRequest = new StringRequest(Request.Method.POST, ADD_TO_CART_URL,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            //converting response to json object
                            JSONObject jsonObject = new JSONObject(response);

                            String status = jsonObject.getString("status");

                            if (status.equals("200")) {
                                Toast.makeText(DetailsProductsActivity.this, "Produto adicionado ao carrinho com sucesso!", Toast.LENGTH_LONG).show();


                            }else{
                                Toast.makeText(DetailsProductsActivity.this, status, Toast.LENGTH_LONG).show();
                            }


                        } catch (JSONException e) {
                            e.printStackTrace();
                            Toast.makeText(DetailsProductsActivity.this, "Erro no registo! " + e.toString(), Toast.LENGTH_LONG).show();

                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(DetailsProductsActivity.this, "Erro no registo! " + error.toString(), Toast.LENGTH_LONG).show();
                    }
                }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("profile_key", getKey);
                params.put("product", product_id);
                params.put("quantity", String.valueOf(mQuantity));

                return params;
            }
        };

        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);

    }

    private void mainactivity() {
        Intent intentMain = new Intent(this, MainActivity.class);
        startActivity(intentMain);
        finish();
    }


}

