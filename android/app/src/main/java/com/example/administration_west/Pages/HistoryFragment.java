package com.example.administration_west.Pages;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import com.android.volley.RequestQueue;
import com.android.volley.toolbox.Volley;
import com.example.administration_west.Adapters.HistoryAdapter;
import com.example.administration_west.Models.Companies;
import com.example.administration_west.Models.History;
import com.example.administration_west.R;

import java.util.ArrayList;

import static com.example.administration_west.Pages.ProductFragment.ip;


public class HistoryFragment extends Fragment implements HistoryAdapter.OnItemClickListener {

    private RecyclerView recyclerViewHistory;
    private HistoryAdapter adapterHistory;
    private ArrayList<History> historylist;
    private RequestQueue requestQueue;

    public HistoryFragment(){

    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_historico_compra, container, false);

        final SwipeRefreshLayout refreshLayout;

        refreshLayout = (SwipeRefreshLayout) view.findViewById(R.id.swiperefreshMainHistorico);


        recyclerViewHistory = view.findViewById(R.id.RecicleViewHistorico);
        recyclerViewHistory.setLayoutManager(new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL, false));

        historylist = new ArrayList<>();

        requestQueue = Volley.newRequestQueue(getContext());
        parseJSONHistory(getContext());



        refreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                refreshLayout.setRefreshing(true);
                parseJSONHistory(getContext());
                adapterHistory.notifyDataSetChanged();
                refreshLayout.setRefreshing(false);
            }
        });



        return view;
    }

    private void parseJSONHistory(Context context) {
    }

    @Override
    public void onItemClick(int position) {
        Intent detail = new Intent (getContext(), DetailsCompaniesActivity.class);
        History clicked = historylist.get(position);

//        detail.putExtra(EXTRA_COMPANY_NAME, clicked.getCompany_name());

        startActivity(detail);

    }
}
