package com.example.administration_west.Pages;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Intent;
import android.os.Bundle;
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
import com.example.administration_west.Adapters.DetailsHistoryAdapter;
import com.example.administration_west.Adapters.HistoryAdapter;
import com.example.administration_west.Models.DetailsHistory;
import com.example.administration_west.Models.History;
import com.example.administration_west.Models.SessionUser;
import com.example.administration_west.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.HashMap;
import java.util.Map;

import static com.example.administration_west.Pages.HistoryFragment.EXTRA_HISTORY_DATA;
import static com.example.administration_west.Pages.HistoryFragment.EXTRA_HISTORY_ESTADO;
import static com.example.administration_west.Pages.HistoryFragment.EXTRA_HISTORY_ID;
import static com.example.administration_west.Pages.HistoryFragment.EXTRA_HISTORY_TOTAL;
import static com.example.administration_west.Pages.HistoryFragment.EXTRA_HISTORY_TOTAL_IVA;
import static com.example.administration_west.Pages.ProductFragment.EXTRA_PRODUCT_CATEGORY;
import static com.example.administration_west.Pages.ProductFragment.EXTRA_PRODUCT_COMPANY;
import static com.example.administration_west.Pages.ProductFragment.EXTRA_PRODUCT_DESCRIPTION;
import static com.example.administration_west.Pages.ProductFragment.EXTRA_PRODUCT_ID;
import static com.example.administration_west.Pages.ProductFragment.EXTRA_PRODUCT_IMAGE;
import static com.example.administration_west.Pages.ProductFragment.EXTRA_PRODUCT_NAME;
import static com.example.administration_west.Pages.ProductFragment.EXTRA_PRODUCT_PRICE;
import static com.example.administration_west.Pages.ProductFragment.ip;

public class DetailsHistoryActivity extends AppCompatActivity {


    SessionUser sessionUser;
    String getKey;

    int id_history;

    int id_product, quant_product;
    String name_product;
    double price_product, price_iva_product;

    String URL_HISTORY = ip + "restful/show_user_purchases/";

    private RecyclerView recyclerViewDetailHistory;
    private DetailsHistoryAdapter adapterDetailHistory;
    private ArrayList<DetailsHistory> historyList;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_details_history);

        sessionUser= new SessionUser(getApplicationContext());
        sessionUser.checkLogin();

        HashMap<String, String> user = sessionUser.getUserDetail();
        getKey= user.get(sessionUser.UNIQUE_KEY);

        Intent intent = getIntent();
        String history_id =  intent.getExtras().getString(EXTRA_HISTORY_ID);
        String history_data = intent.getExtras().getString(EXTRA_HISTORY_DATA);
        String history_estado = intent.getExtras().getString(EXTRA_HISTORY_ESTADO);
        String history_total = intent.getExtras().getString(EXTRA_HISTORY_TOTAL);
        String history_total_iva = intent.getExtras().getString(EXTRA_HISTORY_TOTAL_IVA);

        id_history=Integer.valueOf(history_id);

        TextView id = findViewById(R.id.tVIdDetailsHistory);
        TextView data = findViewById(R.id.tVDataDetailsHistory);
        TextView estado = findViewById(R.id.tVEstadoDetailsHistory);
        TextView total = findViewById(R.id.tVTotalPriceDetailsHistory);
        TextView total_iva = findViewById(R.id.tVTotalIvaDetailsHistory);


        DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
        try {
            String inputText = history_data;
            Date dateTime = dateFormat.parse(inputText);
            String outputText = dateFormat.format(dateTime);
            data.setText(outputText);
        } catch (ParseException e) {
            e.printStackTrace();
        }

        if(history_estado.equals("0")){
            estado.setText("Processamento");
        } else if(history_estado.equals("1")){
            estado.setText("Processado");
        } else if(history_estado.equals("2")){
            estado.setText("Enviado");
        } else{
            estado.setText("Cancelado");
        }


        id.setText("Detalhes da compra #" + history_id);
       // data.setText(history_data);
       // estado.setText(history_estado);
        total.setText(history_total + " €");
        total_iva.setText(history_total_iva + " €");

        recyclerViewDetailHistory = findViewById(R.id.RecycleViewDetailHistory);
        recyclerViewDetailHistory.setHasFixedSize(true);
        recyclerViewDetailHistory.setLayoutManager(new LinearLayoutManager(getApplicationContext(), LinearLayoutManager.VERTICAL, false));
        historyList = new ArrayList<>();


        parseJSONDetailHistory();

    }

    private void parseJSONDetailHistory() {
        StringRequest stringRequest = new StringRequest(Request.Method.POST, URL_HISTORY,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        ArrayList<DetailsHistory> lista= new ArrayList<DetailsHistory>();

                        try {
                            JSONObject jsonObject = new JSONObject(response);
                            String status = jsonObject.getString("status");
                            JSONArray jsonArray = jsonObject.getJSONArray("sales");
                            if( status.equals("200") ){
                                for (int i = 0; i < jsonArray.length(); i++) {
                                    JSONObject obj = jsonArray.getJSONObject(i);
                                    int id_historico = obj.getInt("id");
                                    if(id_historico == id_history) {
                                        JSONArray array = obj.getJSONArray("sale_products");

                                        for (int a = 0; a < array.length(); a++) {
                                            JSONObject object = array.getJSONObject(a);
                                            //DetailsHistory products = new DetailsHistory(
                                                    id_product=object.getInt("id");
                                                    name_product=object.getString("product_name");
                                                    price_product=object.getDouble("price");
                                                    price_iva_product= object.getDouble("price_iva");
                                                    quant_product=object.getInt("quantity");
                                           // );

                                        }
                                        DetailsHistory products = new DetailsHistory(id_product, name_product, price_product, price_iva_product, quant_product);
                                        lista.add(products);

                                    }
                                }
                                historyList = lista;
                                adapterDetailHistory = new DetailsHistoryAdapter(getApplicationContext(), historyList);
                                recyclerViewDetailHistory.setAdapter(adapterDetailHistory);
                            }else{
                                Toast.makeText(getApplicationContext(), "Não tem produtos no carrinho!", Toast.LENGTH_LONG).show();
                            }
                        } catch (JSONException e){
                            e.printStackTrace();
                            Toast.makeText(getApplicationContext(), "Erro " +e.toString(),Toast.LENGTH_LONG).show();
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
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("profile_key", getKey);
                return params;
            }
        };

        RequestQueue requestQueue= Volley.newRequestQueue(getApplicationContext());
        requestQueue.add(stringRequest);
    }


}