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

    //final SwipeRefreshLayout refreshLayout;
    private GridView gridProducts;
    private GridViewAdapterProducts adaptador;

    @Override
    protected void onCreate(Bundle savedInstanceState) {


        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);


        //refreshLayout = findViewById(R.id.swiperefreshMain);

        gridProducts = findViewById(R.id.gridProductMain);

        //SingletonProductManager gestor = SingletonProductManager.getInstance(getContext());

        adaptador = new GridViewAdapterProducts(getContext(),SingletonProductManager.getInstance(getContext().getProductlist()));

        gridProducts.setAdapter(adaptador);

        gridProducts.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

            }
        });
    }


}