package com.example.administration_west.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import androidx.recyclerview.widget.RecyclerView;

import com.example.administration_west.Models.Companies;
import com.example.administration_west.Models.Products;
import com.example.administration_west.R;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;

import static com.example.administration_west.Pages.ProductActivity.ip;

public class CompaniesAdapter extends RecyclerView.Adapter<CompaniesAdapter.CompaniesViewHolder> {

    private Context ccontext;
    private ArrayList<Companies> companiesList;
//private OnCompanyListener onCompanyListener;

/* public interface OnCompanyListener {
void OnCompanyListener (int position);
}*/

    public CompaniesAdapter(Context context, ArrayList<Companies> companies) {
        this.ccontext = context;
        this.companiesList = companies;
// this.onCompanyListener=onListener;
    }

    public class CompaniesViewHolder extends RecyclerView.ViewHolder {
        public TextView company_name;
        public ImageView company_image;
//OnCompanyListener onCompanyListener;

        public CompaniesViewHolder(View itemView) {
            super(itemView);
            company_name = itemView.findViewById(R.id.tvCompanyName);
            company_image = itemView.findViewById(R.id.ivCompany);
// this.onCompanyListener = onCompanyListener;

// itemView.setOnClickListener(this);

        }

/* @Override
public void onClick(View v) {
onCompanyListener.OnCompanyListener(getAdapterPosition());
}*/
    }


    @Override
    public CompaniesAdapter.CompaniesViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(ccontext).inflate(R.layout.item_recicle_companies, parent, false);
        return new CompaniesAdapter.CompaniesViewHolder(view);
    }


    @Override
    public void onBindViewHolder(CompaniesAdapter.CompaniesViewHolder holder, int position) {
        Companies currentItem = companiesList.get(position);

        String company_name = currentItem.getCompany_name();
        //String company_image = currentItem.getImage();
        String company_image =  ip + "uploads/companies/"+currentItem.getImage();




        holder.company_name.setText(company_name);


        Picasso.with(ccontext).load(company_image)
                .placeholder(R.drawable.ic_launcher_background)
                .error(R.drawable.ic_launcher_background)
                .fit()
                .centerInside()
                .into(holder.company_image);
        }




    @Override
    public int getItemCount() {
        return companiesList.size();
    }
}