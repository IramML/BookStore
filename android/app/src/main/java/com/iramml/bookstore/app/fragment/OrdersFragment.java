package com.iramml.bookstore.app.fragment;


import android.content.Intent;
import android.os.Bundle;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.android.volley.VolleyError;
import com.cooltechworks.views.shimmer.ShimmerRecyclerView;
import com.iramml.bookstore.app.activity.OrderDetailActivity;
import com.iramml.bookstore.app.adapter.rvorders.ClickListener;
import com.iramml.bookstore.app.adapter.rvorders.OrdersCustomAdapter;
import com.iramml.bookstore.app.api.BookStoreAPI;
import com.iramml.bookstore.app.listener.HttpResponseListener;
import com.iramml.bookstore.app.R;
import com.google.gson.Gson;
import com.iramml.bookstore.app.model.Order;
import com.iramml.bookstore.app.model.OrdersResponse;

import java.util.ArrayList;

public class OrdersFragment extends Fragment {
    private View root;
    private ShimmerRecyclerView rvOrders;

    private BookStoreAPI bookStore;

    public OrdersFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        root = inflater.inflate(R.layout.fragment_orders, container, false);
        bookStore = new BookStoreAPI(getActivity());
        initViews();
        getOrders();
        return root;
    }

    private void initViews() {
        rvOrders = (ShimmerRecyclerView) root.findViewById(R.id.rvOrders);
        rvOrders.showShimmerAdapter();
        rvOrders.setHasFixedSize(true);
        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(getActivity());
        rvOrders.setLayoutManager(layoutManager);
    }

    private void getOrders() {
        bookStore.getOrders(new HttpResponseListener() {
            @Override
            public void httpResponseSuccess(String response) {
                Gson gson = new Gson();
                OrdersResponse responseObject = gson.fromJson(response, OrdersResponse.class);
                if (responseObject.getCode().equals("200")) {
                    implementRecyclerView(responseObject.getOrders());
                } else {
                    Toast.makeText(getActivity(), "You have not bought any books", Toast.LENGTH_SHORT).show();
                    rvOrders.hideShimmerAdapter();
                }
            }

            @Override
            public void httpResponseError(VolleyError error) {

            }
        });
    }

    public void implementRecyclerView(final ArrayList<Order> orders){
        OrdersCustomAdapter adapter = new OrdersCustomAdapter(getActivity(), orders, new ClickListener() {
            @Override
            public void onClick(View view, int index) {
                Intent intent = new Intent(getActivity(), OrderDetailActivity.class);
                intent.putExtra("order_id", orders.get(index).getOrder_id());
                startActivity(intent);
            }
        });
        rvOrders.setAdapter(adapter);
    }

}
