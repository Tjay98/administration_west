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
import com.example.administration_west.Models.History;
import com.example.administration_west.Models.Products;
import com.example.administration_west.Pages.CartActivity;
import com.example.administration_west.R;
import com.squareup.picasso.Picasso;

import org.json.JSONException;
import org.json.JSONObject;

import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.HashMap;
import java.util.Map;

import static com.example.administration_west.Pages.ProductFragment.ip;

public class HistoryAdapter  extends RecyclerView.Adapter<HistoryAdapter.HistoryViewHolder> {

    private Context context;
    private ArrayList<History> historyList;
    private OnItemClickListener mListener;


    public interface OnItemClickListener {
        void onItemClick(int position);
    }

    public void setOnItemClickListener(OnItemClickListener listener){
        mListener = listener;
    }

    public HistoryAdapter(Context mContext, ArrayList<History> histories) {
        this.context = mContext;
        this.historyList = histories;
    }


    public class HistoryViewHolder extends RecyclerView.ViewHolder {

        public TextView id, total_price, created_date,  status;

        public HistoryViewHolder(View itemView) {
            super(itemView);

            id = (TextView) itemView.findViewById(R.id.tvHistoricoID);
            total_price = (TextView) itemView.findViewById(R.id.tvHistoricoTotal);
            created_date = (TextView) itemView.findViewById(R.id.tvHistoricoData);
            status = (TextView) itemView.findViewById(R.id.tvHistoricoEstado);

            itemView.setOnClickListener(new View.OnClickListener() {
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
    public HistoryViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        LayoutInflater inflater = LayoutInflater.from(context);
        View view = inflater.inflate(R.layout.item_recycle_historico, parent, false);
        return new HistoryViewHolder(view);
    }

    @Override
    public void onBindViewHolder(HistoryViewHolder holder, int position) {
        History currentItem = historyList.get(position);

        // Indices for the _id, description, and priority columns
        String Id = String.valueOf(currentItem.getId());
        String TotalPrice = String.valueOf(currentItem.getTotal_price());
        String TotalIva = String.valueOf(currentItem.getTotal_iva());
        String CreatedDate = String.valueOf(currentItem.getCreated_date());
        String Status = currentItem.getStatus();

        //Set values
        holder.id.setText("#" + Id);
        holder.total_price.setText("Total " + TotalPrice + " €");
       // holder.created_date.setText(CreatedDate);

        DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
        try {
            String inputText = CreatedDate;
            Date dateTime = dateFormat.parse(inputText);
            String outputText = dateFormat.format(dateTime);
            holder.created_date.setText(outputText);
        } catch (ParseException e) {
            e.printStackTrace();
        }

        if(Status.equals("0")){
            holder.status.setText("Estado: Processamento");
        } else if(Status.equals("1")){
            holder.status.setText("Estado: Processado");
        } else if(Status.equals("2")){
            holder.status.setText("Estado: Enviado");
        } else{
            holder.status.setText("Estado: Cancelado");
        }

    }

    @Override
    public int getItemCount() {
        return historyList.size();
    }

}
