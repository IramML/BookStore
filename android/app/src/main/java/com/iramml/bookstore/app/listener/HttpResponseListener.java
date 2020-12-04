package com.iramml.bookstore.app.listener;

import com.android.volley.VolleyError;

public interface HttpResponseListener {
    void httpResponseSuccess(String response);
    void httpResponseError(VolleyError error);
}