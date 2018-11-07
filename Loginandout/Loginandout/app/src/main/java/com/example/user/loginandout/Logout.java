package com.example.user.loginandout;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import java.io.File;

/**
 * Created by USER on 2014/10/29.
 */
public class Logout extends Activity {
    String value;
    TextView text;
    Button logout;
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_logout);
        text = (TextView) findViewById(R.id.textView);
        logout = (Button) findViewById(R.id.button2);

        Bundle bundle = this.getIntent().getExtras();
        value = bundle.getString("VALUE");
        text.setText(value);

        logout.setOnClickListener(new ClickLogout());
    }
    class ClickLogout implements View.OnClickListener{

        @Override
        public void onClick(View view) {
            if(view == logout){
                File file = new File("/data/data/com.example.user.loginandout/shared_prefs","LoginInfo.xml");
                file.delete();
                Intent reit = new Intent();
                reit.setClass(Logout.this,Login.class);
                startActivity(reit);
                Logout.this.finish();
            }
        }
    }
}
