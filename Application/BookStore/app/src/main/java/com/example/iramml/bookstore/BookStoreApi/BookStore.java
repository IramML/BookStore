package com.example.iramml.bookstore.BookStoreApi;

import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;

import com.example.iramml.bookstore.Interfaces.HttpResponse;
import com.example.iramml.bookstore.Interfaces.getTokenInterface;
import com.example.iramml.bookstore.Model.User;
import com.example.iramml.bookstore.Util.Network;

public class BookStore {
    AppCompatActivity activity;
    String SETTINGS="settings";
    private String ACCESS_TOKEN="accessToken";
    private String URL_BASE="http://192.168.0.17/bookstore/api/";

    public BookStore(AppCompatActivity activity){
        this.activity=activity;
    }
    public void registerUser(User user, final getTokenInterface getTokenInterface){
        Network network=new Network(activity);
        String section="clients/";
        String method="register.php?";
        String url=URL_BASE+section+method;
        Log.d("URL ",url);
        network.httpPOSTRequest(activity, url, user,new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                getTokenInterface.tokenGenerated(response);
            }
        });
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
}
