package com.example.administration_west.Pages;

import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;

import com.example.administration_west.R;
import com.google.android.material.navigation.NavigationView;

public class MainActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener {

    private NavigationView navigationview;
    private DrawerLayout drawer;
    private FragmentManager fragmentManager;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        Toolbar toolbar = findViewById(R.id.toolbar);

        setSupportActionBar(toolbar);

        navigationview = findViewById(R.id.nav_view);
        drawer = findViewById(R.id.drawer_layout);

        ActionBarDrawerToggle toogle = new ActionBarDrawerToggle(this,
                drawer, toolbar, R.string.ndOpen, R.string.ndClose);
        toogle.syncState();
        drawer.addDrawerListener(toogle);

        navigationview.setNavigationItemSelectedListener(this);

        fragmentManager=getSupportFragmentManager();


        carregarCabecalho();
        loadFragmentoInicial();
    }

    private void loadFragmentoInicial() {
        navigationview.setCheckedItem(R.id.nav_product);
        Fragment fragmento = new ProductFragment();
        fragmentManager.beginTransaction().replace(R.id.contentFragment, fragmento).commit();
        setTitle("Produtos");
    }


    private void carregarCabecalho() {

//        SharedPreferences sharedPreferencesInfoUser = getSharedPreferences(PREF_USER, Context.MODE_PRIVATE);
//
//        email = sharedPreferencesInfoUser.getString(EMAIL, getString(R.string.semEmail));


        View cabecalho = navigationview.getHeaderView(0);
//        TextView tvmail = cabecalho.findViewById(R.id.tvNavMail);
//        tvmail.setText(email);
    }

    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        Fragment fragmento = null;
        switch(item.getItemId()){
            case R.id.nav_product:
                fragmento = new ProductFragment();
                navigationview.setCheckedItem(R.id.nav_product);
                setTitle(item.getTitle());
                break;
            case R.id.nav_company:
                fragmento = new CompaniesFragment();
                navigationview.setCheckedItem(R.id.nav_company);
                setTitle(item.getTitle());
                break;
            case R.id.nav_profile:
                fragmento = new ProfileFragment();
                navigationview.setCheckedItem(R.id.nav_profile);
                break;
            case R.id.nav_contacts:
                fragmento = null;
                navigationview.setCheckedItem(R.id.nav_contacts);
                break;
            case R.id.nav_logout:
                navigationview.setCheckedItem(R.id.nav_logout);
                logout();
                break;

        }

        if(fragmento != null){
            getSupportFragmentManager().beginTransaction().replace(R.id.contentFragment, fragmento).commit();
        }

        drawer.closeDrawer(GravityCompat.START);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
//            case R.id.notificacoes:
//                Toast.makeText(this, item.getTitle(), Toast.LENGTH_SHORT).show();
//                return true;
//            case R.id.pesquisa:
//                Toast.makeText(this, item.getTitle(), Toast.LENGTH_SHORT).show();
//                return true;
        }
        return super.onOptionsItemSelected(item);
    }

    public void logout(){

    }
}