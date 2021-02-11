package com.example.administration_west.Models;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;

public class CategoriesDBHelper extends SQLiteOpenHelper {

    private static final String NOME_BD = "CategoriasDB";
    private static final int VERSAO_BD = 1;
    //dados da tabela
    private static final String TABELA = "Categorias";

    private static final String ID = "id";
    private static final String CATEGORY_NAME = "category_name";

    private final SQLiteDatabase basedados;

    public CategoriesDBHelper (Context context) {

        super(context, NOME_BD, null, VERSAO_BD);
        basedados = this.getWritableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase db) {

        String sqlTabela = "CREATE TABLE " + TABELA + "(" +
                ID + " INTEGER PRIMARY KEY, " +
                CATEGORY_NAME + " TEXT NOT NULL )";

        db.execSQL(sqlTabela);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS " + TABELA);
        this.onCreate(db);
    }

    //Definir os métodos CRUD para gerir a base de dados




    public Categories addPCategoriesdb(Categories categories){
        ContentValues valores = new ContentValues();
        valores.put(ID, categories.getId());
        valores.put(CATEGORY_NAME, categories.getCategory_name());

        int id = (int) this.basedados.insert(TABELA, null, valores);
        if(id > -1){
            categories.setId(id);
            return categories;
        }
        return null;
    }

    public void removerAllCategoriesDB(){
        this.basedados.delete(TABELA, null, null);
    }

    public ArrayList<Categories> getAllCategories(){
        ArrayList<Categories> lista = new ArrayList<>();

        Cursor cursor = this.basedados.query(TABELA,
                new String [] {ID, CATEGORY_NAME},
                null, null, null, null, null);

        if(cursor.moveToFirst()){
            do{
                Categories categories = new Categories (cursor.getInt(0),
                        cursor.getString(1));


                lista.add(categories);

            }while(cursor.moveToNext());
        }
        return lista;
    }

}
