package com.iramml.bookstore.app.helper;

import android.content.Context;
import android.content.SharedPreferences;

public class SharedHelper {
    public static SharedPreferences sharedPreferences;
    public static SharedPreferences.Editor editor;

    public static void putKey(Context context, String Key, String Value) {
        sharedPreferences = context.getSharedPreferences("Cache", Context.MODE_PRIVATE);
        editor = sharedPreferences.edit();
        editor.putString(Key, Value);
        editor.apply();
    }

    public static String getKey(Context contextGetKey, String Key) {
        sharedPreferences = contextGetKey.getSharedPreferences("Cache", Context.MODE_PRIVATE);
        return sharedPreferences.getString(Key, "");
    }

    public static void clearSharedPreferences(Context context) {
        sharedPreferences = context.getSharedPreferences("Cache", Context.MODE_PRIVATE);
        sharedPreferences.edit().clear().apply();
    }
}
