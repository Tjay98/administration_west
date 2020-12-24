package com.example.administration_west.Adapters;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.administration_west.Models.Companies;
import com.example.administration_west.R;

import java.util.ArrayList;

public class CompaniesAdapter extends RecyclerView.Adapter<CompaniesAdapter.CompaniesRVViewHolder> {

    private ArrayList<Companies> items;

    int row_index = -1;

    public CompaniesAdapter(ArrayList<Companies> items){

        this.items = items;

    }

    @NonNull

    @Override

    public CompaniesRVViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {

        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_recicle_companies, parent, false);

        CompaniesRVViewHolder companiesRVViewHolder = new CompaniesRVViewHolder(view);

        return companiesRVViewHolder;

    }

    @Override

    public void onBindViewHolder(@NonNull CompaniesRVViewHolder holder, int position) {

        Companies companies = items.get(position);

        holder.nameCompany.setText(companies.getCompany_name());

        holder.linearLayout.setOnClickListener(new View.OnClickListener() {

            @Override

            public void onClick(View v) {

                row_index = position;

                notifyDataSetChanged();
            }
        });

        if(row_index==position){
            holder.linearLayout.setBackgroundResource(R.drawable.companies_recycle_view_bg_selected);
        } else {
            holder.linearLayout.setBackgroundResource(R.drawable.companies_recycle_view_bg);

        }
    }

    @Override
    public int getItemCount() {
        return items.size();
    }


    public static class CompaniesRVViewHolder extends RecyclerView.ViewHolder {

        TextView nameCompany;
        LinearLayout linearLayout;


        public CompaniesRVViewHolder(@NonNull View itemView){

            super(itemView);

            nameCompany=itemView.findViewById(R.id.tvCompanyName);
            linearLayout = itemView.findViewById(R.id.linearLayoutCompanies);
        }
    }
}