package com.example.iramml.bookstore.Fragments;

import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.design.widget.BottomSheetDialogFragment;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.cooltechworks.views.shimmer.ShimmerRecyclerView;
import com.example.iramml.bookstore.BookStoreApi.BookStore;
import com.example.iramml.bookstore.Interfaces.HttpResponse;
import com.example.iramml.bookstore.Model.DomicilesResponse;
import com.example.iramml.bookstore.R;
import com.example.iramml.bookstore.RecyclerViewDomiciles.ClickListener;
import com.example.iramml.bookstore.RecyclerViewDomiciles.DomicilesCustomAdapter;
import com.google.gson.Gson;

public class BottomSheetBuyPhysic extends BottomSheetDialogFragment {
    String mTag;
    View view0;
    ShimmerRecyclerView rvDomiciles;
    RecyclerView.LayoutManager layoutManager;
    DomicilesCustomAdapter adapter;
    BookStore bookStore;
    AppCompatActivity appCompatActivity;
    public static BottomSheetBuyPhysic newInstance(String tag) {
        BottomSheetBuyPhysic fragment = new BottomSheetBuyPhysic();
        Bundle args = new Bundle();
        args.putString("TAG", tag);
        fragment.setArguments(args);
        return fragment;
    }

    @Override
    public void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        mTag = getArguments().getString("TAG");
    }

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        view0 = inflater.inflate(R.layout.bottom_sheet_buy_physic, container, false);
        initRecyclerView();
        return view0;
    }
    public void setActiviti(AppCompatActivity activiti){
        this.appCompatActivity=activiti;
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
    private void initRecyclerView() {
        rvDomiciles=(ShimmerRecyclerView)view0.findViewById(R.id.rvDomiciles);
        rvDomiciles.showShimmerAdapter();
        rvDomiciles.setHasFixedSize(true);
        layoutManager=new LinearLayoutManager(getActivity());
        rvDomiciles.setLayoutManager(layoutManager);
    }
    public void implementRecyclerView(DomicilesResponse domicilesResponse){
        adapter=new DomicilesCustomAdapter(appCompatActivity, domicilesResponse.domiciles, new ClickListener() {
            @Override
            public void onClick(View view, int index) {

            }
        });
        rvDomiciles.setAdapter(adapter);
    }
}