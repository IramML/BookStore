package com.iramml.bookstore.app.activity;


import android.content.Intent;
import android.os.Bundle;
import androidx.fragment.app.FragmentTransaction;

import android.util.Log;
import android.view.View;
import com.google.android.material.navigation.NavigationView;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import android.view.MenuItem;
import android.widget.TextView;

import com.android.volley.VolleyError;
import com.iramml.bookstore.app.api.BookStoreAPI;
import com.iramml.bookstore.app.common.Common;
import com.iramml.bookstore.app.fragment.BooksFragment;
import com.iramml.bookstore.app.fragment.DomicilesFragment;
import com.iramml.bookstore.app.fragment.OrdersFragment;
import com.iramml.bookstore.app.interfaces.HttpResponse;
import com.iramml.bookstore.app.R;
import com.google.gson.Gson;
import com.iramml.bookstore.app.model.UserResponse;
import com.squareup.picasso.Picasso;

import de.hdodenhof.circleimageview.CircleImageView;

public class HomeActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {
    private BookStoreAPI bookStoreAPI;
    private int itemSelected;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);
        bookStoreAPI = new BookStoreAPI(this);

        if(getIntent() != null)
            itemSelected = getIntent().getIntExtra("itemSelected",0);

        getCurrentProfile();
    }

    private void getCurrentProfile() {
        bookStoreAPI.getCurrentUser(new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                Gson gson=new Gson();
                Log.d("PROFILE_RESPONSE", "httpResponseSuccess: " + response);
                UserResponse responseObject = gson.fromJson(response, UserResponse.class);

                if (responseObject.getCode().equals("200")) {
                    Common.currentUser = responseObject.getUser();
                    initDrawer();
                }

            }

            @Override
            public void httpResponseError(VolleyError error) {

            }
        });
    }

    public void initDrawer() {
        Toolbar toolbar = findViewById(R.id.toolbar);
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);

        setSupportActionBar(toolbar);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();
        navigationView.setNavigationItemSelectedListener(this);

        View navigationHeaderView = navigationView.getHeaderView(0);
        CircleImageView imgAvatar = navigationHeaderView.findViewById(R.id.imgAvatar);
        TextView tvName = (TextView) navigationHeaderView.findViewById(R.id.tvUserName);

        tvName.setText(String.format("%s %s", Common.currentUser.getFirst_name(), Common.currentUser.getLast_name()));
        if (Common.currentUser.getImageURL() != null && !Common.currentUser.getImageURL().equals(""))
            Picasso.get().load(Common.currentUser.getImageURL()).into(imgAvatar);

        FragmentTransaction fragmentTransaction = this.getSupportFragmentManager().beginTransaction();
        if (itemSelected == 0){
            navigationView.setCheckedItem(R.id.nav_search);
            BooksFragment booksFragment = new BooksFragment();
            fragmentTransaction.replace(R.id.flContent, booksFragment);
        }else if(itemSelected == 1) {
            navigationView.setCheckedItem(R.id.nav_orders);
            OrdersFragment ordersFragment = new OrdersFragment();
            fragmentTransaction.replace(R.id.flContent, ordersFragment);
        }else if(itemSelected == 2) {
            navigationView.setCheckedItem(R.id.nav_domiciles);
            DomicilesFragment domicilesFragment = new DomicilesFragment();
            fragmentTransaction.replace(R.id.flContent, domicilesFragment);
        }

        fragmentTransaction.commit();

    }

    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        FragmentTransaction fragmentTransaction = this.getSupportFragmentManager().beginTransaction();

        int id = item.getItemId();
        switch (id){
            case R.id.nav_search:
                fragmentTransaction.replace(R.id.flContent, new BooksFragment());
                fragmentTransaction.commit();
                break;
            case R.id.nav_orders:
                fragmentTransaction.replace(R.id.flContent, new OrdersFragment());
                fragmentTransaction.commit();
                break;
            case R.id.nav_domiciles:
                fragmentTransaction.replace(R.id.flContent, new DomicilesFragment());
                fragmentTransaction.commit();
                break;
            case R.id.nav_profile:
                goToProfile();
                break;
            case R.id.nav_log_out:
                logout();
                break;
            default:
                fragmentTransaction.replace(R.id.flContent, new BooksFragment());
                fragmentTransaction.commit();
                break;
        }
        item.setChecked(true);
        setTitle(item.getTitle());
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }

    private void goToProfile() {
        Intent intent = new Intent(HomeActivity.this, ProfileActivity.class);
        startActivity(intent);
    }

    private void logout() {
        bookStoreAPI.logout();
        Intent intent = new Intent(HomeActivity.this, SignInActivity.class);
        startActivity(intent);
        finish();
    }
}
