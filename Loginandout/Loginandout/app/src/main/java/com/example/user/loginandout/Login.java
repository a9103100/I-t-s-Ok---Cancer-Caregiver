package com.example.user.loginandout;

import android.app.Activity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import java.io.File;


public class Login extends Activity {
    EditText value;
    Button login;
    String valuestring = null;
    public SharedPreferences setting;
    public static File file;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        value = (EditText) findViewById(R.id.textname);
        login = (Button) findViewById(R.id.button);

        login.setOnClickListener(new ClickButton());
        file = new File("/data/data/com.example.user.loginandout/shared_prefs","LoginInfo.xml");
        if(file.exists()){
            ReadValue();
            if(!valuestring.equals("")){
                SendIntent();
            }
        }
    }
    class ClickButton implements View.OnClickListener{

        @Override
        public void onClick(View view) {
            if(view == login){
                if (value != null){
                    valuestring = value.getEditableText().toString();
                    setting = getSharedPreferences("LoginInfo",0);
                    setting.edit().putString("VALUESTRING",valuestring).commit();
                    SendIntent();
                }
            }
        }
    }
    public void ReadValue(){
        setting = getSharedPreferences("LoginInfo",0);
        valuestring = setting.getString("VALUESTRING","");
    }
    public void SendIntent(){
        Intent it = new Intent();
        it.setClass(Login.this,Logout.class);
        Bundle bundle = new Bundle();
        bundle.putString("VALUE",valuestring);
        it.putExtras(bundle);
        startActivity(it);
        Login.this.finish();
    }

}
