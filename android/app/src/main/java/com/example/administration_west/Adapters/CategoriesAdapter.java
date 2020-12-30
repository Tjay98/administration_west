package com.example.administration_west.Adapters;



import android.content.Context;
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



public class CategoriesAdapter  extends RecyclerView.Adapter<CategoriesAdapter.CategoriesViewHolder> {

    private Context ccontext;
    private ArrayList<Categories> ccategories;

    public CategoriesAdapter(Context context, ArrayList<Categories> categories) {
        ccontext = context;
        ccategories = categories;
    }

    public class CategoriesViewHolder extends RecyclerView.ViewHolder {
        public TextView category_name;

        public CategoriesViewHolder(View itemView) {
            super(itemView);
            category_name = itemView.findViewById(R.id.tvCategoryName);
        }
    }

    @Override
    public CategoriesViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view=LayoutInflater.from(ccontext).inflate(R.layout.item_recicle_categories, parent, false);
        return new CategoriesViewHolder(view);
    }


    @Override
    public void onBindViewHolder(CategoriesViewHolder holder, int position) {
        Categories currentItem=ccategories.get(position);

        String category_name = currentItem.getCategory_name();

        holder.category_name.setText(category_name);

    }

    @Override
    public int getItemCount() {
        return ccategories.size();
    }


}
