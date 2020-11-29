package com.iramml.bookstore.app.activity;

import android.Manifest;
import android.app.AlertDialog;
import android.content.Intent;
import android.graphics.Bitmap;
import android.provider.MediaStore;
import android.support.annotation.Nullable;
import android.support.design.widget.TextInputEditText;
import android.support.v7.app.ActionBar;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.util.Base64;
import android.util.Log;
import android.view.View;
import android.widget.Toast;

import com.android.volley.VolleyError;
import com.iramml.bookstore.app.api.BookStoreAPI;
import com.iramml.bookstore.app.common.Common;
import com.iramml.bookstore.app.interfaces.HttpResponse;
import com.iramml.bookstore.app.R;
import com.karumi.dexter.Dexter;
import com.karumi.dexter.MultiplePermissionsReport;
import com.karumi.dexter.PermissionToken;
import com.karumi.dexter.listener.PermissionRequest;
import com.karumi.dexter.listener.multi.MultiplePermissionsListener;
import com.rengwuxian.materialedittext.MaterialEditText;
import com.squareup.picasso.Picasso;

import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import de.hdodenhof.circleimageview.CircleImageView;
import dmax.dialog.SpotsDialog;

public class EditProfile extends AppCompatActivity {
    private TextInputEditText etFirstName, etLastName;
    private CircleImageView ivAvatar;

    private final int PERMISSION_PICK_IMG=200;
    private Bitmap bitmapAvatar;
    private BookStoreAPI bookStoreAPI;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_edit_profile);
        bookStoreAPI = new BookStoreAPI(this);
        initViews();
        initListeners();
        setValues();
    }

    private void initViews(){
        etFirstName = findViewById(R.id.et_first_name);
        etLastName = findViewById(R.id.et_last_name);
        ivAvatar = findViewById(R.id.imgAvatar);
    }

    private void initListeners(){
        ivAvatar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                openImageFromGalery();
            }
        });
    }

    private void setValues() {
        if(!Common.currentUser.getImageURL().equals(""))
            Picasso.get().load(Common.currentUser.getImageURL()).into(ivAvatar);
        else
            ivAvatar.setImageResource(R.drawable.add_image);

        etFirstName.setText(Common.currentUser.getFirst_name());
        etLastName.setText(Common.currentUser.getLast_name());
    }

    private void openImageFromGalery(){
        Dexter.withActivity(this)
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
        if (resultCode == RESULT_OK && requestCode == PERMISSION_PICK_IMG) {
            try {
                bitmapAvatar = MediaStore.Images.Media.getBitmap(this.getContentResolver(), data.getData());
                ivAvatar.setImageBitmap(bitmapAvatar);
            } catch (IOException e) {
                e.printStackTrace();
            }

            Map<String, String> postMap = new HashMap<>();
            postMap.put("image", getStringImage(bitmapAvatar));
            final AlertDialog waitingDialog = new SpotsDialog.Builder().setContext(EditProfile.this).build();
            waitingDialog.show();
            bookStoreAPI.uploadAvatar(postMap, new HttpResponse() {
                @Override
                public void httpResponseSuccess(String response) {
                    waitingDialog.dismiss();
                    Toast.makeText(getApplicationContext(),"Image uploaded", Toast.LENGTH_SHORT).show();
                }

                @Override
                public void httpResponseError(VolleyError error) {

                }
            });
        }
    }

    public String getStringImage(Bitmap bitmap){
        ByteArrayOutputStream baos = new  ByteArrayOutputStream();
        bitmap.compress(Bitmap.CompressFormat.PNG,100, baos);
        byte [] b = baos.toByteArray();
        return Base64.encodeToString(b, Base64.DEFAULT);
    }
}
