package com.example.iramml.bookstore.Activities;

import android.content.Intent;
import android.support.v7.app.ActionBar;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.widget.TextView;

import com.example.iramml.bookstore.BookStoreApi.BookStore;
import com.example.iramml.bookstore.Common.Common;
import com.example.iramml.bookstore.R;
import com.squareup.picasso.Picasso;

import de.hdodenhof.circleimageview.CircleImageView;

public class Profile extends AppCompatActivity {
    BookStore bookStore;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);
        initToolbar();
        CircleImageView imgAvatar=findViewById(R.id.imgAvatar);
        if(Common.currentUser.getUrlImage()!=null)
            Picasso.get().load(Common.currentUser.getUrlImage()).into(imgAvatar);
        TextView tvName=findViewById(R.id.tvName);
        TextView tvPhone=findViewById(R.id.tvPhone);
        tvName.setText(Common.currentUser.getName()+" "+Common.currentUser.getLastName());
        tvPhone.setText("Phone: "+Common.currentUser.getPhone());
    }
    
    private void initToolbar() {
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        toolbar.setTitle("Profile");

        ActionBar actionBar=getSupportActionBar();
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
        Intent intent=new Intent(Profile.this, EditProfile.class);
        startActivity(intent);
    }
}
