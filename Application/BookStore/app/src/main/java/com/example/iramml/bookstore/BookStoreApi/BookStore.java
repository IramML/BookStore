package com.example.iramml.bookstore.BookStoreApi;

import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.HurlStack;
import com.android.volley.toolbox.Volley;
import com.example.iramml.bookstore.Activities.MainActivity;
import com.example.iramml.bookstore.Interfaces.HttpResponse;
import com.example.iramml.bookstore.Interfaces.getBooksInterface;
import com.example.iramml.bookstore.Interfaces.getTokenInterface;
import com.example.iramml.bookstore.Model.Domicile;
import com.example.iramml.bookstore.Model.LoginUser;
import com.example.iramml.bookstore.Model.User;
import com.example.iramml.bookstore.Util.InputStreamVolleyRequest;
import com.example.iramml.bookstore.Util.Network;

public class BookStore {
    AppCompatActivity activity;
    String SETTINGS="settings";
    private String ACCESS_TOKEN="accessToken";
    private String URL_BASE="http://192.168.0.17/bookstore/api/";

    public BookStore(AppCompatActivity activity){
        this.activity=activity;
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
    public void registerUser(User user, final getTokenInterface getTokenInterface){
        Network network=new Network(activity);
        String section="clients/";
        String method="register.php?";
        String url=URL_BASE+section+method;
        Log.d("URL ",url);
        network.httpRegisterRequest(activity, url, user,new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                getTokenInterface.tokenGenerated(response);
            }
        });
    }
    public void login(String email, String password, final getTokenInterface getTokenInterface){
        Network network=new Network(activity);
        String section="clients/";
        String method="login.php?";
        String url=URL_BASE+section+method;
        LoginUser loginUser=new LoginUser(email, password);
        network.httpLoginRequest(activity, url, loginUser, new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                getTokenInterface.tokenGenerated(response);
            }
        });
    }
    public void getBooks(final getBooksInterface getBooksInterface){
        Network network=new Network(activity);
        String section="books/";
        String parameters="?token="+getToken();
        String url=URL_BASE+section+parameters;
        network.httpRequest(activity, url, new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                getBooksInterface.booksGenerated(response);
            }
        });
    }
    public void registerDomicile(Domicile domicile, final HttpResponse httpResponse){
        Network network=new Network(activity);
        String section="domiciles/";
        String method="add.php?";
        String url=URL_BASE+section+method;
        network.httpRegisterDomicileRequest(activity, url, getToken(), domicile, new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                httpResponse.httpResponseSuccess(response);
            }
        });
    }
    public void getDomiciles(final HttpResponse httpResponse){
        Network network=new Network(activity);
        String section="domiciles/?";
        String parameters="token="+getToken();
        String url=URL_BASE+section+parameters;
        network.httpRequest(activity, url, new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                httpResponse.httpResponseSuccess(response);
            }
        });
    }
    public void getOrders(final HttpResponse httpResponse) {
        Network network=new Network(activity);
        String section="orders/?";
        String parameters="token="+getToken();
        String url=URL_BASE+section+parameters;
        network.httpRequest(activity, url, new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                httpResponse.httpResponseSuccess(response);
            }
        });
    }

    public void downloadPDF(String id, final HttpResponse httpResponse) {

    }
}
