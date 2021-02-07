package com.example.administration_west.Pages;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.administration_west.Adapters.CartAdapter;
import com.example.administration_west.Adapters.CategoriesAdapter;
import com.example.administration_west.Adapters.HistoryAdapter;
import com.example.administration_west.Models.Cart;
import com.example.administration_west.Models.Companies;
import com.example.administration_west.Models.History;
import com.example.administration_west.Models.SessionUser;
import com.example.administration_west.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

import static com.example.administration_west.Pages.ProductFragment.ip;


public class HistoryFragment extends Fragment implements HistoryAdapter.OnItemClickListener {

    public static final String EXTRA_HISTORY_ID = "history_id";
    public static final String EXTRA_HISTORY_DATA = "history_data";
    public static final String EXTRA_HISTORY_ESTADO = "history_estado";
    public static final String EXTRA_HISTORY_TOTAL = "history_total";
    public static final String EXTRA_HISTORY_TOTAL_IVA = "history_total_iva";



    String URL_HISTORY = ip + "restful/show_user_purchases/";

    SessionUser sessionUser;
    String getKey;

    private RecyclerView recyclerViewHistory;
    private HistoryAdapter adapterHistory;
    private ArrayList<History> historylist;

    public HistoryFragment(){

    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_historico_compra, container, false);

        sessionUser= new SessionUser(getContext());
        sessionUser.checkLogin();


        HashMap<String, String> user = sessionUser.getUserDetail();
        getKey= user.get(sessionUser.UNIQUE_KEY);

        final SwipeRefreshLayout refreshLayout;

        refreshLayout = (SwipeRefreshLayout) view.findViewById(R.id.swiperefreshMainHistorico);


        recyclerViewHistory = view.findViewById(R.id.RecicleViewHistorico);
        recyclerViewHistory.setHasFixedSize(true);
        recyclerViewHistory.setLayoutManager(new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL, false));
        historylist = new ArrayList<>();



        parseJSONHistory();



        refreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                refreshLayout.setRefreshing(true);
                parseJSONHistory();
                adapterHistory.notifyDataSetChanged();
                refreshLayout.setRefreshing(false);
            }
        });



        return view;
    }

    private void parseJSONHistory() {
            StringRequest stringRequest = new StringRequest(Request.Method.POST, URL_HISTORY,
                    new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            ArrayList<History> lista= new ArrayList<History>();

                            try {
                                JSONObject jsonObject = new JSONObject(response);
                                String status = jsonObject.getString("status");
                                JSONArray jsonArray = jsonObject.getJSONArray("sales");

                                if( status.equals("200") ){

                                    for (int i = 0; i < jsonArray.length(); i++) {

                                        JSONObject obj = jsonArray.getJSONObject(i);
                                        History products = new History(
                                                obj.getInt("id"),
                                                obj.getDouble("total_price"),
                                                obj.getDouble("total_iva"),
                                                obj.getString("created_date"),
                                                obj.getString("status")
                                        );
                                        lista.add(products);
                                    }
                                    historylist=lista;
                                    adapterHistory=new HistoryAdapter(getContext(), historylist);
                                    recyclerViewHistory.setAdapter(adapterHistory);
                                    adapterHistory.setOnItemClickListener(HistoryFragment.this);

                                }else{
                                    Toast.makeText(getContext(), "Não tem produtos no carrinho!", Toast.LENGTH_LONG).show();
                                }
                            } catch (JSONException e){
                                e.printStackTrace();
                                 Toast.makeText(getContext(), "Erro " +e.toString(),Toast.LENGTH_LONG).show();
                            }

                        }
                    },
                    new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            Toast.makeText(getContext(), "Erro " +error.toString(),Toast.LENGTH_LONG).show();


                        }
                    }) {
                @Override
                protected Map<String, String> getParams() throws AuthFailureError {
                    Map<String, String> params = new HashMap<>();
                    params.put("profile_key", getKey);
                    return params;
                }
            };

            RequestQueue requestQueue= Volley.newRequestQueue(getContext());
            requestQueue.add(stringRequest);
        }


    @Override
    public void onItemClick(int position) {
        Intent detail = new Intent (getContext(), DetailsHistoryActivity.class);
        History clicked = historylist.get(position);

        detail.putExtra(EXTRA_HISTORY_ID, String.valueOf(clicked.getId()));
        detail.putExtra(EXTRA_HISTORY_DATA,  clicked.getCreated_date());
        detail.putExtra(EXTRA_HISTORY_ESTADO, clicked.getStatus());
        detail.putExtra(EXTRA_HISTORY_TOTAL,  String.valueOf(clicked.getTotal_price()));
        detail.putExtra(EXTRA_HISTORY_TOTAL_IVA,  String.valueOf(clicked.getTotal_iva()));
        startActivity(detail);

    }
}
