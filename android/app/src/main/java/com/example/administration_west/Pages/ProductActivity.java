package com.example.administration_west.Pages;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.os.Bundle;

import com.example.administration_west.Adapters.CategoriesAdapter;
import com.example.administration_west.Adapters.ProductsAdapter;
import com.example.administration_west.Models.Categories;
import com.example.administration_west.Models.Products;
import com.example.administration_west.R;

import java.util.ArrayList;

public class ProductActivity extends AppCompatActivity {

    private RecyclerView recyclerViewCategories, recyclerViewProducts;
    private CategoriesAdapter adaptadorCategories;
    private ProductsAdapter adaptadorProducts;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_product);

//Categories
        ArrayList<Categories> categories = new ArrayList<>();
        categories.add(new Categories(R.drawable.ic_launcher_background, "Categoria 1"));
        categories.add(new Categories(R.drawable.ic_launcher_background, "Categoria 2"));
        categories.add(new Categories(R.drawable.ic_launcher_background, "Categoria 3"));
        categories.add(new Categories(R.drawable.ic_launcher_background, "Categoria 4"));
        categories.add(new Categories(R.drawable.ic_launcher_background, "Categoria 5"));
        categories.add(new Categories(R.drawable.ic_launcher_background, "Categoria 6"));
        categories.add(new Categories(R.drawable.ic_launcher_background, "Categoria 7"));
        categories.add(new Categories(R.drawable.ic_launcher_background, "Categoria 8"));
        categories.add(new Categories(R.drawable.ic_launcher_background, "Categoria 9"));
        categories.add(new Categories(R.drawable.ic_launcher_background, "Categoria 10"));
        categories.add(new Categories(R.drawable.ic_launcher_background, "Categoria 11"));

        recyclerViewCategories = findViewById(R.id.RecicleViewCategories);
        adaptadorCategories = new CategoriesAdapter(categories);
        recyclerViewCategories.setLayoutManager(new LinearLayoutManager(this, LinearLayoutManager.HORIZONTAL,false));
        recyclerViewCategories.setAdapter(adaptadorCategories);


//Products
        ArrayList<Products> products = new ArrayList<>();
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 1", R.drawable.ic_launcher_foreground, 10.00));
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 2", R.drawable.ic_launcher_foreground, 10.00));
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 3", R.drawable.ic_launcher_foreground, 10.00));
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 4", R.drawable.ic_launcher_foreground, 10.00));
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 5", R.drawable.ic_launcher_foreground, 10.00));
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 6", R.drawable.ic_launcher_foreground, 10.00));
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 7", R.drawable.ic_launcher_foreground, 10.00));
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 8", R.drawable.ic_launcher_foreground, 10.00));
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 9", R.drawable.ic_launcher_foreground, 10.00));
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 10", R.drawable.ic_launcher_foreground, 10.00));
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 11", R.drawable.ic_launcher_foreground, 10.00));
        products.add(new Products(R.drawable.ic_launcher_background, "Produto 12", R.drawable.ic_launcher_foreground, 10.00));

        recyclerViewProducts = findViewById(R.id.RecicleViewProduct);
        adaptadorProducts = new ProductsAdapter(products);
        recyclerViewProducts.setLayoutManager(new LinearLayoutManager(this, LinearLayoutManager.VERTICAL,false));
        recyclerViewProducts.setAdapter(adaptadorProducts);
    }
}