package com.example.iramml.bookstore.Activities;


import android.support.v4.app.FragmentManager;
import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentTransaction;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.MenuItem;
import android.widget.TextView;

import com.cooltechworks.views.shimmer.ShimmerRecyclerView;
import com.example.iramml.bookstore.BookStoreApi.BookStore;
import com.example.iramml.bookstore.Common.Common;
import com.example.iramml.bookstore.Fragments.BooksFragment;
import com.example.iramml.bookstore.Fragments.DomicilesFragment;
import com.example.iramml.bookstore.Fragments.OrdersFragment;
import com.example.iramml.bookstore.Interfaces.HttpResponse;
import com.example.iramml.bookstore.Model.BooksResponse;
import com.example.iramml.bookstore.Model.User;
import com.example.iramml.bookstore.R;
import com.example.iramml.bookstore.RecyclerViewBooks.BooksCustomAdapter;
import com.example.iramml.bookstore.RecyclerViewBooks.ClickListener;
import com.google.gson.Gson;
import com.squareup.picasso.Picasso;

import de.hdodenhof.circleimageview.CircleImageView;

public class MainActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {
    BookStore bookStore;
    TextView tvName, tvEmail;
    ShimmerRecyclerView rvBooks;
    RecyclerView.LayoutManager layoutManager;
    BooksCustomAdapter adapter;

    int itemSelected;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        bookStore=new BookStore(this);
        if(getIntent()!=null){
            itemSelected=getIntent().getIntExtra("itemSelected",0);
        }
        bookStore.getCurrentUser(new HttpResponse() {
            @Override
            public void httpResponseSuccess(String response) {
                Gson gson=new Gson();
                Common.currentUser=gson.fromJson(response, User.class);
                String image=Common.URL_BASE+Common.currentUser.getUrlImage();
                Common.currentUser.setUrlImage(image);
                initDrawer();
            }
        });
    }

    public void initDrawer(){
        Toolbar toolbar=findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        DrawerLayout drawer=(DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();
        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);
        View navigationHeaderView=navigationView.getHeaderView(0);
        CircleImageView imgAvatar=navigationHeaderView.findViewById(R.id.imgAvatar);
        TextView tvName=(TextView)navigationHeaderView.findViewById(R.id.tvUserName);
        tvName.setText(Common.currentUser.getName());
        if(Common.currentUser.getUrlImage()!=null)
            Picasso.get().load(Common.currentUser.getUrlImage()).into(imgAvatar);
        if (itemSelected==0)
            navigationView.setCheckedItem(R.id.nav_search);
        else if(itemSelected==2)
            navigationView.setCheckedItem(R.id.nav_domiciles);


        if(itemSelected==0){
            FragmentTransaction fragmentTransaction = this.getSupportFragmentManager().beginTransaction();
            BooksFragment booksFragment = new BooksFragment();
            booksFragment.setActivity(this);
            fragmentTransaction.replace(R.id.flContent, booksFragment);
            fragmentTransaction.commit();
        }else if(itemSelected==2){
            FragmentTransaction fragmentTransaction = this.getSupportFragmentManager().beginTransaction();
            DomicilesFragment domicilesFragment = new DomicilesFragment();
            domicilesFragment.setActivity(this);
            fragmentTransaction.replace(R.id.flContent, domicilesFragment);
            fragmentTransaction.commit();
        }

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
        BooksFragment booksFragment = new BooksFragment();
        OrdersFragment ordersFragment = new OrdersFragment();
        DomicilesFragment domicilesFragment = new DomicilesFragment();
        int id = item.getItemId();
        switch (id){
            case R.id.nav_search:
                booksFragment.setActivity(this);
                fragmentTransaction.replace(R.id.flContent, booksFragment);
                fragmentTransaction.commit();
                break;
            case R.id.nav_orders:
                ordersFragment.setActivity(this);
                fragmentTransaction.replace(R.id.flContent, ordersFragment);
                fragmentTransaction.commit();
                break;
            case R.id.nav_domiciles:
                domicilesFragment.setActivity(this);
                fragmentTransaction.replace(R.id.flContent, domicilesFragment);
                fragmentTransaction.commit();
                break;
            case R.id.nav_profile:
                goToProfile();
                break;
            case R.id.nav_log_out:
                logout();
                break;
            default:
                booksFragment.setActivity(this);
                fragmentTransaction.replace(R.id.flContent, booksFragment);
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
        Intent intent=new Intent(MainActivity.this, Profile.class);
        startActivity(intent);
    }
    private void logout() {
        bookStore.logout();
        Intent intent=new Intent(MainActivity.this, LoginActivity.class);
        startActivity(intent);
        finish();
    }
}
