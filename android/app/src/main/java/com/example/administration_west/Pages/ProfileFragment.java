package com.example.administration_west.Pages;


import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.fragment.app.Fragment;

//import com.example.administration_west.Controllers.SharedPrefManager;
import com.example.administration_west.Models.Users;
import com.example.administration_west.R;

public class ProfileFragment extends Fragment {

    TextView tVNome, tVEmail, tVMobile, tVData;

    public ProfileFragment(){

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_profile, container, false);


        tVNome = (TextView) view.findViewById(R.id.tVNomeProfile);
        tVEmail = (TextView) view.findViewById(R.id.tVEmailProfile);
        tVMobile = (TextView) view.findViewById(R.id.tVMobileProfile);
        tVData = (TextView) view.findViewById(R.id.tVDataProfile);



return view;
    }
}
