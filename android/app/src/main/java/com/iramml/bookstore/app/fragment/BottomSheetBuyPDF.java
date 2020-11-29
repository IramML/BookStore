package com.iramml.bookstore.app.fragment;

import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.design.widget.BottomSheetDialogFragment;
import android.support.v7.app.AppCompatActivity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;

import com.iramml.bookstore.app.api.BookStoreAPI;
import com.iramml.bookstore.app.R;

public class BottomSheetBuyPDF extends BottomSheetDialogFragment {
    private View root;
    private Button btnBuy;

    String mTag, bookID, title;
    BookStoreAPI bookStore;

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
        bookID = getArguments().getString("title");
        title = getArguments().getString("id");
    }

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        root = inflater.inflate(R.layout.bottom_sheet_buy_pdf, container, false);
        bookStore=new BookStoreAPI(getActivity());
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
                //bookStore.buyPDF(Id, title);
                //TODO: hide BSFragment
            }
        });
    }



}