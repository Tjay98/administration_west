package com.example.administration_west;

import androidx.appcompat.app.AppCompatActivity;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import android.content.Intent;
import android.content.Context;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.GridView;

import com.example.administration_west.Adapters.GridViewAdapterProducts;
import com.example.administration_west.Controllers.SingletonProductManager;

import static com.google.android.material.internal.ContextUtils.getActivity;
import static java.security.AccessController.getContext;

public class MainActivity extends AppCompatActivity {

    private GridView gridProducts;
    private GridViewAdapterProducts adaptador;
    SwipeRefreshLayout refreshLayout;


    @Override
    protected void onCreate(Bundle savedInstanceState) {


        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);


        refreshLayout = (SwipeRefreshLayout) findViewById(R.id.swiperefreshMain);


        //SingletonProductManager gestor = SingletonProductManager.getInstance(getContext());



        gridProducts.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

            }
        });

        gridProducts = findViewById(R.id.gridProductMain);

        //adaptador = new GridViewAdapterProducts(getContext(), SingletonProductManager.getInstance(getContext().getProductlist()));

        gridProducts.setAdapter(adaptador);


         refreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
        @Override
        public void onRefresh() {

        adaptador.notifyDataSetChanged();
        refreshLayout.setRefreshing(false);
    }
    });
   /* refreshLayout.post(new Runnable() {
        @Override
        public void run() {
            refreshLayout.setRefreshing(true);

            gestor.getAllHamburgerAPI(getContext(), HamburgerJsonParse.isConnectionInternet(getContext()));

        }
    });

        */


    }






}






