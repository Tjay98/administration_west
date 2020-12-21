package com.example.administration_west.Adapters;



import android.view.LayoutInflater;

import android.view.View;

import android.view.ViewGroup;

import android.widget.LinearLayout;

import android.widget.TextView;



import androidx.annotation.NonNull;

import androidx.recyclerview.widget.RecyclerView;



import com.example.administration_west.Models.Categories;

import com.example.administration_west.R;



import java.util.ArrayList;



public class CategoriesAdapter  extends RecyclerView.Adapter<CategoriesAdapter.CategoriesRVViewHolder>{



    private ArrayList<Categories> items;

    int row_index = -1;



    public CategoriesAdapter(ArrayList<Categories> items){

        this.items = items;

    }



    @NonNull

    @Override

    public CategoriesRVViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {

        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_recicle_categories, parent, false);

        CategoriesRVViewHolder categoriesRVViewHolder = new CategoriesRVViewHolder(view);

        return categoriesRVViewHolder;

    }



    @Override

    public void onBindViewHolder(@NonNull CategoriesRVViewHolder holder, int position) {

        Categories categories = items.get(position);

        holder.nameCategory.setText(categories.getCategory_name());



        holder.linearLayout.setOnClickListener(new View.OnClickListener() {

            @Override

            public void onClick(View v) {

                row_index = position;

                notifyDataSetChanged();

            }

        });



        if(row_index==position){

            holder.linearLayout.setBackgroundResource(R.drawable.categories_recycle_view_bg_selected);

        } else {

            holder.linearLayout.setBackgroundResource(R.drawable.categories_recycle_view_bg);



        }

    }



    @Override

    public int getItemCount() {

        return items.size();

    }



    public static class CategoriesRVViewHolder extends RecyclerView.ViewHolder {



        TextView nameCategory;

        LinearLayout linearLayout;





        public CategoriesRVViewHolder(@NonNull View itemView){

            super(itemView);

            nameCategory=itemView.findViewById(R.id.tvCategoryName);

            linearLayout = itemView.findViewById(R.id.linearLayoutCategories);



        }

    }

}