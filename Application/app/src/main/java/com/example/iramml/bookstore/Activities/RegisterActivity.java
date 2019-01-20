package com.example.iramml.bookstore.Activities;

import android.Manifest;
import android.content.Intent;
import android.graphics.Bitmap;
import android.net.Uri;
import android.provider.MediaStore;
import android.support.annotation.Nullable;
import android.support.v7.app.ActionBar;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
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
import com.karumi.dexter.Dexter;
import com.karumi.dexter.MultiplePermissionsReport;
import com.karumi.dexter.PermissionToken;
import com.karumi.dexter.listener.PermissionRequest;
import com.karumi.dexter.listener.multi.MultiplePermissionsListener;
import com.rengwuxian.materialedittext.MaterialEditText;

import java.io.IOException;
import java.util.List;

import de.hdodenhof.circleimageview.CircleImageView;

public class RegisterActivity extends AppCompatActivity {
    CircleImageView ivLoadImage;
    Button btnSignin;
    BookStore bookStore;
    MaterialEditText etName, etLastName, etPhone, etAge,
            etEmail, etPassword;
    Uri imgPath;

    int PERMISSION_PICK_IMG=200;

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

        initToolbar();

        ivLoadImage=findViewById(R.id.ivLoadImage);
        ivLoadImage.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
               openImageFromGalery();
            }
        });

        bookStore=new BookStore(this);

        btnSignin=findViewById(R.id.btnSignin);
        btnSignin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                User user=new User(etName.getText().toString(),etLastName.getText().toString(),etPhone.getText().toString(),
                        etAge.getText().toString(),etEmail.getText().toString(),etPassword.getText().toString(), imgPath);
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

    private void openImageFromGalery(){
        Dexter.withActivity(this)
                .withPermissions(Manifest.permission.READ_EXTERNAL_STORAGE,
                        Manifest.permission.WRITE_EXTERNAL_STORAGE)
                .withListener(new MultiplePermissionsListener() {
                    @Override
                    public void onPermissionsChecked(MultiplePermissionsReport report) {
                        if(report.areAllPermissionsGranted()){
                            Intent intent=new Intent(Intent.ACTION_PICK);
                            intent.setType("image/*");
                            startActivityForResult(intent, PERMISSION_PICK_IMG);
                        }else{
                            Toast.makeText(getApplicationContext(), "Permission denied", Toast.LENGTH_SHORT).show();
                        }
                    }

                    @Override
                    public void onPermissionRationaleShouldBeShown(List<PermissionRequest> permissions, PermissionToken token) {
                        token.continuePermissionRequest();
                    }
                }).check();
    }

    private void initToolbar() {
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        toolbar.setTitle("Register");

        ActionBar actionBar=getSupportActionBar();
        actionBar.setDisplayHomeAsUpEnabled(true);
    }

    public void goToHome(){
        Intent intent=new Intent(RegisterActivity.this, MainActivity.class);
        startActivity(intent);
        finish();
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        if (resultCode==RESULT_OK && requestCode==PERMISSION_PICK_IMG) {
             imgPath= data.getData();
            try {
                Bitmap bitmap=MediaStore.Images.Media.getBitmap(this.getContentResolver(), data.getData());
                ivLoadImage.setImageBitmap(bitmap);
            } catch (IOException e) {
                e.printStackTrace();
            }

        }
    }
}
