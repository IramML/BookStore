package com.iramml.bookstore.app.api;

import android.content.Context;
import android.util.Log;

import com.android.volley.VolleyError;
import com.iramml.bookstore.app.common.ConfigApp;
import com.iramml.bookstore.app.helper.SharedHelper;
import com.iramml.bookstore.app.listener.HttpResponseListener;
import com.iramml.bookstore.app.util.NetworkUtil;
import java.util.Map;

public class BookStoreAPI {
    private final NetworkUtil network;
    private final Context context;

    public BookStoreAPI(Context context) {
        this.context = context;
        this.network = new NetworkUtil(context);
    }

    public void signUp(Map<String, String> postMap, final HttpResponseListener httpResponse) {
        String url = ConfigApp.URL_API + "sign/up/index.php";
        postRequest(postMap, url, httpResponse);
    }

    public void signIn(Map<String, String> postMap, final HttpResponseListener httpResponse) {
        String url = ConfigApp.URL_API + "sign/in/index.php";
        postRequest(postMap, url, httpResponse);
    }

    public void getBooks(final HttpResponseListener httpResponse) {
        String parameters = "?token=" + getToken();
        String url = ConfigApp.URL_API + "books/get/index.php" + parameters;
        network.httpRequest(url, httpResponse);
    }

    public void getBookDetailsByID(String bookID, final HttpResponseListener httpResponse) {
        String parameters = "?token=" + getToken() + "&book_id=" + bookID;
        String url = ConfigApp.URL_API + "books/details/index.php" + parameters;
        network.httpRequest(url, httpResponse);
    }

    public void registerDomicile(Map<String, String> postMap, final HttpResponseListener httpResponse) {
        String url = ConfigApp.URL_API + "domiciles/add/index.php";
        postRequest(postMap, url, httpResponse);
    }

    public void getDomiciles(final HttpResponseListener httpResponse) {
        String parameters = "?token=" + getToken();
        String url = ConfigApp.URL_API + "domiciles/get/index.php" + parameters;
        network.httpRequest(url, httpResponse);
    }

    public void getOrders(final HttpResponseListener httpResponse) {
        String parameters = "?token=" + getToken();
        String url = ConfigApp.URL_API + "orders/get/index.php" + parameters;
        network.httpRequest(url, httpResponse);
    }

    public void getOrderDetails(final String orderID, final HttpResponseListener httpResponse) {
        String parameters = "?token=" + getToken() + "&order_id=" + orderID;
        String url = ConfigApp.URL_API + "orders/detail/index.php" + parameters;
        network.httpRequest(url, httpResponse);
    }

    public void buyPDF(final Map<String, String> postMap, final HttpResponseListener httpResponse) {
        String url = ConfigApp.URL_API + "books/buy/index.php";
        postRequest(postMap, url, httpResponse);
    }

    public void uploadAvatar(final Map<String, String> postMap, final HttpResponseListener httpResponse) {
        String url = ConfigApp.URL_API + "profile/avatar/index.php";
        postRequest(postMap, url, httpResponse);
    }

    public void getCurrentUser(final HttpResponseListener httpResponse) {
        String parameters = "?token=" + getToken();
        String url = ConfigApp.URL_API + "profile/get/index.php" +parameters;
        Log.d("URL_PROFILE", "getCurrentUser: " + url);
        network.httpRequest(url, httpResponse);
    }

    private String getToken() {
        return SharedHelper.getKey(context, "token");
    }

    private void postRequest(final Map<String, String> postMap, String url, final HttpResponseListener httpResponse) {
        if(!getToken().equals(""))
            postMap.put("token", getToken());

        network.httpPOSTRequest(postMap, url, new HttpResponseListener() {
            @Override
            public void httpResponseSuccess(String response) {
                httpResponse.httpResponseSuccess(response);
            }

            @Override
            public void httpResponseError(VolleyError error) {
                httpResponse.httpResponseError(error);
            }
        });
    }

    public void logout() {
        SharedHelper.clearSharedPreferences(context);
    }
}
