package com.iramml.bookstore.app.activity;

import androidx.appcompat.app.ActionBar;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import android.Manifest;
import android.app.DownloadManager;
import android.content.Context;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import android.os.Environment;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.VolleyError;
import com.google.gson.Gson;
import com.iramml.bookstore.app.R;
import com.iramml.bookstore.app.api.BookStoreAPI;
import com.iramml.bookstore.app.fragment.BottomSheetBuyPDF;
import com.iramml.bookstore.app.fragment.BottomSheetBuyPhysic;
import com.iramml.bookstore.app.listener.HttpResponseListener;
import com.iramml.bookstore.app.model.Book;
import com.iramml.bookstore.app.model.BookDetailResponse;
import com.iramml.bookstore.app.model.Order;
import com.iramml.bookstore.app.model.OrderDetailResponse;
import com.iramml.bookstore.app.model.OrdersResponse;
import com.karumi.dexter.Dexter;
import com.karumi.dexter.MultiplePermissionsReport;
import com.karumi.dexter.PermissionToken;
import com.karumi.dexter.listener.PermissionRequest;
import com.karumi.dexter.listener.multi.MultiplePermissionsListener;
import com.squareup.picasso.Picasso;

import java.util.List;

public class OrderDetailActivity extends AppCompatActivity {
    private ImageView ivBook;
    private TextView tvBookName, tvCategoryName, tvPrice, tvDescription;
    private Button btnDownloadPDFBook;

    private BookStoreAPI bookStoreAPI;

    private String orderID;
    private Order orderDetails;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_order_detail);
        bookStoreAPI = new BookStoreAPI(this);
        initViews();
        initListeners();
        initToolbar();

        if (getIntent().getExtras() != null) {
            orderID = getIntent().getStringExtra("order_id");
        } else
            finish();

        getOrderDetails();
    }

    private void initViews() {
        ivBook = findViewById(R.id.iv_book);
        tvBookName = findViewById(R.id.tv_book_name);
        tvCategoryName = findViewById(R.id.tv_category_name);
        tvPrice = findViewById(R.id.tv_price);
        tvDescription = findViewById(R.id.tv_description);
        btnDownloadPDFBook = findViewById(R.id.btn_download_pdf);
    }

    private void initListeners(){
        btnDownloadPDFBook.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Dexter.withContext(OrderDetailActivity.this).withPermissions(Manifest.permission.READ_EXTERNAL_STORAGE,
                        Manifest.permission.WRITE_EXTERNAL_STORAGE).withListener(new MultiplePermissionsListener(){
                    @Override
                    public void onPermissionsChecked(MultiplePermissionsReport report) {
                        downloadPDF();
                    }
                    @Override
                    public void onPermissionRationaleShouldBeShown(List<PermissionRequest> permissions, PermissionToken token) {

                    }
                }).check();

            }
        });
    }

    private void initToolbar() {
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        toolbar.setTitle("Details");
        ActionBar actionBar = getSupportActionBar();
        if (actionBar != null){
            actionBar.setTitle("Details");
            actionBar.setDisplayHomeAsUpEnabled(true);
        }

    }

    private void getOrderDetails() {
        bookStoreAPI.getOrderDetails(orderID, new HttpResponseListener() {
            @Override
            public void httpResponseSuccess(String response) {
                Gson gson = new Gson();
                OrderDetailResponse responseObject = gson.fromJson(response, OrderDetailResponse.class);

                if (responseObject.getCode().equals("200")) {
                    orderDetails = responseObject.getOrder();
                    setDetails();
                }
            }

            @Override
            public void httpResponseError(VolleyError error) {

            }
        });
    }

    private void setDetails() {
        Picasso.get().load(orderDetails.getBookImageURL()).placeholder(R.drawable.placeholder).into(ivBook);

        tvBookName.setText(orderDetails.getTitle());
        tvCategoryName.setText(orderDetails.getCategory_name());
        tvPrice.setText(String.format("$%s", orderDetails.getCost()));
        tvDescription.setText(orderDetails.getDescription());

        if (orderDetails.getIs_pdf().equals("1"))
            btnDownloadPDFBook.setVisibility(View.VISIBLE);

    }

    private void downloadPDF() {
        Toast.makeText(this, getString(R.string.downloading_book), Toast.LENGTH_SHORT).show();
        String url = orderDetails.getBookPDFURL();
        DownloadManager.Request request = new DownloadManager.Request(Uri.parse(url));
        request.setTitle(getString(R.string.downloading_book));
        request.setDescription(orderDetails.getTitle() + ".pdf");
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.HONEYCOMB) {
            request.allowScanningByMediaScanner();
            request.setNotificationVisibility(DownloadManager.Request.VISIBILITY_VISIBLE_NOTIFY_COMPLETED);
        }
        request.setDestinationInExternalPublicDir(Environment.DIRECTORY_DOWNLOADS, orderDetails.getTitle() + ".pdf");

        DownloadManager manager = (DownloadManager) getSystemService(Context.DOWNLOAD_SERVICE);
        manager.enqueue(request);
    }
}