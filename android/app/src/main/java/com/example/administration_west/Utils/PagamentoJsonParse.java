package com.example.administration_west.Utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.widget.Toast;

import com.example.administration_west.Models.Pagamento;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class PagamentoJsonParse {

    public static boolean isConnected(Context contexto){
        ConnectivityManager cm= (ConnectivityManager) contexto.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo= cm.getActiveNetworkInfo();

        return networkInfo != null&&networkInfo.isConnected();
    }


    public static ArrayList<Pagamento> parseJsonPagamento(JSONArray resposta, Context contexto){
        ArrayList<Pagamento> lista= new ArrayList<Pagamento>();
        try {

            for(int i =0; i<resposta.length(); i++){

                JSONObject pagamentoapi = (JSONObject)resposta.get(i);

                Pagamento pagamento=new Pagamento(pagamentoapi.getInt("id"),
                        pagamentoapi.getString("name"));


                lista.add(pagamento);
            }
        }catch (JSONException e) {
            e.printStackTrace();
            Toast.makeText(contexto, "ERRO:" + e.getMessage(), Toast.LENGTH_SHORT).show();
        }

        return lista;

    }

    public static Pagamento parserJsonPagamento(JSONObject resposta, Context contexto){
        Pagamento pagamento = null;
        try {
            pagamento =new Pagamento(resposta.getInt("id"),
                    resposta.getString("name"));

        }catch (JSONException e) {
            e.printStackTrace();
            Toast.makeText(contexto, "ERRO:" + e.getMessage(), Toast.LENGTH_SHORT).show();
        }
        return pagamento;
    }

}
