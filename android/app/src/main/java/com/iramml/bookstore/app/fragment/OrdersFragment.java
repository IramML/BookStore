package com.iramml.bookstore.app.fragment;


import android.Manifest;
import android.os.Bundle;
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
import com.iramml.bookstore.app.api.BookStoreAPI;
import com.iramml.bookstore.app.interfaces.HttpResponse;
import com.iramml.bookstore.app.model.Book;
import com.iramml.bookstore.app.model.BooksResponse;
import com.iramml.bookstore.app.R;
import com.iramml.bookstore.app.adapter.rvbooks.BooksCustomAdapter;
import com.iramml.bookstore.app.adapter.rvbooks.ClickListener;
import com.google.gson.Gson;
import com.karumi.dexter.Dexter;
import com.karumi.dexter.MultiplePermissionsReport;
import com.karumi.dexter.PermissionToken;
import com.karumi.dexter.listener.PermissionRequest;
import com.karumi.dexter.listener.multi.MultiplePermissionsListener;

import java.util.ArrayList;
import java.util.List;

/**
 * A simple {@link Fragment} subclass.
 */
public class OrdersFragment extends Fragment {
    private View root;
    private ShimmerRecyclerView rvOrders;

    private RecyclerView.LayoutManager layoutManager;
    private BooksCustomAdapter adapter;

    private BookStoreAPI bookStore;

    int count;

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
        rvOrders = (ShimmerRecyclerView)root.findViewById(R.id.rvOrders);
        rvOrders.showShimmerAdapter();
        rvOrders.setHasFixedSize(true);
        layoutManager = new LinearLayoutManager(getActivity());
        rvOrders.setLayoutManager(layoutManager);
    }

    private void getOrders() {
        bookStore.getOrders(new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                Gson gson = new Gson();
                BooksResponse booksObject = gson.fromJson(response, BooksResponse.class);
                if(booksObject.getCode().equals("200"))
                    implementRecyclerView(booksObject.getBooks());
                else
                    Toast.makeText(getActivity(), "You have not bought any books", Toast.LENGTH_SHORT).show();
            }

            @Override
            public void httpResponseError(VolleyError error) {

            }
        });
    }

    public void implementRecyclerView(final ArrayList<Book> books){
        adapter=new BooksCustomAdapter(getActivity(), books, new ClickListener() {
            @Override
            public void onClick(View view, final int index) {
                /*if(books.get(index).is_pdf.equals("yes")){
                    Dexter.withActivity(getActivity()).withPermissions(Manifest.permission.READ_EXTERNAL_STORAGE,
                            Manifest.permission.WRITE_EXTERNAL_STORAGE).withListener(new MultiplePermissionsListener(){
                        @Override
                        public void onPermissionsChecked(MultiplePermissionsReport report) {

                            //bookStore.downloadPDF(booksObject.books.get(index).id, booksObject.books.get(index).title);
                        }
                        @Override
                        public void onPermissionRationaleShouldBeShown(List<PermissionRequest> permissions, PermissionToken token) {

                        }
                    }).check();

                }*/
            }
        });
        rvOrders.setAdapter(adapter);
    }

}
