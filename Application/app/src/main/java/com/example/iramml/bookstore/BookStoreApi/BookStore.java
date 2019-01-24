package com.example.iramml.bookstore.BookStoreApi;

import android.content.SharedPreferences;
import android.os.Environment;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.HurlStack;
import com.android.volley.toolbox.Volley;
import com.example.iramml.bookstore.Activities.MainActivity;
import com.example.iramml.bookstore.Interfaces.HttpResponse;
import com.example.iramml.bookstore.Interfaces.getBooksInterface;
import com.example.iramml.bookstore.Interfaces.getTokenInterface;
import com.example.iramml.bookstore.Model.Book;
import com.example.iramml.bookstore.Model.BuyResponse;
import com.example.iramml.bookstore.Model.Domicile;
import com.example.iramml.bookstore.Model.LoginUser;
import com.example.iramml.bookstore.Model.User;
import com.example.iramml.bookstore.Util.InputStreamVolleyRequest;
import com.example.iramml.bookstore.Util.Network;
import com.google.gson.Gson;

import java.io.File;
import java.io.FileOutputStream;
import java.util.HashMap;
import java.util.Map;

public class BookStore {
    Network network;
    AppCompatActivity activity;
    String SETTINGS="settings";
    private String ACCESS_TOKEN="accessToken";
    private String URL_BASE="http://192.168.0.17/bookstore/api/";

    public BookStore(AppCompatActivity activity){
        this.activity=activity;
        this.network=new Network(activity);
    }
    public Boolean saveToken(String token){
        if(token.isEmpty())
            return false;

        SharedPreferences settings=activity.getSharedPreferences(SETTINGS, 0);
        SharedPreferences.Editor editor=settings.edit();
        editor.putString(ACCESS_TOKEN, token);
        editor.apply();
        return true;
    }
    public String getToken(){
        SharedPreferences settings=activity.getSharedPreferences(SETTINGS, 0);
        return settings.getString(ACCESS_TOKEN, "");
    }
    public Boolean tokenAvailable(){
        return getToken()!="";
    }
    public void logout(){
        SharedPreferences settings=activity.getSharedPreferences(SETTINGS, 0);
        SharedPreferences.Editor editor=settings.edit();
        editor.putString(ACCESS_TOKEN, "");

        editor.apply();
    }
    public void registerUser(Map<String, String> postMap, final getTokenInterface getTokenInterface){
        String section="clients/";
        String method="register/";
        String url=URL_BASE+section+method;
        Log.d("URL ",url);
        network.httpPOSTRequest(postMap, url,new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                getTokenInterface.tokenGenerated(response);
            }
        });
    }
    public void login(Map<String, String> postMap, final getTokenInterface getTokenInterface){
        String section="clients/";
        String method="login";
        String url=URL_BASE+section+method;
        Log.d("URL_REQUEST",url);
        network.httpPOSTRequest(postMap, url, new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                Log.d("TOKEN_RES", response);
                getTokenInterface.tokenGenerated(response);
            }
        });
    }
    public void getBooks(final getBooksInterface getBooksInterface){
        String section="books/";
        String method="get/";
        String parameters="?token="+getToken();
        String url=URL_BASE+section+method+parameters;
        Log.d("URL_BOOKS", url);
        network.httpRequest(url, new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                getBooksInterface.booksGenerated(response);
            }
        });
    }
    public void registerDomicile(Domicile domicile, final HttpResponse httpResponse){
      /*
        String section="domiciles/";
        String method="add.php?";
        String url=URL_BASE+section+method;
        network.httpRegisterDomicileRequest(activity, url, getToken(), domicile, new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                httpResponse.httpResponseSuccess(response);
            }
        });*/
    }
    public void getDomiciles(final HttpResponse httpResponse){
        String section="domiciles/";
        String method="get/";
        String parameters="?token="+getToken();
        String url=URL_BASE+section+method+parameters;
        network.httpRequest(url, new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                httpResponse.httpResponseSuccess(response);
            }
        });
    }
    public void getOrders(final HttpResponse httpResponse) {
        String section="orders/";
        String method="get/";
        String parameters="?token="+getToken();
        String url=URL_BASE+section+method+parameters;
        network.httpRequest(url, new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                httpResponse.httpResponseSuccess(response);
            }
        });
    }
    public void downloadPDF(String id, String title){
        String URL_BASE="http://192.168.0.17/bookstore/api/";
        String section="book/";
        String method="download.php?";
        String parameters="id="+id;
        String url=URL_BASE+section+method+parameters;
        Log.d("URL_PDF", url);
        downloadFile(url, title);
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
                                Toast.makeText(activity, "Download complete.", Toast.LENGTH_LONG).show();

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
                error.printStackTrace();
            }
        }, null);
        RequestQueue mRequestQueue = Volley.newRequestQueue(activity, new HurlStack());
        mRequestQueue.add(request);
    }
    public void buyPDF(final String ID, final String title){
        Network network=new Network(activity);
        String section="orders/";
        String method="buyPDF.php";
        String parameters="?token="+getToken()+"&id_book="+ID;
        String url=URL_BASE+section+method+parameters;
        Log.d("URL", url);
        network.httpRequest(url, new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                //Download pdf
                Gson gson=new Gson();
                Log.d("RESPONSE_ORDER", response);
                BuyResponse buyResponse=gson.fromJson(response, BuyResponse.class);
                if(buyResponse.code.equals("200"))
                    downloadPDF(ID, title);
            }
        });
    }
    public void getCurrentUser(final HttpResponse httpResponse){
        Network network=new Network(activity);
        String section="clients/";
        String method="currentUser/?";
        String parameters="token="+getToken();
        String url=URL_BASE+section+method+parameters;
        network.httpRequest(url, new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                httpResponse.httpResponseSuccess(response);
            }
        });
    }
    public void uploadAvatar(Map<String, String> postMap, final HttpResponse httpResponse){
        String section="clients/";
        String method="avatar";
        String url=URL_BASE+section+method;
        Log.d("URL_REQUEST",url);
        network.httpPOSTRequest(postMap, url, new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                httpResponse.httpResponseSuccess(response);
            }
        });
    }
}
