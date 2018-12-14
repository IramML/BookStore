package com.example.iramml.bookstore.Activities;

import android.content.Intent;
import android.support.v7.app.ActionBar;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.example.iramml.bookstore.BookStoreApi.BookStore;
import com.example.iramml.bookstore.Interfaces.HttpResponse;
import com.example.iramml.bookstore.Model.Domicile;
import com.example.iramml.bookstore.R;
import com.example.iramml.bookstore.Util.Network;

public class RegisterDomicileActivity extends AppCompatActivity {
    TextView etPostalCode, etColony, etState, etMunicipality, etStreet, etOutdoorNumber;
    Button btnRegister;
    BookStore bookStore;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register_domicile);
        bookStore=new BookStore(this);
        etPostalCode=findViewById(R.id.etPostalCode);
        etColony=findViewById(R.id.etColony);
        etState=findViewById(R.id.etState);
        etMunicipality=findViewById(R.id.etMunicipality);
        etStreet=findViewById(R.id.etStreet);
        etOutdoorNumber=findViewById(R.id.etOutdoorNumber);

        btnRegister=findViewById(R.id.btnRegisterDomicile);
        btnRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Domicile domicile=new Domicile(etPostalCode.getText().toString(), etColony.getText().toString(),etState.getText().toString(),
                        etMunicipality.getText().toString(),etStreet.getText().toString(),etOutdoorNumber.getText().toString());
                bookStore.registerDomicile(domicile, new HttpResponse() {
                    @Override
                    public void httpResponseSuccess(String response) {
                        Log.d("RESPONSE",response);
                        Toast.makeText(getApplicationContext(), "Domicile registered", Toast.LENGTH_SHORT).show();
                        Intent intent=new Intent(getApplicationContext(), MainActivity.class);
                        intent.putExtra("itemSelected", 2);
                        startActivity(intent);
                        finish();
                    }
                });
            }
        });
        initToolbar();
    }

    private void initToolbar() {
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        toolbar.setTitle("Register");

        ActionBar actionBar=getSupportActionBar();
        actionBar.setDisplayHomeAsUpEnabled(true);
    }

}
