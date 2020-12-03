package com.iramml.bookstore.app.fragment;

import android.app.AlertDialog;
import android.content.Intent;
import android.os.Bundle;
import androidx.annotation.NonNull;
import androidx.annotation.Nullable;

import com.android.volley.VolleyError;
import com.google.android.material.bottomsheet.BottomSheetDialogFragment;
import androidx.appcompat.app.AppCompatActivity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;

import com.google.gson.Gson;
import com.iramml.bookstore.app.activity.HomeActivity;
import com.iramml.bookstore.app.api.BookStoreAPI;
import com.iramml.bookstore.app.R;
import com.iramml.bookstore.app.interfaces.HttpResponse;
import com.iramml.bookstore.app.model.GenericResponse;

import java.util.HashMap;
import java.util.Map;

import dmax.dialog.SpotsDialog;

public class BottomSheetBuyPDF extends BottomSheetDialogFragment {
    private View root;
    private Button btnBuy;

    public String mTag, bookID, title;
    private BookStoreAPI bookStoreAPI;

    public static BottomSheetBuyPDF newInstance(String tag, String id, String title) {
        BottomSheetBuyPDF fragment = new BottomSheetBuyPDF();
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
        root = inflater.inflate(R.layout.bottom_sheet_buy_pdf, container, false);
        bookStoreAPI=new BookStoreAPI(getActivity());
        intiViews();
        initListeners();
        return root;
    }

    private void intiViews(){
        btnBuy=root.findViewById(R.id.btnBuy);
    }

    private void initListeners(){
        btnBuy.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                buyBook();
            }
        });
    }

    private void buyBook() {
        final AlertDialog waitingDialog = new SpotsDialog.Builder().setContext(getActivity()).build();
        waitingDialog.show();
        Map<String, String> postMap = new HashMap<>();
        postMap.put("is_pdf", "1");
        postMap.put("book_id", bookID);
        bookStoreAPI.buyPDF(postMap, new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                waitingDialog.dismiss();
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
                waitingDialog.dismiss();
            }
        });
    }

}