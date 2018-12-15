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

public class BottomSheetBuyPDF extends BottomSheetDialogFragment {
    String mTag;
    View view0;
    AppCompatActivity appCompatActivity;

    public static BottomSheetBuyPDF newInstance(String tag) {
        BottomSheetBuyPDF fragment = new BottomSheetBuyPDF();
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
        view0 = inflater.inflate(R.layout.bottom_sheet_buy_pdf, container, false);

        return view0;
    }
    public void setActiviti(AppCompatActivity activiti){
        this.appCompatActivity=activiti;

    }
}