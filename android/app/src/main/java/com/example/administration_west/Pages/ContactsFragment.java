package com.example.administration_west.Pages;

import android.content.Intent;
import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;

import com.example.administration_west.R;


public class ContactsFragment extends Fragment {

    Button buttonSendMessageContactos;

    public ContactsFragment() {

    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_contacts, container, false);

        buttonSendMessageContactos = (Button) view.findViewById(R.id.buttonSendMessageContactos);


        buttonSendMessageContactos.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                sendMessage();
            }
        });


        return view;
    }
    private void sendMessage() {
        Intent intentRegist = new Intent(getContext(), SendMessageActivity.class);
        startActivity(intentRegist);

    }

}