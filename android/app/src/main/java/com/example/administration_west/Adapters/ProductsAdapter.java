package com.example.administration_west.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Filter;
import android.widget.Filterable;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.recyclerview.widget.RecyclerView;

import com.example.administration_west.Models.Products;
import com.example.administration_west.R;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;
import java.util.List;

import static com.example.administration_west.Pages.ProductFragment.ip;

public class ProductsAdapter extends RecyclerView.Adapter<ProductsAdapter.ProductsViewHolder> implements Filterable {

    private Context ccontext;
    private ArrayList<Products> cproducts;
    private OnItemClickListener mListener;
    private ArrayList<Products> productListFiltered;

    public interface OnItemClickListener {
        void onItemClick(int position);
    }

    public void setOnItemClickListener(OnItemClickListener listener){
        mListener = listener;
    }

    public ProductsAdapter(Context context, ArrayList<Products> products) {
        this.ccontext = context;
        this.cproducts = products;
        this.productListFiltered = cproducts;
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

            itemView.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    if(mListener !=null){
                        int position = getAdapterPosition();
                        if(position != RecyclerView.NO_POSITION){
                            mListener.onItemClick(position);
                        }
                    }
                }
            });
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
                .placeholder(R.drawable.sem_imagem)
                .error(R.drawable.sem_imagem)
                .fit()
                .centerInside()
                .into(holder.product_image);

    }

    @Override
    public int getItemCount() {
        return cproducts.size();
    }


    @Override
    public Filter getFilter() {
        return new Filter() {
            @Override
            protected FilterResults performFiltering(CharSequence charSequence) {
                String charString = charSequence.toString();
                if (charString.isEmpty()) {
                    productListFiltered = cproducts;
                } else {
                    ArrayList<Products> filteredList = new ArrayList<>();
                    for (Products row : cproducts) {

                        if (row.getProduct_name().toLowerCase().contains(charString.toLowerCase())) {
                            filteredList.add(row);
                        }
                    }
                    productListFiltered = filteredList;
                }
                FilterResults filterResults = new FilterResults();
                filterResults.values = productListFiltered;
                return filterResults;
            }

            @Override
            protected void publishResults(CharSequence charSequence, FilterResults filterResults) {
                productListFiltered = (ArrayList<Products>) filterResults.values;
                notifyDataSetChanged();
            }
        };
    }
}


