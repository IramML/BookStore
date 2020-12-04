package com.iramml.bookstore.app.util;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.util.Log;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.RetryPolicy;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.iramml.bookstore.app.listener.HttpResponseListener;

import java.util.Map;

public class NetworkUtil{
    private final Context context;
    private RequestQueue queue;

    public NetworkUtil(Context context) {
        this.context = context;
    }

    public Boolean availableNetwork() {
        ConnectivityManager connectivityManager = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = connectivityManager.getActiveNetworkInfo();
        return networkInfo != null && networkInfo.isConnected();
    }

    public void httpRequest(String url, final HttpResponseListener httpResponse) {
        if (availableNetwork()) {
            if (queue == null)
                queue = Volley.newRequestQueue(context);

            StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                    new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            httpResponse.httpResponseSuccess(response);
                        }
                    }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    httpResponse.httpResponseError(error);
                }
            });
            queue.add(stringRequest);
        }
    }

    public void httpPOSTRequest(final Map<String, String> postMap, String url, final HttpResponseListener httpResponse) {
        if (availableNetwork()) {
            if (queue == null)
                queue = Volley.newRequestQueue(context);

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
                    Log.e("HTTP_REQUEST_ERROR", error.toString());
                    httpResponse.httpResponseError(error);
                }
            }){
                @Override
                protected Map<String, String> getParams() throws AuthFailureError {
                    return postMap;
                }
            };
            stringRequest.setRetryPolicy(new RetryPolicy() {
                @Override
                public int getCurrentTimeout() {
                    return 50000;
                }

                @Override
                public int getCurrentRetryCount() {
                    return 50000;
                }

                @Override
                public void retry(VolleyError error) throws VolleyError {
                    httpResponse.httpResponseError(error);
                }
            });

            queue.add(stringRequest);
        }
    }
}