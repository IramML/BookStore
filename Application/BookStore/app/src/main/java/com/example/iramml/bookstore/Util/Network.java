package com.example.iramml.bookstore.Util;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.iramml.bookstore.Interfaces.HttpResponse;
import com.example.iramml.bookstore.Model.User;

import java.util.HashMap;
import java.util.Map;


public class Network {
    AppCompatActivity appCompatActivity;
    public Network(AppCompatActivity appCompatActivity){
        this.appCompatActivity=appCompatActivity;
    }
    public Boolean availableNetwok(){
        ConnectivityManager connectivityManager=(ConnectivityManager) appCompatActivity.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo=connectivityManager.getActiveNetworkInfo();
        return networkInfo!=null && networkInfo.isConnected();
    }
    public void httpRequest(Context context, String url, final HttpResponse httpResponse){
        if(availableNetwok()){
            RequestQueue queue=Volley.newRequestQueue(context);

            StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        httpResponse.httpResponseSuccess(response);
                    }
                }, new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {

                    }
            });
            queue.add(stringRequest);
        }
    }
    public void httpPOSTRequest(Context context, String url, final User user, final HttpResponse httpResponse){
        if(availableNetwok()){
            RequestQueue queue=Volley.newRequestQueue(context);

            StringRequest stringRequest = new StringRequest(Request.Method.POST, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        Log.d("SUCCESS_HTTP", response);
                        httpResponse.httpResponseSuccess(response);
                    }
                }, new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Log.d("ERROR_HTTP", error.getMessage());
                    }
            }){
                @Override
                protected Map<String, String> getParams() throws AuthFailureError {
                    Map<String, String> postMap = new HashMap<>();
                    postMap.put("name", user.getName());
                    postMap.put("last_name", user.getLastName());
                    postMap.put("phone", user.getPhone());
                    postMap.put("age", user.getAge());
                    postMap.put("email", user.getEmail());
                    postMap.put("password", user.getPassword());
                    return postMap;
                }
            };
            queue.add(stringRequest);
        }
    }
}
