package com.iramml.bookstore.app.fragment;


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

import com.android.volley.VolleyError;
import com.cooltechworks.views.shimmer.ShimmerRecyclerView;
import com.iramml.bookstore.app.activity.HomeActivity;
import com.iramml.bookstore.app.activity.RegisterDomicileActivity;
import com.iramml.bookstore.app.api.BookStoreAPI;
import com.iramml.bookstore.app.interfaces.HttpResponse;
import com.iramml.bookstore.app.model.DomicilesResponse;
import com.iramml.bookstore.app.R;
import com.iramml.bookstore.app.adapter.rvdomiciles.ClickListener;
import com.iramml.bookstore.app.adapter.rvdomiciles.DomicilesCustomAdapter;
import com.google.gson.Gson;

public class DomicilesFragment extends Fragment {
    private View root;
    private FloatingActionButton fab;
    private ShimmerRecyclerView rvDomiciles;

    private RecyclerView.LayoutManager layoutManager;
    private DomicilesCustomAdapter adapter;

    private BookStoreAPI bookStore;

    public DomicilesFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        root = inflater.inflate(R.layout.fragment_domiciles, container, false);
        bookStore = new BookStoreAPI(getActivity());
        initViews();
        initListeners();
        getDomiciles();

        return root;
    }

    private void initViews() {
        fab = root.findViewById(R.id.fab);
        rvDomiciles = (ShimmerRecyclerView) root.findViewById(R.id.rvDomiciles);
        rvDomiciles.showShimmerAdapter();
        rvDomiciles.setHasFixedSize(true);
        layoutManager = new LinearLayoutManager(getActivity());
        rvDomiciles.setLayoutManager(layoutManager);
    }

    private void initListeners(){
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                goToRegisterActivity();
            }
        });
    }

    private void getDomiciles() {
        bookStore.getDomiciles(new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                Gson gson = new Gson();
                DomicilesResponse domicilesResponse = gson.fromJson(response, DomicilesResponse.class);
                Log.d("RESPONSE", response);
                if(domicilesResponse.code.equals("200")){
                    implementRecyclerView(domicilesResponse);
                }else{
                    Toast.makeText(getActivity(), "You don't have domiciles registered", Toast.LENGTH_SHORT).show();

                }
            }

            @Override
            public void httpResponseError(VolleyError error) {

            }
        });
    }


    public void goToRegisterActivity(){
        Intent intent = new Intent(getActivity(), RegisterDomicileActivity.class);
        startActivity(intent);
    }

    public void implementRecyclerView(DomicilesResponse domicilesResponse){
        adapter = new DomicilesCustomAdapter(getActivity(), domicilesResponse.domiciles, new ClickListener() {
            @Override
            public void onClick(View view, int index) {

            }
        });
        rvDomiciles.setAdapter(adapter);
    }
}
