package com.iramml.bookstore.app.api;

import android.content.Context;
import com.android.volley.VolleyError;
import com.iramml.bookstore.app.common.ConfigApp;
import com.iramml.bookstore.app.helper.SharedHelper;
import com.iramml.bookstore.app.interfaces.HttpResponse;
import com.iramml.bookstore.app.util.NetworkUtil;
import java.util.Map;

public class BookStoreAPI {
    private NetworkUtil network;
    private Context context;

    public BookStoreAPI(Context context){
        this.context = context;
        this.network = new NetworkUtil(context);
    }

    public void signUp(Map<String, String> postMap, final HttpResponse httpResponse){
        String url = ConfigApp.URL_API + "sign/in/index.php";
        postRequest(postMap, url, httpResponse);
    }

    public void signIn(Map<String, String> postMap, final HttpResponse httpResponse){
        String url = ConfigApp.URL_API + "sign/in/index.php";
        postRequest(postMap, url, httpResponse);
    }

    public void getBooks(final HttpResponse httpResponse){
        String parameters = "?token=" + getToken();
        String url = ConfigApp.URL_API + "books/get/index.php" + parameters;
        network.httpRequest(url, httpResponse);
    }

    public void registerDomicile(Map<String, String> postMap, final HttpResponse httpResponse){
        String url = ConfigApp.URL_API + "domiciles/add/index.php";
        network.httpPOSTRequest(postMap, url, httpResponse);
    }

    public void getDomiciles(final HttpResponse httpResponse){
        String parameters = "?token=" + getToken();
        String url = ConfigApp.URL_API + "domiciles/get/index.php" + parameters;
        network.httpRequest(url, httpResponse);
    }

    public void getOrders(final HttpResponse httpResponse) {
        String parameters = "?token=" + getToken();
        String url = ConfigApp.URL_API + "orders/get/index.php" + parameters;
        network.httpRequest(url, httpResponse);
    }

    public void buyPDF(final Map<String, String> postMap, final HttpResponse httpResponse){
        String url = ConfigApp.URL_API + "book/buy/index.php";
        postRequest(postMap, url, httpResponse);
    }

    public void uploadAvatar(final Map<String, String> postMap, final HttpResponse httpResponse){
        String url = ConfigApp.URL_API + "profile/avatar/index.php";
        postRequest(postMap, url, httpResponse);
    }

    public void getCurrentUser(final HttpResponse httpResponse){
        String parameters = "?token=" + getToken();
        String url = ConfigApp.URL_API + "profile/get/index.php" +parameters;
        network.httpRequest(url, httpResponse);
    }

    private String getToken(){
        return SharedHelper.getKey(context, "token");
    }

    private void postRequest(Map<String, String> postMap, String url, final HttpResponse httpResponse){
        if(!SharedHelper.getKey(context, "token").equals(""))
            postMap.put("token", SharedHelper.getKey(context, "token"));

        network.httpPOSTRequest(postMap, url, new HttpResponse() {
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

    public void logout(){
        SharedHelper.clearSharedPreferences(context);
    }
}
