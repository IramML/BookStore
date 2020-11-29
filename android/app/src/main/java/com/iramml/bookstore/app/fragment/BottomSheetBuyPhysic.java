package com.iramml.bookstore.app.fragment;

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

import com.android.volley.VolleyError;
import com.cooltechworks.views.shimmer.ShimmerRecyclerView;
import com.iramml.bookstore.app.api.BookStoreAPI;
import com.iramml.bookstore.app.interfaces.HttpResponse;
import com.iramml.bookstore.app.model.DomicilesResponse;
import com.iramml.bookstore.app.R;
import com.iramml.bookstore.app.adapter.rvdomiciles.ClickListener;
import com.iramml.bookstore.app.adapter.rvdomiciles.DomicilesCustomAdapter;
import com.google.gson.Gson;

public class BottomSheetBuyPhysic extends BottomSheetDialogFragment {
    String mTag;
    View view0;
    ShimmerRecyclerView rvDomiciles;
    RecyclerView.LayoutManager layoutManager;
    DomicilesCustomAdapter adapter;
    BookStoreAPI bookStore;
    AppCompatActivity appCompatActivity;
    BooksFragment booksFragment;

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
    public void setActivity(AppCompatActivity activity, BooksFragment booksFragment){
        this.booksFragment=booksFragment;
        this.appCompatActivity=activity;
        bookStore=new BookStoreAPI(appCompatActivity);
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

            @Override
            public void httpResponseError(VolleyError error) {

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
                // TODO: hide BSDialog
            }
        });
        rvDomiciles.setAdapter(adapter);
    }
}