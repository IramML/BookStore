package com.example.iramml.bookstore.Activities;

import android.Manifest;
import android.content.Intent;
import android.graphics.Bitmap;
import android.net.Uri;
import android.provider.MediaStore;
import android.support.annotation.Nullable;
import android.support.v7.app.ActionBar;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.util.Base64;
import android.util.Log;
import android.view.View;
import android.widget.Toast;

import com.example.iramml.bookstore.BookStoreApi.BookStore;
import com.example.iramml.bookstore.Common.Common;
import com.example.iramml.bookstore.Interfaces.HttpResponse;
import com.example.iramml.bookstore.R;
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
    int PERMISSION_PICK_IMG=200;
    CircleImageView imgAvatar;
    Bitmap bitmapAvatar;
    BookStore bookStore;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_edit_profile);
        MaterialEditText etName=findViewById(R.id.etName);
        MaterialEditText etLastName=findViewById(R.id.etLastName);
        MaterialEditText etPhone=findViewById(R.id.etPhone);
        initToolbar();
        bookStore=new BookStore(this);
        imgAvatar=findViewById(R.id.imgAvatar);
        if(Common.currentUser.getUrlImage()!=null)
            Picasso.get().load(Common.currentUser.getUrlImage()).into(imgAvatar);
        else
            imgAvatar.setImageResource(R.drawable.add_image);

        imgAvatar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                openImageFromGalery();
            }
        });

        etName.setText(Common.currentUser.getName());
        etLastName.setText(Common.currentUser.getLastName());
        etPhone.setText(Common.currentUser.getPhone());
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
    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        if (resultCode==RESULT_OK && requestCode==PERMISSION_PICK_IMG) {
            try {
                bitmapAvatar=MediaStore.Images.Media.getBitmap(this.getContentResolver(), data.getData());
                imgAvatar.setImageBitmap(bitmapAvatar);
            } catch (IOException e) {
                e.printStackTrace();
            }
            //upload image
            Map<String, String> postMap=new HashMap<>();
            postMap.put("image", getStringImage(bitmapAvatar));
            postMap.put("token", bookStore.getToken());
            final SpotsDialog waitingDialog = new SpotsDialog(EditProfile.this);
            waitingDialog.show();
            bookStore.uploadAvatar(postMap, new HttpResponse() {
                @Override
                public void httpResponseSuccess(String response) {
                    waitingDialog.dismiss();
                    Toast.makeText(getApplicationContext(),"Image uploaded", Toast.LENGTH_SHORT).show();
                }
            });
        }
    }
    private void initToolbar() {
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        toolbar.setTitle("Edit Profile");

        ActionBar actionBar=getSupportActionBar();
        actionBar.setDisplayHomeAsUpEnabled(true);
    }
    public String getStringImage(Bitmap bitmap){
        Log.i("MyHitesh",""+bitmap);
        ByteArrayOutputStream baos=new  ByteArrayOutputStream();
        bitmap.compress(Bitmap.CompressFormat.PNG,100, baos);
        byte [] b=baos.toByteArray();
        String temp= Base64.encodeToString(b, Base64.DEFAULT);


        return temp;
    }
}
