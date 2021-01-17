package com.example.administration_west.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.recyclerview.widget.RecyclerView;

import com.example.administration_west.Models.Pagamento;
import com.example.administration_west.R;

import java.util.ArrayList;


public class PagamentoAdapter extends RecyclerView.Adapter<PagamentoAdapter.PagamentoViewHolder> {

    private Context ccontext;
    private ArrayList<Pagamento> listPagamento;
    private OnItemClickListener mListener;


    public interface OnItemClickListener {
        void onItemClick(int position);
    }

    public void setOnItemClickListener(OnItemClickListener listener){
        mListener = listener;
    }

    public PagamentoAdapter(Context context, ArrayList<Pagamento> pagamento) {
        this.ccontext = context;
        this.listPagamento = pagamento;
    }

    public class PagamentoViewHolder extends RecyclerView.ViewHolder {
        public TextView nome;


        public PagamentoViewHolder(View itemView) {
            super(itemView);
            nome = itemView.findViewById(R.id.tvPagamento);


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
    public PagamentoAdapter.PagamentoViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(ccontext).inflate(R.layout.item_recicle_pagamento, parent, false);
        return new PagamentoAdapter.PagamentoViewHolder(view);
    }


    @Override
    public void onBindViewHolder(PagamentoAdapter.PagamentoViewHolder holder, int position) {
        Pagamento currentItem = listPagamento.get(position);

        String nome = currentItem.getNome();


        holder.nome.setText(nome);


    }

    @Override
    public int getItemCount() {
        return listPagamento.size();
    }

}
