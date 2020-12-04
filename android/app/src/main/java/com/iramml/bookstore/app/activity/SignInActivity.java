package com.iramml.bookstore.app.activity;

import android.app.AlertDialog;
import android.content.Intent;

import com.google.android.material.textfield.TextInputEditText;
import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import com.android.volley.VolleyError;
import com.iramml.bookstore.app.api.BookStoreAPI;
import com.iramml.bookstore.app.helper.SharedHelper;
import com.iramml.bookstore.app.listener.HttpResponseListener;
import com.iramml.bookstore.app.model.TokenResponse;
import com.iramml.bookstore.app.R;
import com.google.gson.Gson;
import com.iramml.bookstore.app.util.Utilities;

import java.util.HashMap;
import java.util.Map;

import dmax.dialog.SpotsDialog;


public class SignInActivity extends AppCompatActivity {
    private Button btnContinue, btnSignUp;
    private TextInputEditText etEmail, etPassword;
    private View root;

    private BookStoreAPI bookStore;
    private Utilities utilities;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sign_in);
        utilities = new Utilities();
        bookStore = new BookStoreAPI(this);
        initViews();
        initListeners();
    }

    private void initViews(){
        root = findViewById(R.id.root);
        btnContinue = findViewById(R.id.btn_continue);
        btnSignUp = findViewById(R.id.btn_sign_up);
        etEmail = findViewById(R.id.et_email);
        etPassword = findViewById(R.id.et_password);
    }

    private void initListeners(){
        btnContinue.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Utilities.hideKeyboard(SignInActivity.this);
                if (TextUtils.isEmpty(etEmail.getText().toString())){
                    displayMessage(getString(R.string.enter_email));
                    return;
                }
                if (TextUtils.isEmpty(etPassword.getText().toString())){
                    displayMessage(getString(R.string.enter_password));
                    return;
                }
                signIn();
            }
        });

        btnSignUp.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(SignInActivity.this, SignUpActivity.class);
                startActivity(intent);
            }
        });
    }

    private void signIn(){
        final AlertDialog waitingDialog = new SpotsDialog.Builder().setContext(this).build();
        waitingDialog.show();
        Map<String, String> postMap = new HashMap<>();
        postMap.put("email", etEmail.getText().toString());
        postMap.put("password", etPassword.getText().toString());

        bookStore.signIn(postMap, new HttpResponseListener() {
            @Override
            public void httpResponseSuccess(String response) {
                Gson gson = new Gson();
                TokenResponse responseObject = gson.fromJson(response, TokenResponse.class);
                waitingDialog.dismiss();
                if (responseObject.getCode().equals("200")){
                    SharedHelper.putKey(SignInActivity.this, "token", responseObject.getAccess_token());
                    startActivity(new Intent(SignInActivity.this, HomeActivity.class));
                    finish();
                }
            }

            @Override
            public void httpResponseError(VolleyError error) {
                waitingDialog.dismiss();
                displayMessage(getString(R.string.failed));
            }
        });
    }

    private void displayMessage(String message){
        utilities.displayMessage(root, this, message);
    }
}
