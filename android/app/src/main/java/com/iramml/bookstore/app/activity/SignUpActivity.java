package com.iramml.bookstore.app.activity;

import android.Manifest;
import android.app.AlertDialog;
import android.content.Intent;
import android.graphics.Bitmap;
import android.provider.MediaStore;
import androidx.annotation.Nullable;
import com.google.android.material.textfield.TextInputEditText;

import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import androidx.cardview.widget.CardView;

import android.text.TextUtils;
import android.util.Base64;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.android.volley.VolleyError;
import com.iramml.bookstore.app.api.BookStoreAPI;
import com.iramml.bookstore.app.helper.SharedHelper;
import com.iramml.bookstore.app.listener.HttpResponseListener;
import com.iramml.bookstore.app.model.TokenResponse;
import com.iramml.bookstore.app.R;
import com.google.gson.Gson;
import com.iramml.bookstore.app.util.Utilities;
import com.karumi.dexter.Dexter;
import com.karumi.dexter.MultiplePermissionsReport;
import com.karumi.dexter.PermissionToken;
import com.karumi.dexter.listener.PermissionRequest;
import com.karumi.dexter.listener.multi.MultiplePermissionsListener;

import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import de.hdodenhof.circleimageview.CircleImageView;
import dmax.dialog.SpotsDialog;

public class SignUpActivity extends AppCompatActivity {
    private View root;
    private CircleImageView ivAvatar;
    private Button btnContinue;
    private CardView cvBack;
    private TextInputEditText etFirstName, etLastName, etEmail, etPassword;

    private BookStoreAPI bookStore;
    private Utilities utilities;

    private final int PERMISSION_PICK_IMG=200;
    private Bitmap bitmap;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sign_up);
        utilities = new Utilities();
        bookStore = new BookStoreAPI(this);
        initViews();
        initListeners();
    }

    private void initViews() {
        root = findViewById(R.id.root);
        etFirstName = findViewById(R.id.et_first_name);
        etLastName = findViewById(R.id.et_last_name);
        etEmail = findViewById(R.id.et_email);
        etPassword = findViewById(R.id.et_password);
        ivAvatar = findViewById(R.id.iv_avatar);
        btnContinue = findViewById(R.id.btn_continue);
        cvBack = findViewById(R.id.cv_back);
    }

    private void initListeners(){
        btnContinue.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
            Utilities.hideKeyboard(SignUpActivity.this);

            if (TextUtils.isEmpty(etFirstName.getText().toString())){
                displayMessage(getString(R.string.enter_first_name));
                return;
            }
            if (TextUtils.isEmpty(etLastName.getText().toString())){
                displayMessage(getString(R.string.enter_last_name));
                return;
            }
            if (TextUtils.isEmpty(etEmail.getText().toString())){
                displayMessage(getString(R.string.enter_email));
                return;
            }
            if (TextUtils.isEmpty(etPassword.getText().toString())){
                displayMessage(getString(R.string.enter_password));
                return;
            }

            signUp();
            }
        });
        ivAvatar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                openImageFromGallery();
            }
        });

        cvBack.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish();
            }
        });
    }

    private void signUp(){
        Map<String, String> postMap = new HashMap<>();
        postMap.put("first_name", etFirstName.getText().toString());
        postMap.put("last_name", etLastName.getText().toString());
        postMap.put("email", etEmail.getText().toString());
        postMap.put("password", etPassword.getText().toString());
        if(bitmap != null &&
                (getStringImage(bitmap) != null && !getStringImage(bitmap).equals(""))){
            postMap.put("image", getStringImage(bitmap));
        }

        final AlertDialog waitingDialog = new SpotsDialog.Builder().setContext(SignUpActivity.this).build();
        waitingDialog.show();
        bookStore.signUp(postMap, new HttpResponseListener() {
            @Override
            public void httpResponseSuccess(String response) {
                waitingDialog.dismiss();
                Gson gson = new Gson();
                TokenResponse responseObject = gson.fromJson(response, TokenResponse.class);
                if (responseObject.getCode().equals("200")){
                    SharedHelper.putKey(SignUpActivity.this, "token", responseObject.getAccess_token());
                    startActivity(new Intent(SignUpActivity.this, HomeActivity.class));
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

    private void openImageFromGallery(){
        Dexter.withContext(this)
                .withPermissions(Manifest.permission.READ_EXTERNAL_STORAGE,
                        Manifest.permission.WRITE_EXTERNAL_STORAGE)
                .withListener(new MultiplePermissionsListener() {
                    @Override
                    public void onPermissionsChecked(MultiplePermissionsReport report) {
                        if(report.areAllPermissionsGranted()){
                            Intent intent = new Intent(Intent.ACTION_PICK);
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

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (resultCode == RESULT_OK && requestCode == PERMISSION_PICK_IMG) {
            try {
                bitmap = MediaStore.Images.Media.getBitmap(this.getContentResolver(), data.getData());
                ivAvatar.setImageBitmap(bitmap);
            } catch (IOException e) {
                e.printStackTrace();
            }
        }
    }

    public String getStringImage(Bitmap bitmap) {
        ByteArrayOutputStream baos = new ByteArrayOutputStream();
        bitmap.compress(Bitmap.CompressFormat.PNG,100, baos);
        byte [] b = baos.toByteArray();
        return Base64.encodeToString(b, Base64.DEFAULT);
    }

    private void displayMessage(String message) {
        utilities.displayMessage(root, this, message);
    }
}
