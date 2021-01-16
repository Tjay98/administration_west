package com.example.administration_west.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.recyclerview.widget.RecyclerView;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.administration_west.Models.Cart;
import com.example.administration_west.Models.Products;
import com.example.administration_west.Pages.CartActivity;
import com.example.administration_west.R;
import com.squareup.picasso.Picasso;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

import static com.example.administration_west.Pages.ProductFragment.ip;

public class CartAdapter  extends RecyclerView.Adapter<CartAdapter.CartViewHolder> {

    private Context mContext;
    private ArrayList<Cart> ccart;
    private OnItemClickListener mListener;


    public interface OnItemClickListener {
        void onItemClick(int position);
    }

    public void setOnItemClickListener(OnItemClickListener listener){
        mListener = listener;
    }

    public CartAdapter(Context mContext, ArrayList<Cart> cart) {
        this.mContext = mContext;
        this.ccart = cart;
    }


    public class CartViewHolder extends RecyclerView.ViewHolder {

        public TextView productName, productQuantity, productPreco;
        public ImageView productImage;
        public ImageButton Remove;


        public CartViewHolder(View itemView) {
            super(itemView);

            productName = (TextView) itemView.findViewById(R.id.tVNomeProductCart);
            productQuantity = (TextView) itemView.findViewById(R.id.tVQuantityProductCart);
            productPreco = (TextView) itemView.findViewById(R.id.tVPriceProductCart);
            productImage=(ImageView) itemView.findViewById(R.id.imProductCart);
            Remove=(ImageButton) itemView.findViewById(R.id.removeProductCart);



            Remove.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
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
    public CartViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        LayoutInflater inflater = LayoutInflater.from(mContext);
        View view = inflater.inflate(R.layout.item_recicle_cart, parent, false);
        return new CartViewHolder(view);
    }

    @Override
    public void onBindViewHolder(CartViewHolder holder, int position) {
        Cart currentItem = ccart.get(position);

        // Indices for the _id, description, and priority columns
        int ProductId = currentItem.getId();
        String ProductName = currentItem.getProduct_name();
        String ProductQuantity = String.valueOf(currentItem.getQuantity());
        String ProductPrice = String.valueOf(currentItem.getPrice());
        String product_image =  ip + "uploads/products/"+currentItem.getImage();

        //Set values
        holder.productName.setText(ProductName);
        holder.productQuantity.setText("Quantidade: " + ProductQuantity);
        holder.productPreco.setText(ProductPrice + " €");

        Picasso.with(mContext).load(product_image)
                .placeholder(R.drawable.sem_imagem)
                .error(R.drawable.sem_imagem)
                .fit()
                .centerInside()
                .into(holder.productImage);
    }


    @Override
    public int getItemCount() {
       return ccart.size();
    }


    public void addItems(ArrayList<Cart> dataList){
        ccart.addAll(dataList);
        notifyDataSetChanged();
    }

    public void clear() {
        int size = ccart.size();
        ccart.clear();
        notifyItemRangeRemoved(0, size);
    }


}
