package com.example.iramml.bookstore.Activities;

import android.content.DialogInterface;
import android.content.Intent;
import android.support.constraint.ConstraintLayout;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.example.iramml.bookstore.BookStoreApi.BookStore;
import com.example.iramml.bookstore.Interfaces.getTokenInterface;
import com.example.iramml.bookstore.Model.TokenResponse;
import com.example.iramml.bookstore.R;
import com.google.gson.Gson;
import com.rengwuxian.materialedittext.MaterialEditText;

import java.util.HashMap;
import java.util.Map;

public class LoginActivity extends AppCompatActivity {
    Button btnLogin, btnRegister;
    BookStore bookStore;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        btnLogin=findViewById(R.id.btnLogin);
        btnRegister=findViewById(R.id.btnSignin);
        bookStore=new BookStore(this);
        if(bookStore.tokenAvailable()){
            Intent intent=new Intent(LoginActivity.this, MainActivity.class);
            startActivity(intent);
            finish();
        }
        btnLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                showLoginDialog();
            }
        });
        btnRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent=new Intent(LoginActivity.this, RegisterActivity.class);
                startActivity(intent);
            }
        });
    }
    public void showLoginDialog(){
        final ConstraintLayout root;
        root=findViewById(R.id.root);
        AlertDialog.Builder alertDialog=new AlertDialog.Builder(this);
        alertDialog.setTitle(this.getResources().getString(R.string.login));
        alertDialog.setMessage(this.getResources().getString(R.string.fill_fields));

        LayoutInflater inflater=LayoutInflater.from(this);
        View login_layout=inflater.inflate(R.layout.layout_login, null);
        final MaterialEditText etEmail=login_layout.findViewById(R.id.etEmail);
        final MaterialEditText etPassword=login_layout.findViewById(R.id.etPassword);

        alertDialog.setView(login_layout);
        alertDialog.setPositiveButton(this.getResources().getString(R.string.login), new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                dialogInterface.dismiss();
                if (TextUtils.isEmpty(etEmail.getText().toString())){
                    Snackbar.make(root, getApplicationContext().getResources().getString(R.string.enter_email), Snackbar.LENGTH_SHORT).show();
                    return;
                }
                if (TextUtils.isEmpty(etPassword.getText().toString())){
                    Snackbar.make(root, getApplicationContext().getResources().getString(R.string.enter_password), Snackbar.LENGTH_SHORT).show();
                    return;
                }

                //make login
                Map<String, String> postMap=new HashMap<>();
                postMap.put("email", etEmail.getText().toString());
                postMap.put("password", etPassword.getText().toString());
                bookStore.login(postMap,
                        new getTokenInterface() {
                            @Override
                            public void tokenGenerated(String token) {
                                Log.d("TOKEN_USER", token);
                                Gson gson=new Gson();
                                TokenResponse tokenResponse=gson.fromJson(token, TokenResponse.class);
                                Log.d("CODE_RESPONSE",tokenResponse.code);
                                if(tokenResponse.code.equals("200")){
                                    Log.d("TOKEN_RESPONSE",tokenResponse.token);
                                    if(bookStore.saveToken(tokenResponse.token)){
                                        goToHome();
                                    }else{
                                        Toast.makeText(getApplicationContext(), "Error when save token", Toast.LENGTH_SHORT).show();
                                    }
                                }else{
                                    Toast.makeText(getApplicationContext(), "Email or password are incorrect",Toast.LENGTH_SHORT).show();
                                }

                            }
                        });
            }
        });
        alertDialog.setNegativeButton(this.getResources().getString(R.string.cancel), new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                dialogInterface.dismiss();
            }
        });
        alertDialog.show();
    }
    public void goToHome(){
        Intent intent=new Intent(LoginActivity.this, MainActivity.class);
        startActivity(intent);
        finish();
    }
}
