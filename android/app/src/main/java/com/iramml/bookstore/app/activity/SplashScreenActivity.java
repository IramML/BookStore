package com.iramml.bookstore.app.activity;

import android.content.Intent;
import android.os.Handler;
import android.os.Looper;
import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;

import com.iramml.bookstore.app.R;
import com.iramml.bookstore.app.helper.SharedHelper;

public class SplashScreenActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash_screen);
        new Handler(Looper.myLooper()).postDelayed(new Runnable() {
            @Override
            public void run() {
                if (SharedHelper.getKey(SplashScreenActivity.this, "token").equals(""))
                    startActivity(new Intent(SplashScreenActivity.this, SignInActivity.class));
                else
                    startActivity(new Intent(SplashScreenActivity.this, HomeActivity.class));
            }
        }, 800);
    }
}