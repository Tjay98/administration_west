package com.example.administration_west.Adapters;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.administration_west.Models.Products;
import com.example.administration_west.R;

import java.util.ArrayList;

public class ProductsAdapter extends RecyclerView.Adapter<ProductsAdapter.ProductsRVViewHolder>{

    private ArrayList<Products> items;
    int row_index = -1;

    public ProductsAdapter(ArrayList<Products> items){
        this.items = items;
    }

    @NonNull
    @Override
    public ProductsAdapter.ProductsRVViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_recicle_product, parent, false);
        ProductsAdapter.ProductsRVViewHolder productsRVViewHolder = new ProductsAdapter.ProductsRVViewHolder(view);
        return productsRVViewHolder;
    }

    @Override
    public void onBindViewHolder(@NonNull ProductsAdapter.ProductsRVViewHolder holder, int position) {
        Products products = items.get(position);
        holder.nameProduct.setText(products.getProduct_name());

        holder.linearLayout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                row_index = position;
                notifyDataSetChanged();
            }
        });

        if(row_index==position){
            holder.linearLayout.setBackgroundResource(R.drawable.product_recycle_view_bg_selected);
        } else {
            holder.linearLayout.setBackgroundResource(R.drawable.product_recycle_view_bg);

        }
    }

    @Override
    public int getItemCount() {
        return items.size();
    }

    public static class ProductsRVViewHolder extends RecyclerView.ViewHolder {

        TextView nameProduct, price;
        ImageView imageProduct;
        LinearLayout linearLayout;


        public ProductsRVViewHolder(@NonNull View itemView){
            super(itemView);
            nameProduct=itemView.findViewById(R.id.tvProductNameGrid);
            imageProduct=itemView.findViewById(R.id.ivProductImageGrid);
            linearLayout = itemView.findViewById(R.id.linearLayoutProducts);
            price = itemView.findViewById(R.id.tvPriceNameGrid);

        }

    }
}