package com.iramml.bookstore.app.fragment;

import android.app.AlertDialog;
import android.app.DownloadManager;
import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import androidx.annotation.NonNull;
import androidx.annotation.Nullable;

import com.android.volley.VolleyError;
import com.google.android.material.bottomsheet.BottomSheetDialogFragment;

import android.os.Environment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.Toast;

import com.google.gson.Gson;
import com.iramml.bookstore.app.activity.HomeActivity;
import com.iramml.bookstore.app.api.BookStoreAPI;
import com.iramml.bookstore.app.R;
import com.iramml.bookstore.app.listener.HttpResponseListener;
import com.iramml.bookstore.app.model.GenericResponse;

import java.util.HashMap;
import java.util.Map;

import dmax.dialog.SpotsDialog;

public class BottomSheetBuyPDF extends BottomSheetDialogFragment {
    private View root;
    private Button btnBuy;

    public String mTag, bookID, title, pdfURL;
    private BookStoreAPI bookStoreAPI;

    public static BottomSheetBuyPDF newInstance(String tag, String id, String title, String pdfURL) {
        BottomSheetBuyPDF fragment = new BottomSheetBuyPDF();
        Bundle args = new Bundle();
        args.putString("TAG", tag);
        args.putString("title", title);
        args.putString("id", id);
        args.putString("pdf_url", pdfURL);
        fragment.setArguments(args);
        return fragment;
    }

    @Override
    public void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        mTag = getArguments().getString("TAG");
        bookID = getArguments().getString("id");
        title = getArguments().getString("title");
        pdfURL = getArguments().getString("pdf_url");
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
        bookStoreAPI.buyPDF(postMap, new HttpResponseListener() {
            @Override
            public void httpResponseSuccess(String response) {
                waitingDialog.dismiss();
                Gson gson = new Gson();
                GenericResponse responseObject = gson.fromJson(response, GenericResponse.class);

                if (responseObject.getCode().equals("200")) {
                    downloadPDF();
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

    private void downloadPDF() {
        Toast.makeText(getActivity(), getString(R.string.downloading_book), Toast.LENGTH_SHORT).show();
        String url = pdfURL;
        DownloadManager.Request request = new DownloadManager.Request(Uri.parse(url));
        request.setTitle(getString(R.string.downloading_book));
        request.setDescription(title + ".pdf");
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.HONEYCOMB) {
            request.allowScanningByMediaScanner();
            request.setNotificationVisibility(DownloadManager.Request.VISIBILITY_VISIBLE_NOTIFY_COMPLETED);
        }
        request.setDestinationInExternalPublicDir(Environment.DIRECTORY_DOWNLOADS, title + ".pdf");

        DownloadManager manager = (DownloadManager) getActivity().getSystemService(Context.DOWNLOAD_SERVICE);
        manager.enqueue(request);
    }

}