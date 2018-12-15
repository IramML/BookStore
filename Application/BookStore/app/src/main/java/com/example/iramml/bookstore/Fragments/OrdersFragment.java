package com.example.iramml.bookstore.Fragments;


import android.Manifest;
import android.os.Bundle;
import android.os.Environment;
import android.support.v4.app.Fragment;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.HurlStack;
import com.android.volley.toolbox.Volley;
import com.cooltechworks.views.shimmer.ShimmerRecyclerView;
import com.example.iramml.bookstore.Activities.MainActivity;
import com.example.iramml.bookstore.BookStoreApi.BookStore;
import com.example.iramml.bookstore.Interfaces.HttpResponse;
import com.example.iramml.bookstore.Model.BooksResponse;
import com.example.iramml.bookstore.R;
import com.example.iramml.bookstore.RecyclerViewBooks.BooksCustomAdapter;
import com.example.iramml.bookstore.RecyclerViewBooks.ClickListener;
import com.example.iramml.bookstore.Util.InputStreamVolleyRequest;
import com.google.gson.Gson;
import com.karumi.dexter.Dexter;
import com.karumi.dexter.MultiplePermissionsReport;
import com.karumi.dexter.PermissionToken;
import com.karumi.dexter.listener.PermissionRequest;
import com.karumi.dexter.listener.multi.MultiplePermissionsListener;

import java.io.File;
import java.io.FileOutputStream;
import java.util.List;

/**
 * A simple {@link Fragment} subclass.
 */
public class OrdersFragment extends Fragment {
    View view0;
    BookStore bookStore;

    ShimmerRecyclerView rvOrders;
    RecyclerView.LayoutManager layoutManager;
    BooksCustomAdapter adapter;

    AppCompatActivity appCompatActivity;

    int count;
    public OrdersFragment() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        view0=inflater.inflate(R.layout.fragment_orders, container, false);
        initRecyclerView();
        return view0;
    }
    public void setActivity(final MainActivity appCompatActivity) {
        this.appCompatActivity = appCompatActivity;
        bookStore = new BookStore(appCompatActivity);
        bookStore.getOrders(new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                Gson gson=new Gson();
                Log.d("RESPONSE", response);
                BooksResponse booksObject=gson.fromJson(response, BooksResponse.class);
                implementRecyclerView(booksObject);
            }
        });
    }
    private void initRecyclerView() {
        rvOrders=(ShimmerRecyclerView)view0.findViewById(R.id.rvOrders);
        rvOrders.showShimmerAdapter();
        rvOrders.setHasFixedSize(true);
        layoutManager=new LinearLayoutManager(getActivity());
        rvOrders.setLayoutManager(layoutManager);
    }
    public void implementRecyclerView(final BooksResponse booksObject){
        adapter=new BooksCustomAdapter(appCompatActivity, booksObject.books, new ClickListener() {
            @Override
            public void onClick(View view, final int index) {
                if(booksObject.books.get(index).is_pdf.equals("yes")){
                    Dexter.withActivity(appCompatActivity).withPermissions(Manifest.permission.READ_EXTERNAL_STORAGE,
                            Manifest.permission.WRITE_EXTERNAL_STORAGE).withListener(new MultiplePermissionsListener(){
                        @Override
                        public void onPermissionsChecked(MultiplePermissionsReport report) {

                            String URL_BASE="http://192.168.0.17/bookstore/api/";
                            String section="books/";
                            String method="download.php?";
                            String parameters="id="+booksObject.books.get(index).id;
                            String url=URL_BASE+section+method+parameters;
                            Log.d("URL_PDF", url);
                            downloadFile(url, booksObject.books.get(index).title);
                        }

                        @Override
                        public void onPermissionRationaleShouldBeShown(List<PermissionRequest> permissions, PermissionToken token) {

                        }
                    }).check();

                }else{
                    Toast.makeText(appCompatActivity,"Not pdf", Toast.LENGTH_SHORT).show();
                }
            }
        });
        rvOrders.setAdapter(adapter);
    }
    private void downloadFile(String url, final String pdfName) {
        InputStreamVolleyRequest request = new InputStreamVolleyRequest(Request.Method.GET, url,
                new Response.Listener<byte[]>() {
                    @Override
                    public void onResponse(byte[] response) {
                        try {
                            if (response!=null) {
                                String name=pdfName+".pdf";

                                File dir = new File (Environment.getExternalStorageDirectory().getAbsolutePath() + "/directory1/directory2/");
                                dir.mkdirs();

                                File videoFile = new File(dir.getAbsoluteFile()+"/"+name);

                                FileOutputStream stream = new FileOutputStream(videoFile);

                                try {
                                    stream.write(response);
                                } finally {
                                    stream.close();
                                }
                                Toast.makeText(appCompatActivity, "Download complete.", Toast.LENGTH_LONG).show();

                            }
                        } catch (Exception e) {
                            // TODO Auto-generated catch block
                            Log.d("ERROR!!", "NOT DOWNLOADED");
                            e.printStackTrace();
                        }
                    }
                } ,new Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {
                // TODO handle the error
                error.printStackTrace();
            }
        }, null);
        RequestQueue mRequestQueue = Volley.newRequestQueue(appCompatActivity, new HurlStack());
        mRequestQueue.add(request);
    }

}
