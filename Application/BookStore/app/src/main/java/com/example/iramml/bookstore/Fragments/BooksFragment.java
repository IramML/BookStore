package com.example.iramml.bookstore.Fragments;


import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.cooltechworks.views.shimmer.ShimmerRecyclerView;
import com.example.iramml.bookstore.BookStoreApi.BookStore;
import com.example.iramml.bookstore.Interfaces.getBooksInterface;
import com.example.iramml.bookstore.Model.BooksResponse;
import com.example.iramml.bookstore.R;
import com.example.iramml.bookstore.RecyclerViewBooks.BooksCustomAdapter;
import com.example.iramml.bookstore.RecyclerViewBooks.ClickListener;
import com.google.gson.Gson;

/**
 * A simple {@link Fragment} subclass.
 */
public class BooksFragment extends Fragment {
    View view0;
    ShimmerRecyclerView rvBooks;
    RecyclerView.LayoutManager layoutManager;
    BooksCustomAdapter adapter;
    BookStore bookStore;
    AppCompatActivity appCompatActivity;
    public BooksFragment() {
        // Required empty public constructor
    }

    @Override
    public void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        view0=inflater.inflate(R.layout.fragment_books, container, false);
        initRecyclerView();
        final SwipeRefreshLayout swipeRefreshLayout=view0.findViewById(R.id.swipeToRefresh);

        swipeRefreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                initRecyclerView();
                bookStore.getBooks(new getBooksInterface() {
                    @Override
                    public void booksGenerated(String books) {
                        Gson gson=new Gson();
                        Log.d("RESPONSE", books);
                        BooksResponse booksObject=gson.fromJson(books, BooksResponse.class);
                        implementRecyclerView(booksObject);
                        swipeRefreshLayout.setRefreshing(false);
                    }
                });
            }
        });
        return view0;
    }
    private void initRecyclerView() {
        rvBooks=(ShimmerRecyclerView)view0.findViewById(R.id.rvBooks);
        rvBooks.showShimmerAdapter();
        rvBooks.setHasFixedSize(true);
        layoutManager=new LinearLayoutManager(getActivity());
        rvBooks.setLayoutManager(layoutManager);
    }
    public void setActivity(AppCompatActivity appCompatActivity){
        this.appCompatActivity=appCompatActivity;
        bookStore=new BookStore(this.appCompatActivity);
        bookStore.getBooks(new getBooksInterface() {
            @Override
            public void booksGenerated(String books) {
                Gson gson=new Gson();
                Log.d("RESPONSE", books);
                BooksResponse booksObject=gson.fromJson(books, BooksResponse.class);
                implementRecyclerView(booksObject);

            }
        });

    }
    public void implementRecyclerView(BooksResponse booksObject){
        adapter=new BooksCustomAdapter(appCompatActivity, booksObject.books, new ClickListener() {
            @Override
            public void onClick(View view, int index) {

            }
        });
        rvBooks.setAdapter(adapter);
    }
}
