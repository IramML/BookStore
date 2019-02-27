package com.example.iramml.bookstore;

import android.app.Application;
import android.graphics.Color;
import android.support.v7.content.res.AppCompatResources;

import sakout.mehdi.StateViews.StateViewsBuilder;

public class App extends Application {
    @Override
    public void onCreate() {
        super.onCreate();
        StateViewsBuilder
                .init(this)
                .setIconColor(Color.parseColor("#D2D5DA"))
                .addState("error",
                        "No Connection",
                        "Error retrieving information from server.",
                        AppCompatResources.getDrawable(this, R.drawable.ic_server_error),
                        "Retry"
                )
                .setButtonBackgroundColor(Color.parseColor("#317DED"))
                .setButtonTextColor(Color.parseColor("#FFFFFF"))
                .setIconSize(50);
    }
}
