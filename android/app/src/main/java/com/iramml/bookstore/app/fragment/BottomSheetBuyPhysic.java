package com.iramml.bookstore.app.fragment;

import android.content.Intent;
import android.os.Bundle;
import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import com.google.android.material.bottomsheet.BottomSheetDialogFragment;

import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.android.volley.VolleyError;
import com.cooltechworks.views.shimmer.ShimmerRecyclerView;
import com.iramml.bookstore.app.activity.HomeActivity;
import com.iramml.bookstore.app.api.BookStoreAPI;
import com.iramml.bookstore.app.listener.HttpResponseListener;
import com.iramml.bookstore.app.model.Domicile;
import com.iramml.bookstore.app.model.DomicilesResponse;
import com.iramml.bookstore.app.R;
import com.iramml.bookstore.app.adapter.rvdomiciles.ClickListener;
import com.iramml.bookstore.app.adapter.rvdomiciles.DomicilesCustomAdapter;
import com.google.gson.Gson;
import com.iramml.bookstore.app.model.GenericResponse;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class BottomSheetBuyPhysic extends BottomSheetDialogFragment {
    private View root;
    private ShimmerRecyclerView rvDomiciles;

    private RecyclerView.LayoutManager layoutManager;
    private DomicilesCustomAdapter adapter;

    private BookStoreAPI bookStoreAPI;

    public String mTag, bookID, title;


    public static BottomSheetBuyPhysic newInstance(String tag, String id, String title) {
        BottomSheetBuyPhysic fragment = new BottomSheetBuyPhysic();
        Bundle args = new Bundle();
        args.putString("TAG", tag);
        args.putString("title", title);
        args.putString("id", id);
        fragment.setArguments(args);
        return fragment;
    }

    @Override
    public void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        mTag = getArguments().getString("TAG");
        bookID = getArguments().getString("id");
        title = getArguments().getString("title");
    }

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        root = inflater.inflate(R.layout.bottom_sheet_buy_physic, container, false);
        initRecyclerView();
        bookStoreAPI = new BookStoreAPI(getActivity());
        bookStoreAPI.getDomiciles(new HttpResponseListener() {
            @Override
            public void httpResponseSuccess(String response) {
                Gson gson = new Gson();
                DomicilesResponse domicilesResponse = gson.fromJson(response, DomicilesResponse.class);
                Log.d("RESPONSE", response);
                if(domicilesResponse.getCode().equals("200")){
                    implementRecyclerView(domicilesResponse.getDomiciles());
                }else{
                    Toast.makeText(getActivity(), "You don't have domiciles registered", Toast.LENGTH_SHORT).show();

                }
            }

            @Override
            public void httpResponseError(VolleyError error) {

            }
        });
        return root;
    }

    private void initRecyclerView() {
        rvDomiciles = (ShimmerRecyclerView) root.findViewById(R.id.rvDomiciles);
        rvDomiciles.showShimmerAdapter();
        rvDomiciles.setHasFixedSize(true);
        layoutManager=new LinearLayoutManager(getActivity());
        rvDomiciles.setLayoutManager(layoutManager);
    }

    public void implementRecyclerView(final ArrayList<Domicile> domiciles){
        adapter=new DomicilesCustomAdapter(getActivity(), domiciles, new ClickListener() {
            @Override
            public void onClick(View view, int index) {
                buyBook(domiciles.get(index).getId());
            }
        });
        rvDomiciles.setAdapter(adapter);
    }


    private void buyBook(String domicileID) {
        Map<String, String> postMap = new HashMap<>();
        postMap.put("is_pdf", "0");
        postMap.put("book_id", bookID);
        postMap.put("domicile_id", domicileID);
        bookStoreAPI.buyPDF(postMap, new HttpResponseListener() {
            @Override
            public void httpResponseSuccess(String response) {
                Gson gson = new Gson();
                GenericResponse responseObject = gson.fromJson(response, GenericResponse.class);

                if (responseObject.getCode().equals("200")) {
                    Intent intent = new Intent(getActivity(), HomeActivity.class);
                    intent.putExtra("itemSelected", 1);
                    startActivity(intent);
                }
            }

            @Override
            public void httpResponseError(VolleyError error) {

            }
        });
    }
}