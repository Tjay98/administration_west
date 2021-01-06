package com.example.administration_west.Pages;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;
import com.example.administration_west.Adapters.CompaniesAdapter;
import com.example.administration_west.Models.Companies;
import com.example.administration_west.R;
import com.example.administration_west.Utils.CompaniesJsonParse;

import org.json.JSONArray;

import java.util.ArrayList;

import static com.example.administration_west.Pages.ProductActivity.ip;

public class CompaniesActivity extends AppCompatActivity implements CompaniesAdapter.OnItemClickListener {

    public static final String EXTRA_IMAGE = "image";
    public static final String EXTRA_COMPANY_NAME = "name";
    public static final String EXTRA_DESCRIPTION = "description";


    private RecyclerView recyclerViewCompanies;
    private CompaniesAdapter adapterCompanies;
    private ArrayList<Companies> companiesList;
    private RequestQueue requestQueue;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_companies);

        final SwipeRefreshLayout refreshLayout;

        refreshLayout = (SwipeRefreshLayout) findViewById(R.id.swiperefreshMainProduct);



        recyclerViewCompanies = findViewById(R.id.RecicleViewCompanies);
        recyclerViewCompanies.setLayoutManager(new LinearLayoutManager(this, LinearLayoutManager.VERTICAL, false));

        companiesList = new ArrayList<>();

        requestQueue = Volley.newRequestQueue(this);
        parseJSONCompanies(getApplicationContext());

    }

    private void parseJSONCompanies(final Context context) {
        String url = ip + "restful/companies";
        JsonArrayRequest request = new JsonArrayRequest(
                Request.Method.GET,
                url,
                null,
                new Response.Listener<JSONArray>() {
                    @Override
                    public void onResponse(JSONArray response) {
                        companiesList = CompaniesJsonParse.parseJsonCompanies(response, context);
                        adapterCompanies = new CompaniesAdapter(CompaniesActivity.this, companiesList);
                        recyclerViewCompanies.setAdapter(adapterCompanies);
                        adapterCompanies.setOnItemClickListener(CompaniesActivity.this);
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
        Intent detail = new Intent (this, DetailsCompaniesActivity.class);
        Companies clicked = companiesList.get(position);

        detail.putExtra(EXTRA_IMAGE, ip + "uploads/companies/" + clicked.getImage());
        detail.putExtra(EXTRA_COMPANY_NAME, clicked.getCompany_name());
        detail.putExtra(EXTRA_DESCRIPTION, clicked.getDescription());

        startActivity(detail);

    }
}
