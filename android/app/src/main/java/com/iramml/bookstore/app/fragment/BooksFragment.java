package com.iramml.bookstore.app.fragment;


import android.os.Bundle;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.android.volley.VolleyError;
import com.cooltechworks.views.shimmer.ShimmerRecyclerView;
import com.iramml.bookstore.app.api.BookStoreAPI;
import com.iramml.bookstore.app.interfaces.HttpResponse;
import com.iramml.bookstore.app.model.Book;
import com.iramml.bookstore.app.model.BooksResponse;
import com.iramml.bookstore.app.R;
import com.iramml.bookstore.app.adapter.rvbooks.BooksCustomAdapter;
import com.iramml.bookstore.app.adapter.rvbooks.ClickListener;
import com.google.gson.Gson;

import java.util.ArrayList;

public class BooksFragment extends Fragment {
    private View root;
    private ShimmerRecyclerView rvBooks;
    private SwipeRefreshLayout swipeRefreshLayout;

    private RecyclerView.LayoutManager layoutManager;
    private BooksCustomAdapter adapter;

    /*
    private BottomSheetBuyPDF bottomSheetBuyPDF;
    private BottomSheetBuyPhysic bottomSheetBuyPhysic;
    */

    private BookStoreAPI bookStore;


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
        root = inflater.inflate(R.layout.fragment_books, container, false);
        bookStore = new BookStoreAPI(getActivity());
        initViews();
        initRecyclerView();
        initListeners();
        getBooks();
        return root;
    }

    private void initListeners() {
        swipeRefreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                initRecyclerView();
                getBooks();
            }
        });
    }

    private void initViews() {
        /*bottomSheetBuyPDF = BottomSheetBuyPDF.newInstance("PDF bottom sheet");
        bottomSheetBuyPhysic = BottomSheetBuyPhysic.newInstance("Physic bottom sheet");*/
        swipeRefreshLayout = root.findViewById(R.id.swipeToRefresh);
    }
    /*
    public void hideBottomSheet(){
        if(bottomSheetBuyPhysic.isVisible()) bottomSheetBuyPhysic.dismiss();
        else bottomSheetBuyPDF.dismiss();
    }
     */

    private void initRecyclerView() {
        rvBooks = (ShimmerRecyclerView) root.findViewById(R.id.rvBooks);
        rvBooks.showShimmerAdapter();
        rvBooks.setHasFixedSize(true);
        layoutManager = new LinearLayoutManager(getActivity());
        rvBooks.setLayoutManager(layoutManager);
    }

    private void getBooks2(){
        /*bookStore.getBooks(new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                Gson gson=new Gson();
                Log.d("RESPONSE", books);
                BooksResponse booksObject=gson.fromJson(books, BooksResponse.class);
                if(booksObject.code.equals("200"))
                    implementRecyclerView(booksObject);
                else
                    Toast.makeText(appCompatActivity, "There are no books", Toast.LENGTH_SHORT).show();
            }

            @Override
            public void httpResponseError(VolleyError error) {

            }
        });*/
    }

    private void getBooks(){
        bookStore.getBooks(new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                Gson gson=new Gson();
                Log.d("RESPONSE", response);
                BooksResponse responseObject = gson.fromJson(response, BooksResponse.class);
                if(responseObject.getCode().equals("200")){
                    implementRecyclerView(responseObject.getBooks());
                    swipeRefreshLayout.setRefreshing(false);
                }



            }

            @Override
            public void httpResponseError(VolleyError error) {

            }
        });
    }

    public void implementRecyclerView(final ArrayList<Book> books){
        adapter=new BooksCustomAdapter(getActivity(), books, new ClickListener() {
            @Override
            public void onClick(View view, int index) {

                    /*
                    bottomSheetBuyPDF.setActivity(getActivity(), books.get(index).title, books.get(index).id, BooksFragment.this);
                    bottomSheetBuyPDF.show(getFragmentManager(), bottomSheetBuyPDF.mTag);
                    */

                    /*
                    bottomSheetBuyPhysic.setActivity(getActivity(), BooksFragment.this);
                    bottomSheetBuyPhysic.show(getFragmentManager(), bottomSheetBuyPhysic.mTag);
                     */

            }
        });
        rvBooks.setAdapter(adapter);
    }
}
