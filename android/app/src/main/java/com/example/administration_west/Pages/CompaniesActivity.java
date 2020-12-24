package com.example.administration_west.Pages;

import android.os.Bundle;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.example.administration_west.Adapters.CompaniesAdapter;
import com.example.administration_west.Models.Companies;
import com.example.administration_west.R;

import java.util.ArrayList;

public class CompaniesActivity extends AppCompatActivity {

    private RecyclerView recyclerViewCompanies;
    private CompaniesAdapter adaptadorCompanies;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_companies);


        ArrayList<Companies> companies = new ArrayList<>();
        companies.add(new Companies(R.drawable.ic_launcher_background, "Empresa 1"));
        companies.add(new Companies(R.drawable.ic_launcher_background, "Empresa 2"));
        companies.add(new Companies(R.drawable.ic_launcher_background, "Empresa 3"));
        companies.add(new Companies(R.drawable.ic_launcher_background, "Empresa 4"));


        recyclerViewCompanies = findViewById(R.id.RecicleViewCompanies);
        adaptadorCompanies = new CompaniesAdapter(companies);
        recyclerViewCompanies.setLayoutManager(new LinearLayoutManager(this, LinearLayoutManager.VERTICAL,false));
        recyclerViewCompanies.setAdapter(adaptadorCompanies);


    }
}