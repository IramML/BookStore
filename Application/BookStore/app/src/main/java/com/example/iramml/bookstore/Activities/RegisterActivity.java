package com.example.iramml.bookstore.Activities;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.Toast;

import com.example.iramml.bookstore.BookStoreApi.BookStore;
import com.example.iramml.bookstore.Interfaces.getTokenInterface;
import com.example.iramml.bookstore.Model.TokenResponse;
import com.example.iramml.bookstore.Model.User;
import com.example.iramml.bookstore.R;
import com.google.gson.Gson;
import com.rengwuxian.materialedittext.MaterialEditText;

public class RegisterActivity extends AppCompatActivity {
    ImageView ivLoadImage;
    Button btnSignin;
    BookStore bookStore;
    MaterialEditText etName, etLastName, etPhone, etAge,
            etEmail, etPassword;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);
        etName=findViewById(R.id.etName);
        etLastName=findViewById(R.id.etLastName);
        etPhone=findViewById(R.id.etPhone);
        etAge=findViewById(R.id.etAge);
        etEmail=findViewById(R.id.etEmail);
        etPassword=findViewById(R.id.etPassword);

        ivLoadImage=findViewById(R.id.ivLoadImage);
        ivLoadImage.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                
            }
        });

        bookStore=new BookStore(this);

        btnSignin=findViewById(R.id.btnSignin);
        btnSignin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                User user=new User(etName.getText().toString(),etLastName.getText().toString(),etPhone.getText().toString(),
                        etAge.getText().toString(),etEmail.getText().toString(),etPassword.getText().toString());
                bookStore.registerUser(user, new getTokenInterface() {
                    @Override
                    public void tokenGenerated(String token) {
                        Log.d("TOKEN_USER", token);
                        Gson gson=new Gson();
                        TokenResponse tokenResponse=gson.fromJson(token, TokenResponse.class);
                            Log.d("TOKEN_RESPONSE", tokenResponse.token);
                            if (bookStore.saveToken(tokenResponse.token)) {
                                goToHome();
                            } else {
                                Toast.makeText(getApplicationContext(), "Error when save token", Toast.LENGTH_SHORT).show();
                            }
                        }

                });
            }
        });
    }
    public void goToHome(){
        Intent intent=new Intent(RegisterActivity.this, MainActivity.class);
        startActivity(intent);
        finish();
    }
}
