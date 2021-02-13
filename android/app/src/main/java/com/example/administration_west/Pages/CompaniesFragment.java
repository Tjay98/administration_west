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

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;
import com.example.administration_west.Adapters.CategoriesAdapter;
import com.example.administration_west.Adapters.CompaniesAdapter;
import com.example.administration_west.Models.Categories;
import com.example.administration_west.Models.CategoriesDBHelper;
import com.example.administration_west.Models.Companies;
import com.example.administration_west.Models.CompaniesDBHelper;
import com.example.administration_west.R;
import com.example.administration_west.Utils.CategoriesJsonParse;
import com.example.administration_west.Utils.CompaniesJsonParse;

import org.json.JSONArray;

import java.util.ArrayList;

import static com.example.administration_west.Pages.ProductFragment.ip;

public class CompaniesFragment extends Fragment implements CompaniesAdapter.OnItemClickListener {

    public static final String EXTRA_IMAGE = "image";
    public static final String EXTRA_COMPANY_NAME = "name";
    public static final String EXTRA_DESCRIPTION = "description";


    private RecyclerView recyclerViewCompanies;
    private CompaniesAdapter adapterCompanies;
    private ArrayList<Companies> companiesList;
    private RequestQueue requestQueue;


    public CompaniesFragment(){

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
            View view = inflater.inflate(R.layout.fragment_companies, container, false);

            final SwipeRefreshLayout refreshLayoutCompanies;

            refreshLayoutCompanies = (SwipeRefreshLayout) view.findViewById(R.id.swiperefreshMainCompanies);


            recyclerViewCompanies = view.findViewById(R.id.RecicleViewCompanies);
            recyclerViewCompanies.setLayoutManager(new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL, false));

            companiesList = new ArrayList<>();

            requestQueue = Volley.newRequestQueue(getContext());
            parseJSONCompanies(getContext(), CompaniesJsonParse.isConnected(getContext()));



            refreshLayoutCompanies.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
                @Override
                public void onRefresh() {
                    refreshLayoutCompanies.setRefreshing(true);
                    parseJSONCompanies(getContext(), CompaniesJsonParse.isConnected(getContext()));
                    adapterCompanies.notifyDataSetChanged();
                    refreshLayoutCompanies.setRefreshing(false);
                }
            });

         /*   refreshLayoutCompanies.post(new Runnable() {
                @Override
                public void run() {
                }
            });*/

        return view;
    }



    private void parseJSONCompanies(final Context context, final boolean isConnected) {
        if (!isConnected) {
            Toast.makeText(context, "Não tem ligação à internet", Toast.LENGTH_SHORT).show();

            CompaniesDBHelper Pbd = new CompaniesDBHelper(getContext());
            companiesList = Pbd.getAllCompanies();

            adapterCompanies = new CompaniesAdapter(getContext(), companiesList);
            recyclerViewCompanies.setAdapter(adapterCompanies);
            adapterCompanies.setOnItemClickListener(CompaniesFragment.this);

        } else {
            String url = ip + "restful/companies";
            JsonArrayRequest request = new JsonArrayRequest(
                    Request.Method.GET,
                    url,
                    null,
                    new Response.Listener<JSONArray>() {
                        @Override
                        public void onResponse(JSONArray response) {
                            companiesList = CompaniesJsonParse.parseJsonCompanies(response, context);
                            adapterCompanies = new CompaniesAdapter(getContext(), companiesList);
                            recyclerViewCompanies.setAdapter(adapterCompanies);
                            adapterCompanies.setOnItemClickListener(CompaniesFragment.this);

                            adicionarCompaniesDB(companiesList);

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

    public void adicionarCompaniesDB(ArrayList<Companies> lista){
        CompaniesDBHelper Pbd = new CompaniesDBHelper(getContext());
        Pbd.removerAllCompaniesDB();
        for(Companies companies: lista){
            Pbd.addCompaniesdb(companies);
        }
         Pbd.close();

    }

    @Override
    public void onItemClick(int position) {
        Intent detail = new Intent (getContext(), DetailsCompaniesActivity.class);
        Companies clicked = companiesList.get(position);

        detail.putExtra(EXTRA_IMAGE, ip + "uploads/companies/" + clicked.getImage());
        detail.putExtra(EXTRA_COMPANY_NAME, clicked.getCompany_name());
        detail.putExtra(EXTRA_DESCRIPTION, clicked.getDescription());

        startActivity(detail);

    }
}
