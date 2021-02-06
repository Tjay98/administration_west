package com.example.administration_west.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.administration_west.Models.History;
import com.example.administration_west.R;

import java.util.ArrayList;


public class HistoryAdapter  extends RecyclerView.Adapter<HistoryAdapter.HistoryViewHolder> {

    private Context context;
    private ArrayList<History> historylist;
    private HistoryAdapter.OnItemClickListener mListener;

    public interface OnItemClickListener {
        void onItemClick(int position);
    }

    public void setOnItemClickListener(OnItemClickListener listener){
        mListener = listener;
    }

    public HistoryAdapter(Context context, ArrayList<History> history) {
        this.context = context;
        this.historylist = history;
    }

    @NonNull
    @Override
    public HistoryAdapter.HistoryViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context).inflate(R.layout.item_recycle_historico, parent, false);
        return new HistoryAdapter.HistoryViewHolder(view);



    }

    @Override
    public void onBindViewHolder(@NonNull HistoryAdapter.HistoryViewHolder holder, int position) {
        History currentItem = historylist.get(position);

        int id = currentItem.getId();
        double total = currentItem.getTotal_price();
        String created_date = currentItem.getCreated_date();
        String status = currentItem.getStatus();





        holder.id.setText(id);
        holder.date.setText(created_date);
        holder.status.setText(status);
        holder.total.setText(total+"€");

    }

    @Override
    public int getItemCount() {
        return historylist.size();
    }

    public class HistoryViewHolder extends RecyclerView.ViewHolder {
        public TextView id , date , total , status;
        public HistoryViewHolder(View view) {
            super(view);
            id = itemView.findViewById(R.id.tvHistoricoID);
            date = itemView.findViewById(R.id.tvHistoricoData);
            total = itemView.findViewById(R.id.tvHistoricoTotal);
            status = itemView.findViewById(R.id.tvHistoricoEstado);

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
}
