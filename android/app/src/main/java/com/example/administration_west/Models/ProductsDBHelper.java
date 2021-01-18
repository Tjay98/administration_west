package com.example.administration_west.Models;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.widget.Toast;

import androidx.annotation.Nullable;

import java.util.ArrayList;

public class ProductsDBHelper extends SQLiteOpenHelper {
    private static final String NOME_BD = "ProdutosDB";
    private static final int VERSAO_BD = 1;
    //dados da tabela
    private static final String TABELA = "Produtos";

    private static final String ID = "id";
    private static final String PRODUCT_NAME = "product_name";
    private static final String IMAGE = "image";
    private static final String BIG_DESCRIPTION = "big_description";
    private static final String CATEGORY_NAME = "category_name";
    private static final String CATEGORY_ID = "category_id";
    private static final String COMPANY_NAME = "company_name";
    private static final String COMPANY_ID = "company_id";
    private static final String QUANTITY_IN_STOCK = "quantity_in_stock";
    private static final String PRICE = "price";
    private static final String PRICE_IVA = "price_iva";

    private final SQLiteDatabase basedados;

    public ProductsDBHelper (Context context) {

        super(context, NOME_BD, null, VERSAO_BD);
        basedados = this.getWritableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase db) {

        String sqlTabela = "CREATE TABLE " + TABELA + "(" +
                ID + " INTEGER PRIMARY KEY, " +
                PRODUCT_NAME + " TEXT NOT NULL, " +
                IMAGE + " TEXT, " +
                BIG_DESCRIPTION + " TEXT NOT NULL, " +
                CATEGORY_NAME + " TEXT NOT NULL, "+
                CATEGORY_ID + " INTEGER , "+
                COMPANY_NAME + " TEXT NOT NULL, "+
                COMPANY_ID + " INTEGER, " +
                QUANTITY_IN_STOCK + " INTEGER, " +
                PRICE + " DOUBLE NOT NULL, " +
                PRICE_IVA + " DOUBLE  )";

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
        valores.put(ID, products.getId());
        valores.put(PRODUCT_NAME, products.getProduct_name());
        valores.put(IMAGE, products.getImage());
        valores.put(BIG_DESCRIPTION, products.getBig_description());
        valores.put(CATEGORY_NAME, products.getCategory_name());
        valores.put(CATEGORY_ID, products.getCategory_id());
        valores.put(COMPANY_NAME, products.getCompany_name());
        valores.put(COMPANY_ID, products.getCompany_id());
        valores.put(QUANTITY_IN_STOCK, products.getQuantity_in_stock());
        valores.put(PRICE, products.getPrice());
        valores.put(PRICE_IVA, products.getPrice_iva());

        int id = (int) this.basedados.insert(TABELA, null, valores);
        if(id > -1){
            products.setId(id);
            return products;
        }
        return null;
    }

    public void removerAllProductsDB(){
        this.basedados.delete(TABELA, null, null);
    }

    public ArrayList<Products> getAllProducts(){
        ArrayList<Products> lista = new ArrayList<>();

        Cursor cursor = this.basedados.query(TABELA,
                new String [] {ID, PRODUCT_NAME, IMAGE,  BIG_DESCRIPTION, CATEGORY_NAME, CATEGORY_ID, COMPANY_NAME, COMPANY_ID, QUANTITY_IN_STOCK, PRICE, PRICE_IVA},
                null, null, null, null, null);

        if(cursor.moveToFirst()){
            do{
                Products products = new Products (cursor.getInt(0), cursor.getString(1),
                        cursor.getString(2), cursor.getString(3),
                        cursor.getString(4), cursor.getInt(5),
                        cursor.getString(6),cursor.getInt(7),
                        cursor.getInt(8),cursor.getDouble(9),
                        cursor.getDouble(10));


                lista.add(products);

            }while(cursor.moveToNext());
        }
        return lista;
    }

}
