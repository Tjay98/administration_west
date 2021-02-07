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
import com.example.administration_west.Models.DetailsHistory;
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

public class DetailsHistoryAdapter  extends RecyclerView.Adapter<DetailsHistoryAdapter.DetailHistoryViewHolder> {

    private Context mContext;
    private ArrayList<DetailsHistory> historyList;


    public DetailsHistoryAdapter(Context mContext, ArrayList<DetailsHistory> histories) {
        this.mContext = mContext;
        this.historyList = histories;
    }

    public class DetailHistoryViewHolder extends RecyclerView.ViewHolder {

        public TextView id, productName, productPrice, productPriceIva, productQuantity;


        public DetailHistoryViewHolder(View itemView) {
            super(itemView);

            productName = (TextView) itemView.findViewById(R.id.tVNomeProdutoItemDetailsHistory);
            productPrice = (TextView) itemView.findViewById(R.id.tVPrecoProdutoItemDetailsHistory);
            productPriceIva = (TextView) itemView.findViewById(R.id.tVIVAProdutoIteDetailsHistory);
            productQuantity = (TextView) itemView.findViewById(R.id.tVQuantidadeProdutoItemDetailsHistory);

        }
    }

    @Override
    public DetailHistoryViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        LayoutInflater inflater = LayoutInflater.from(mContext);
        View view = inflater.inflate(R.layout.item_recycle_detail_history, parent, false);
        return new DetailHistoryViewHolder(view);
    }

    @Override
    public void onBindViewHolder(DetailHistoryViewHolder holder, int position) {
        DetailsHistory currentItem = historyList.get(position);


        // Indices for the _id, description, and priority columns
        int ProductId = currentItem.getId();
        String ProductName = currentItem.getProduct_name();
        String ProductPrice = String.valueOf(currentItem.getPrice());
        String ProductPriceIva = String.valueOf(currentItem.getPriceIva());
        String ProductQuantity = String.valueOf(currentItem.getQuantity());

        //Set values
        holder.productName.setText(ProductName);
        holder.productPrice.setText(ProductPrice + " €");
        holder.productPriceIva.setText(ProductPriceIva + " €");
        holder.productQuantity.setText(ProductQuantity);


    }


    @Override
    public int getItemCount() {
        return historyList.size();
    }

}
