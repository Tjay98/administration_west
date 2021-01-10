package com.example.administration_west.Pages;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.administration_west.R;
import com.squareup.picasso.Picasso;

import static com.example.administration_west.Pages.ProductFragment.EXTRA_PRODUCT_CATEGORY;
import static com.example.administration_west.Pages.ProductFragment.EXTRA_PRODUCT_COMPANY;
import static com.example.administration_west.Pages.ProductFragment.EXTRA_PRODUCT_DESCRIPTION;
import static com.example.administration_west.Pages.ProductFragment.EXTRA_PRODUCT_IMAGE;
import static com.example.administration_west.Pages.ProductFragment.EXTRA_PRODUCT_NAME;

public class DetailsProductsActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_details_products);

        Intent intent = getIntent();
        String product_image = intent.getStringExtra(EXTRA_PRODUCT_IMAGE);
        String product_name = intent.getStringExtra(EXTRA_PRODUCT_NAME);
        String product_category_name = intent.getStringExtra(EXTRA_PRODUCT_CATEGORY);
        String product_company_name = intent.getStringExtra(EXTRA_PRODUCT_COMPANY);
        String product_description = intent.getStringExtra(EXTRA_PRODUCT_DESCRIPTION);


        ImageView image = findViewById(R.id.iVDetailProduct);
        TextView name = findViewById(R.id.tVNomeProdutoDP);
        TextView category_name = findViewById(R.id.tVCategoriaProdutoDP);
        TextView product_company_name1 = findViewById(R.id.tVEmpresaProdutoDP);
        TextView product_description2 = findViewById(R.id.tVDescricaoProdutoDP);


        Picasso.with(this).load(product_image)
                .placeholder(R.drawable.sem_imagem)
                .error(R.drawable.sem_imagem)
                .fit()
                .centerInside()
                .into(image);

        name.setText(product_name);
        category_name.setText(product_category_name);
        product_company_name1.setText(product_company_name);
        product_description2.setText(product_description);


    }


}