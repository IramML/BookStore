package com.example.iramml.bookstore.Activities;

import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.View;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.TextView;

import com.cooltechworks.views.shimmer.ShimmerRecyclerView;
import com.example.iramml.bookstore.BookStoreApi.BookStore;
import com.example.iramml.bookstore.Interfaces.getBooksInterface;
import com.example.iramml.bookstore.Model.BooksResponse;
import com.example.iramml.bookstore.R;
import com.example.iramml.bookstore.RecyclerViewBooks.BooksCustomAdapter;
import com.example.iramml.bookstore.RecyclerViewBooks.ClickListener;
import com.google.gson.Gson;

public class MainActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {
    BookStore bookStore;
    TextView tvName, tvEmail;
    ShimmerRecyclerView rvBooks;
    RecyclerView.LayoutManager layoutManager;
    BooksCustomAdapter adapter;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        initDrawer();
        initRecyclerView();
        bookStore=new BookStore(this);
        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

        bookStore.getBooks(new getBooksInterface() {
            @Override
            public void booksGenerated(String books) {
                Gson gson=new Gson();
                Log.d("RESPONSE", books);
                BooksResponse booksObject=gson.fromJson(books, BooksResponse.class);
                implementRecyclerView(booksObject);

            }
        });
        final SwipeRefreshLayout swipeRefreshLayout=findViewById(R.id.swipeToRefresh);

        swipeRefreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                initRecyclerView();
                bookStore.getBooks(new getBooksInterface() {
                    @Override
                    public void booksGenerated(String books) {
                        Gson gson=new Gson();
                        Log.d("RESPONSE", books);
                        BooksResponse booksObject=gson.fromJson(books, BooksResponse.class);
                        implementRecyclerView(booksObject);
                        swipeRefreshLayout.setRefreshing(false);
                    }
                });
            }
        });
    }

    private void initRecyclerView() {
        rvBooks=(ShimmerRecyclerView)findViewById(R.id.rvBooks);
        rvBooks.showShimmerAdapter();
        rvBooks.setHasFixedSize(true);
        layoutManager=new LinearLayoutManager(this);
        rvBooks.setLayoutManager(layoutManager);
    }
    public void implementRecyclerView(BooksResponse booksObject){
        adapter=new BooksCustomAdapter(this, booksObject.books, new ClickListener() {
            @Override
            public void onClick(View view, int index) {

            }
        });
        rvBooks.setAdapter(adapter);
    }
    public void initDrawer(){
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();
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
        int id = item.getItemId();

        if (id == R.id.nav_orders) {
            // Handle the camera action
        } else if (id == R.id.nav_domiciles) {

        } else if (id == R.id.nav_log_out) {
            bookStore.logout();
            Intent intent=new Intent(MainActivity.this, LoginActivity.class);
            startActivity(intent);
            finish();
        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }
}
