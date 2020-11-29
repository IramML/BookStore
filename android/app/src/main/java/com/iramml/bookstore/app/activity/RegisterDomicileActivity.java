package com.iramml.bookstore.app.activity;

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

import com.android.volley.VolleyError;
import com.google.gson.Gson;
import com.iramml.bookstore.app.api.BookStoreAPI;
import com.iramml.bookstore.app.interfaces.HttpResponse;
import com.iramml.bookstore.app.model.Domicile;
import com.iramml.bookstore.app.R;
import com.iramml.bookstore.app.model.GenericResponse;

import java.util.HashMap;
import java.util.Map;

public class RegisterDomicileActivity extends AppCompatActivity {
    private TextView etPostalCode, etCountry, etState, etCity, etStreet, etOutdoorNumber;
    private Button btnRegister;

    private BookStoreAPI bookStore;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register_domicile);
        bookStore = new BookStoreAPI(this);
        initViews();
        initListeners();
    }

    private void initViews(){
        etPostalCode = findViewById(R.id.et_postal_code);
        etCountry = findViewById(R.id.et_country);
        etState = findViewById(R.id.et_state);
        etCity = findViewById(R.id.et_city);
        etStreet = findViewById(R.id.et_street);
        etOutdoorNumber = findViewById(R.id.et_outdoor_number);
        btnRegister = findViewById(R.id.btn_register_domicile);
    }

    private void initListeners(){
        btnRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Map<String, String> postMap = new HashMap<>();
                postMap.put("postal_code", etPostalCode.getText().toString());
                postMap.put("country", etCountry.getText().toString());
                postMap.put("state", etState.getText().toString());
                postMap.put("city", etCity.getText().toString());
                postMap.put("street", etStreet.getText().toString());
                postMap.put("outdoor_number", etOutdoorNumber.getText().toString());
                bookStore.registerDomicile(postMap, new HttpResponse() {
                    @Override
                    public void httpResponseSuccess(String response) {
                        Log.d("RESPONSE",response);
                        Gson gson = new Gson();
                        GenericResponse responseObject = gson.fromJson(response, GenericResponse.class);
                        if(responseObject.getCode().equals("200")){
                            Toast.makeText(getApplicationContext(), "Domicile registered", Toast.LENGTH_SHORT).show();
                            Intent intent = new Intent(RegisterDomicileActivity.this, HomeActivity.class);
                            intent.putExtra("itemSelected", 2);
                            startActivity(intent);
                            finish();
                        }

                    }

                    @Override
                    public void httpResponseError(VolleyError error) {

                    }
                });
            }
        });
    }

}
