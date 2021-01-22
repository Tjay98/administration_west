package com.example.administration_west.Pages;

import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;

import android.app.SearchManager;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.Filter;
import android.widget.SearchView;
import android.widget.TextView;
import android.widget.Toast;

import com.example.administration_west.Adapters.ProductsAdapter;
import com.example.administration_west.Models.Products;
import com.example.administration_west.Models.SessionUser;
import com.example.administration_west.R;
import com.google.android.material.navigation.NavigationView;

import java.util.ArrayList;
import java.util.List;

public class MainActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener {

    private NavigationView navigationview;
    private DrawerLayout drawer;
    private FragmentManager fragmentManager;
    SessionUser sessionUser;
    private SearchView searchView;
    private ArrayList<Products> contactList;
    private ProductsAdapter mAdapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        sessionUser= new SessionUser(this);
        sessionUser.checkLogin();

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
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_toolbar, menu);

        // Associate searchable configuration with the SearchView
        SearchManager searchManager = (SearchManager) getSystemService(Context.SEARCH_SERVICE);
        searchView = (SearchView) menu.findItem(R.id.search).getActionView();
        searchView.setSearchableInfo(searchManager.getSearchableInfo(getComponentName()));
        searchView.setMaxWidth(Integer.MAX_VALUE);

        // listening to search query text change
        searchView.setOnQueryTextListener(new SearchView.OnQueryTextListener() {
            @Override
            public boolean onQueryTextSubmit(String query) {
                if(mAdapter != null) {
                    mAdapter.getFilter().filter(query);
                    return true;
                }
                return false;
            }

            @Override
            public boolean onQueryTextChange(String query) {
                if(mAdapter != null) {
                    mAdapter.getFilter().filter(query);
                    return true;
                }
                return false;
            }
        });
        return true;

    }

    @Override
    public void onBackPressed() {
        // close search view on back button pressed
        if (!searchView.isIconified()) {
            searchView.setIconified(true);
            return;
        }
        super.onBackPressed();
    }



    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.search:
                return true;
            case R.id.shop:
                mostrarCart();
                return true;
        }
        return super.onOptionsItemSelected(item);
    }

    private void mostrarCart() {
        Intent intentCart = new Intent(this, CartActivity.class);
        startActivity(intentCart);
        finish();
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
                setTitle("Empresas");
                break;
            case R.id.nav_profile:
                fragmento = new ProfileFragment();
                navigationview.setCheckedItem(R.id.nav_profile);
                setTitle("Perfil");
                break;
            case R.id.nav_contacts:
                fragmento = new ContactsFragment();
                navigationview.setCheckedItem(R.id.nav_contacts);
                setTitle("Contactos");
                break;
            case R.id.nav_logout:
                navigationview.setCheckedItem(R.id.nav_logout);
                sessionUser.logout();
                break;

        }

        if(fragmento != null){
            getSupportFragmentManager().beginTransaction().replace(R.id.contentFragment, fragmento).commit();
        }

        drawer.closeDrawer(GravityCompat.START);
        return true;
    }

}