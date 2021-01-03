package com.example.administration_west.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.administration_west.Models.Categories;
import com.example.administration_west.Models.Products;
import com.example.administration_west.R;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;

import static com.example.administration_west.Pages.ProductActivity.ip;

public class ProductsAdapter extends RecyclerView.Adapter<ProductsAdapter.ProductsViewHolder> {
    private Context ccontext;
    private ArrayList<Products> cproducts;
    int row_index = -1;

    public ProductsAdapter(Context context, ArrayList<Products> products) {
        this.ccontext = context;
        this.cproducts = products;
    }

    public class ProductsViewHolder extends RecyclerView.ViewHolder {
        public TextView product_name;
        public TextView product_price;
        public ImageView product_image;

        public ProductsViewHolder(View itemView) {
            super(itemView);
            product_name = itemView.findViewById(R.id.tvProductNameGrid);
            product_price = itemView.findViewById(R.id.tvPriceNameGrid);
            product_image = itemView.findViewById(R.id.ivProductImageGrid);
        }
    }


    @Override
    public ProductsAdapter.ProductsViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(ccontext).inflate(R.layout.item_recicle_product, parent, false);
        return new ProductsAdapter.ProductsViewHolder(view);
    }


    @Override
    public void onBindViewHolder(ProductsAdapter.ProductsViewHolder holder, int position) {
        Products currentItem = cproducts.get(position);

        String product_name = currentItem.getProduct_name();
        String product_price = String.valueOf(currentItem.getPrice());
        String product_image =  ip + "uploads/products/"+currentItem.getImage();


        holder.product_name.setText(product_name);
        holder.product_price.setText(product_price + " €"); 
 

            Picasso.with(ccontext).load(product_image)
                    .placeholder(R.drawable.ic_launcher_background)
                    .error(R.drawable.ic_launcher_background)
                    .fit()
                    .centerInside()
                    .into(holder.product_image);

    }

    @Override
    public int getItemCount() {
        return cproducts.size();
    }
} 
 
 
 
  /*  @Override 
    public ProductsRVViewHolder onCreateViewHolder( ViewGroup parent, int viewType) { 
        View view = LayoutInflater.from(context).inflate(R.layout.item_recicle_product, parent, false); 
// ProductsAdapter.ProductsRVViewHolder productsRVViewHolder = new ProductsAdapter.ProductsRVViewHolder(view); 
        return new ProductsRVViewHolder(view); 
    } 
 
    @Override 
    public void onBindViewHolder( ProductsAdapter.ProductsRVViewHolder holder, int position) { 
        Products products = items.get(position); 
 
        holder.nameProduct.setText(products.getProduct_name()); 
        holder.price.setText(String.valueOf(products.getProduct_name())); 
 
        holder.linearLayout.setOnClickListener(new View.OnClickListener() { 
            @Override 
            public void onClick(View v) { 
                row_index = position; 
                notifyDataSetChanged(); 
            } 
        }); 
 
        if (row_index == position) { 
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
        LinearLayout linearLayout; 
 
        public ProductsRVViewHolder( View itemView) { 
            super(itemView); 
            nameProduct = itemView.findViewById(R.id.tvProductNameGrid); 
            linearLayout = itemView.findViewById(R.id.linearLayoutProducts); 
            price = itemView.findViewById(R.id.tvPriceNameGrid); 
 
        } 
 
    } 
*/ 