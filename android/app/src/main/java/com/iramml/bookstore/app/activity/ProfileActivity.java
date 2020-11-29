package com.iramml.bookstore.app.activity;

import android.content.Intent;
import android.support.v7.app.ActionBar;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.widget.TextView;

import com.iramml.bookstore.app.api.BookStoreAPI;
import com.iramml.bookstore.app.common.Common;
import com.iramml.bookstore.app.R;
import com.squareup.picasso.Picasso;

import de.hdodenhof.circleimageview.CircleImageView;

public class ProfileActivity extends AppCompatActivity {
    private CircleImageView ivAvatar;
    private TextView tvName, tvEmail;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);
        initViews();
        setData();
        initToolbar();
    }

    private void initViews() {
        ivAvatar = findViewById(R.id.iv_avatar);
        tvName = findViewById(R.id.tv_name);
        tvEmail = findViewById(R.id.tv_email);
    }

    private void setData(){
        String profileImgURL = Common.currentUser.getImageURL();
        if(profileImgURL != null && !profileImgURL.equals(""))
            Picasso.get().load(Common.currentUser.getImageURL()).into(ivAvatar);

        tvName.setText(String.format("%s %s", Common.currentUser.getFirst_name(), Common.currentUser.getLast_name()));
        tvEmail.setText(String.format("Phone: %s", Common.currentUser.getEmail()));
    }

    private void initToolbar() {
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        toolbar.setTitle("Profile");
        ActionBar actionBar = getSupportActionBar();
        actionBar.setDisplayHomeAsUpEnabled(true);
    }
    
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.activity_profile_menu, menu);
        return super.onCreateOptionsMenu(menu);
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()){
            case R.id.ic_edit:
                goToEditProfile();
                return true;
            default:
                return super.onOptionsItemSelected(item);
        }
    }

    private void goToEditProfile() {
        Intent intent = new Intent(ProfileActivity.this, EditProfile.class);
        startActivity(intent);
    }
}
