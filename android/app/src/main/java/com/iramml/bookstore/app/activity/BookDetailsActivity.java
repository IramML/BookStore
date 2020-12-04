package com.iramml.bookstore.app.activity;

import androidx.appcompat.app.ActionBar;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import com.android.volley.VolleyError;
import com.google.gson.Gson;
import com.iramml.bookstore.app.R;
import com.iramml.bookstore.app.api.BookStoreAPI;
import com.iramml.bookstore.app.fragment.BottomSheetBuyPDF;
import com.iramml.bookstore.app.fragment.BottomSheetBuyPhysic;
import com.iramml.bookstore.app.listener.HttpResponseListener;
import com.iramml.bookstore.app.model.Book;
import com.iramml.bookstore.app.model.BookDetailResponse;
import com.squareup.picasso.Picasso;

public class BookDetailsActivity extends AppCompatActivity {
    private ImageView ivBook;
    private TextView tvBookName, tvCategoryName, tvPrice, tvDescription;
    private Button btnBuyPDFBook, btnBuyPhysical;

    private BottomSheetBuyPDF bottomSheetBuyPDF;
    private BottomSheetBuyPhysic bottomSheetBuyPhysic;

    private BookStoreAPI bookStoreAPI;

    private String bookID;
    private Book bookDetails;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_book_details);
        bookStoreAPI = new BookStoreAPI(this);
        initViews();
        initListeners();
        initToolbar();

        if (getIntent().getExtras() != null) {
            bookID = getIntent().getStringExtra("book_id");
        } else
            finish();

        getProductDetails();
    }

    private void initViews() {
        ivBook = findViewById(R.id.iv_book);
        tvBookName = findViewById(R.id.tv_book_name);
        tvCategoryName = findViewById(R.id.tv_category_name);
        tvPrice = findViewById(R.id.tv_price);
        tvDescription = findViewById(R.id.tv_description);
        btnBuyPhysical = findViewById(R.id.btn_buy_physical);
        btnBuyPDFBook = findViewById(R.id.btn_buy_pdf);
    }

    private void initListeners(){
        btnBuyPhysical.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                buyPhysicalBook();
            }
        });
        btnBuyPDFBook.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                buyPDFBook();
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

    private void getProductDetails() {
        bookStoreAPI.getBookDetailsByID(bookID, new HttpResponseListener() {
            @Override
            public void httpResponseSuccess(String response) {
                Gson gson = new Gson();
                BookDetailResponse responseObject = gson.fromJson(response, BookDetailResponse.class);

                if (responseObject.getCode().equals("200")) {
                    bookDetails = responseObject.getBook();
                    setDetails();
                }
            }

            @Override
            public void httpResponseError(VolleyError error) {

            }
        });
    }

    private void setDetails() {
        Picasso.get().load(bookDetails.getImageURL()).placeholder(R.drawable.placeholder).into(ivBook);

        tvBookName.setText(bookDetails.getTitle());
        tvCategoryName.setText(bookDetails.getCategory_name());
        tvPrice.setText(String.format("$%s", bookDetails.getCost()));
        tvDescription.setText(bookDetails.getDescription());

        if (bookDetails.getPdf() != null && !bookDetails.getPdf().equals(""))
            btnBuyPDFBook.setVisibility(View.VISIBLE);

        int stock = Integer.parseInt(bookDetails.getStock());
        if (stock > 0)
            btnBuyPhysical.setVisibility(View.VISIBLE);

        bottomSheetBuyPDF = BottomSheetBuyPDF.newInstance("PDF bottom sheet", bookID, bookDetails.getTitle(), bookDetails.getBookPDFURL());
        bottomSheetBuyPhysic = BottomSheetBuyPhysic.newInstance("Physic bottom sheet", bookID, bookDetails.getTitle());
    }

    private void buyPDFBook() {
        bottomSheetBuyPDF.show(getSupportFragmentManager(), bottomSheetBuyPDF.mTag);
    }

    private void buyPhysicalBook() {
        bottomSheetBuyPhysic.show(getSupportFragmentManager(), bottomSheetBuyPhysic.mTag);
    }
}