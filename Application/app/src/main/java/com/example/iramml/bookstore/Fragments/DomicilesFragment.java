package com.example.iramml.bookstore.Fragments;


import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.v4.app.Fragment;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.cooltechworks.views.shimmer.ShimmerRecyclerView;
import com.example.iramml.bookstore.Activities.MainActivity;
import com.example.iramml.bookstore.Activities.RegisterDomicileActivity;
import com.example.iramml.bookstore.BookStoreApi.BookStore;
import com.example.iramml.bookstore.Interfaces.HttpResponse;
import com.example.iramml.bookstore.Model.DomicilesResponse;
import com.example.iramml.bookstore.R;
import com.example.iramml.bookstore.RecyclerViewDomiciles.ClickListener;
import com.example.iramml.bookstore.RecyclerViewDomiciles.DomicilesCustomAdapter;
import com.google.gson.Gson;

public class DomicilesFragment extends Fragment {
    View view0;
    BookStore bookStore;

    ShimmerRecyclerView rvDomiciles;
    RecyclerView.LayoutManager layoutManager;
    DomicilesCustomAdapter adapter;

    AppCompatActivity appCompatActivity;
    public DomicilesFragment() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        view0 =inflater.inflate(R.layout.fragment_domiciles, container, false);
        initRecyclerView();
        // Inflate the layout for this fragment
        FloatingActionButton fab =view0.findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                goToRegisterActivity();
            }
        });
        return view0;
    }
    private void initRecyclerView() {
        rvDomiciles=(ShimmerRecyclerView)view0.findViewById(R.id.rvDomiciles);
        rvDomiciles.showShimmerAdapter();
        rvDomiciles.setHasFixedSize(true);
        layoutManager=new LinearLayoutManager(getActivity());
        rvDomiciles.setLayoutManager(layoutManager);
    }
    public void goToRegisterActivity(){
        Intent intent=new Intent(appCompatActivity, RegisterDomicileActivity.class);
        startActivity(intent);
    }
    public void implementRecyclerView(DomicilesResponse domicilesResponse){
        adapter=new DomicilesCustomAdapter(appCompatActivity, domicilesResponse.domiciles, new ClickListener() {
            @Override
            public void onClick(View view, int index) {

            }
        });
        rvDomiciles.setAdapter(adapter);
    }
    public void setActivity(final MainActivity appCompatActivity) {
        this.appCompatActivity=appCompatActivity;
        bookStore=new BookStore(appCompatActivity);
        bookStore.getDomiciles(new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                Gson gson =new Gson();
                DomicilesResponse domicilesResponse=gson.fromJson(response, DomicilesResponse.class);
                Log.d("RESPONSE", response);
                if(domicilesResponse.code.equals("200")){
                    implementRecyclerView(domicilesResponse);
                }else{
                    Toast.makeText(appCompatActivity, "You don't have domiciles registered", Toast.LENGTH_SHORT).show();

                }
            }
        });
    }
}
