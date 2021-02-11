package com.example.administration_west.Models;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;

public class CompaniesDBHelper extends SQLiteOpenHelper {

    private static final String NOME_BD = "EmpresasDB";
    private static final int VERSAO_BD = 1;
    //dados da tabela
    private static final String TABELA = "Empresas";

    private static final String ID = "id";
    private static final String COMPANY_NAME = "company_name";
    private static final String IMAGE = "image";
    private static final String DESCRIPTION = "description";

    private final SQLiteDatabase basedados;

    public CompaniesDBHelper (Context context) {

        super(context, NOME_BD, null, VERSAO_BD);
        basedados = this.getWritableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase db) {

        String sqlTabela = "CREATE TABLE " + TABELA + "(" +
                ID + " INTEGER PRIMARY KEY, " +
                COMPANY_NAME + " TEXT NOT NULL, " +
                IMAGE + " TEXT, " +
                DESCRIPTION + " TEXT NOT NULL  )";

        db.execSQL(sqlTabela);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS " + TABELA);
        this.onCreate(db);
    }

    //Definir os métodos CRUD para gerir a base de dados




    public Companies addCompaniesdb(Companies companies){
        ContentValues valores = new ContentValues();
        valores.put(ID, companies.getId());
        valores.put(COMPANY_NAME, companies.getCompany_name());
        valores.put(IMAGE, companies.getImage());
        valores.put(DESCRIPTION, companies.getDescription());

        int id = (int) this.basedados.insert(TABELA, null, valores);
        if(id > -1){
            companies.setId(id);
            return companies;
        }
        return null;
    }

    public void removerAllCompaniesDB(){
        this.basedados.delete(TABELA, null, null);
    }

    public ArrayList<Companies> getAllCompanies(){
        ArrayList<Companies> lista = new ArrayList<>();

        Cursor cursor = this.basedados.query(TABELA,
                new String [] {ID, COMPANY_NAME, IMAGE,  DESCRIPTION},
                null, null, null, null, null);

        if(cursor.moveToFirst()){
            do{
                Companies companies = new Companies (cursor.getInt(0), cursor.getString(1),
                        cursor.getString(2), cursor.getString(3));


                lista.add(companies);

            }while(cursor.moveToNext());
        }
        return lista;
    }

}
