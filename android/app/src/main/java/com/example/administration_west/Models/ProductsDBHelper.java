package com.example.administration_west.Models;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import androidx.annotation.Nullable;

import java.util.ArrayList;

public class ProductsDBHelper extends SQLiteOpenHelper {
    private static final String NOME_BD = "ProdutosDB";
    private static final int VERSAO_BD = 1;
    //dados da tabela
    private static final String TABELA = "Produtos";

    private static final int ID_PRODUTO = 0;
    private static final String NOME_PRODUTO = "nome";
    private static final String IMAGEM = "imagem";
    private static final Double PRECO = 0.0;
    private static final String BIG_DESCRIPTION = "descriçao";
    private static final String CATEGORY_NAME = "categoria";
    private static final int CATEGORY_ID = 0;
    private static final String COMPANY_NAME = "empresa";
    private static final int COMPANY_ID = 0;
    private static final int QUANTITY_IN_STOCK = 0;
    private static final double PRICE_IVA = 0.0;

    private final SQLiteDatabase basedados;

    public ProductsDBHelper (Context context) {

        super(context, NOME_BD, null, VERSAO_BD);
        basedados = this.getWritableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        String sqlTabela = String.format("CREATE TABLE %s(%d INTEGER PRIMARY KEY, %s TEXT NOT NULL, %s TEXT NOT NULL, %s DOUBLE NOT NULL, %s TEXT NOT NULL, %s DOUBLE NOT NULL, %sSTRING NOT NULL,%dINT NOT NULL,%sSTRING NOT NULL,%dINT NOT NULL,%dINT NOT NULL,%sDOUBLE NOT NULL,)", TABELA, ID_PRODUTO, NOME_PRODUTO, IMAGEM, PRECO, BIG_DESCRIPTION, PRECO, CATEGORY_NAME, CATEGORY_ID, COMPANY_NAME, COMPANY_ID, QUANTITY_IN_STOCK, PRICE_IVA);
//        String sqlTabela = "CREATE TABLE " + TABELA + "(" +
//                ID_PRODUTO + " INTEGER PRIMARY KEY, " +
//                NOME_PRODUTO + " TEXT NOT NULL, " +
//                IMAGEM + " TEXT NOT NULL, " +
//                PRECO + " DOUBLE NOT NULL, " +
//                BIG_DESCRIPTION + " TEXT NOT NULL, " +
//                PRECO + " DOUBLE NOT NULL, " +
//                CATEGORY_NAME + "STRING NOT NULL,"+
//                CATEGORY_ID + "INT NOT NULL,"+
//                COMPANY_NAME + "STRING NOT NULL,"+
//                COMPANY_ID + "INT NOT NULL,"+
//                QUANTITY_IN_STOCK + "INT NOT NULL,"+
//                PRICE_IVA + "DOUBLE NOT NULL,"+
//
//                ")";
        db.execSQL(sqlTabela);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS " + TABELA);
        this.onCreate(db);
    }

    //Definir os métodos CRUD para gerir a base de dados

    public Products addProductsdb(Products products){
        ContentValues valores = new ContentValues();
        valores.put(String.valueOf(ID_PRODUTO), products.getId());
        valores.put(NOME_PRODUTO, products.getProduct_name());
        valores.put(IMAGEM, products.getImage());
        valores.put(String.valueOf(PRECO), products.getPrice());
        valores.put(BIG_DESCRIPTION, products.getBig_description());
        valores.put(CATEGORY_NAME, products.getCategory_name());
        valores.put(String.valueOf(CATEGORY_ID), products.getCategory_id());
        valores.put(COMPANY_NAME, products.getCompany_name());
        valores.put(String.valueOf(COMPANY_ID), products.getCompany_id());
        valores.put(String.valueOf(QUANTITY_IN_STOCK), products.getQuantity_in_stock());
        valores.put(String.valueOf(PRICE_IVA), products.getPrice_iva());

        int id = (int) this.basedados.insert(TABELA, null, valores);
        if(id > -1){
            products.setId(id);
            return products;
        }
        return null;
    }

//    public Products adicionar1a1(int Product_id, String Product_name, )


//    public boolean editarLivroDB(Livro livro){
//        ContentValues valores = new ContentValues();
//        valores.put(TITULO_LIVRO, livro.getTitulo());
//        valores.put(SERIE_LIVRO, livro.getSerie());
//        valores.put(AUTOR_LIVRO, livro.getAutor());
//        valores.put(ANO_LIVRO, livro.getAno());
//        valores.put(CAPA_LIVRO, livro.getCapa());
//
//        int registosalterados = this.basedados.update(TABELA, valores,
//                "id = ?", new String [] {""+ livro.getId()});
//
//        return registosalterados > 0;
//    }


    public boolean removerProductsDB(int id){
        return this.basedados.delete(TABELA, "id = ?",
                new String [] {""+ id}) == 1;
    }

    public void removerAllProductsDB(){
        this.basedados.delete(TABELA, null, null);
    }

    public ArrayList<Products> getAllProducts(){
        ArrayList<Products> lista = new ArrayList<>();


        Cursor cursor = this.basedados.query(TABELA,
                new String [] {String.valueOf(ID_PRODUTO), NOME_PRODUTO, IMAGEM, String.valueOf(PRECO), BIG_DESCRIPTION, CATEGORY_NAME, String.valueOf(CATEGORY_ID), COMPANY_NAME, String.valueOf(COMPANY_ID), String.valueOf(QUANTITY_IN_STOCK), String.valueOf(PRICE_IVA)},
                null, null, null, null, null);

        if(cursor.moveToFirst()){
            do{
                Products products = new Products (cursor.getInt(0), cursor.getString(1),
                        cursor.getString(2), cursor.getString(3),
                        cursor.getString(4), cursor.getInt(5),
                        cursor.getString(6),cursor.getInt(7),
                        cursor.getInt(8),cursor.getDouble(9),
                        cursor.getDouble(10));

                //OU
                //Livro livro = new Livro (cursor.getString(1),
                //                        cursor.getString(2), cursor.getString(3),
                //                        cursor.getInt(4), cursor.getInt(5));
                //livro.setId(cursor.getInt(0))

                lista.add(products);

            }while(cursor.moveToNext());
        }
        return lista;
    }

}
