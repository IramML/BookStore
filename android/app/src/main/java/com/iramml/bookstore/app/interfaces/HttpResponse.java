package com.iramml.bookstore.app.interfaces;

import com.android.volley.VolleyError;

public interface HttpResponse {
    void httpResponseSuccess(String response);
    void httpResponseError(VolleyError error);
}