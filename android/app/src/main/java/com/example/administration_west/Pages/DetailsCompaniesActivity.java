package com.example.administration_west.Pages;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.administration_west.R;
import com.squareup.picasso.Picasso;

import static com.example.administration_west.Pages.CompaniesFragment.EXTRA_COMPANY_NAME;
import static com.example.administration_west.Pages.CompaniesFragment.EXTRA_DESCRIPTION;
import static com.example.administration_west.Pages.CompaniesFragment.EXTRA_IMAGE;

public class DetailsCompaniesActivity extends AppCompatActivity {

    Button buttonVoltarCompanies;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_details_companies);

        Intent intent = getIntent();
        String company_image = intent.getStringExtra(EXTRA_IMAGE);
        String company_name = intent.getStringExtra(EXTRA_COMPANY_NAME);
        String company_description = intent.getStringExtra(EXTRA_DESCRIPTION);


        ImageView image = findViewById(R.id.iVEmpresaDC);
        TextView name = findViewById(R.id.tVNomeEmpresaDC);
        TextView description = findViewById(R.id.tVDescricaoEmpresaDC);
        buttonVoltarCompanies = findViewById(R.id.buttonVoltarCompanies);

        Picasso.with(this).load(company_image)
                .placeholder(R.drawable.sem_imagem)
                .error(R.drawable.sem_imagem)
                .fit()
                .centerInside()
                .into(image);

        name.setText(company_name);
        description.setText(company_description);

        buttonVoltarCompanies.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                mainactivity();
            }
        });
    }

    private void mainactivity() {
        Intent intentMain = new Intent(this, MainActivity.class);
        startActivity(intentMain);
        finish();
    }

}