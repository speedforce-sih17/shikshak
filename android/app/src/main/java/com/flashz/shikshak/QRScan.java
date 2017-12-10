package com.flashz.shikshak;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.HashMap;
import java.util.Map;

public class QRScan extends AppCompatActivity {

    // UI Elements
    EditText tv_sd_uid,tv_sd_name,tv_sd_yob,tv_sd_co,tv_sd_vtc,tv_sd_po,tv_sd_dist,tv_sd_state,tv_sd_pc,tv_cancel_action,last_name,middle_name;

    Spinner job,field,state;
    String pass[];
    Button submit;
    EditText tv_sd_email,tv_sd_phone,tv_sd_pass;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_qrscan);

        Bundle b = this.getIntent().getExtras();
        pass = b.getStringArray("MY_KEY");

        // init the UI Elements
        tv_sd_uid = (EditText) findViewById(R.id.adhaar_id);
        tv_sd_name = (EditText) findViewById(R.id.first_name);
       // tv_sd_gender = (TextView) findViewById(R.id.gender);
        tv_sd_yob = (EditText) findViewById(R.id.date_birth);
       // tv_sd_co = (TextView) findViewById(R.id.tv_sd_co);
       // tv_sd_vtc = (TextView) findViewById(R.id.tv_sd_vtc);
      //  tv_sd_po = (TextView) findViewById(R.id.tv_sd_po);
      //  tv_sd_dist = (TextView) findViewById(R.id.tv_sd_dist);
      //  tv_sd_state = (TextView) findViewById(R.id.tv_sd_state);
      //  tv_sd_pc = (TextView) findViewById(R.id.tv_sd_pc);
        tv_sd_email = (EditText) findViewById(R.id.email);
        tv_sd_phone = (EditText) findViewById(R.id.phone);
        tv_sd_pass = (EditText) findViewById(R.id.password);
        last_name = (EditText)findViewById(R.id.last_name);
        middle_name = (EditText)findViewById(R.id.middle_name);
        job = (Spinner)findViewById(R.id.job);
        field = (Spinner)findViewById(R.id.field);
        state = (Spinner)findViewById(R.id.state);
        submit = (Button) findViewById(R.id.register);
 //       Log.v("response", "0");



//        takeRestInput();
          displayScannedData();

        submit.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                RequestQueue queue = Volley.newRequestQueue(getApplicationContext());
                String url = "http://6cda6a52.ngrok.io/shikshak/public/api/signup";
                StringRequest stringRequest = new StringRequest(Request.Method.POST, url,
                        new Response.Listener<String>() {
                            @Override
                            public void onResponse(String jsonStr) {
                                Toast.makeText(getApplicationContext(), jsonStr, Toast.LENGTH_LONG).show();
                            }
                        }, new Response.ErrorListener() {
                            @Override
                            public void onErrorResponse(VolleyError err) {
                                Toast.makeText(getApplicationContext(), err.getMessage(), Toast.LENGTH_LONG).show();
                            }
                        }) {
                    @Override
                    protected Map<String, String> getParams () {
                        Map<String, String> params = new HashMap<String, String>();
                        params.put("first_name",tv_sd_name.getText()+"");
//                        params.put("first_name","Bruce");

                        params.put("middle_name",middle_name.getText()+"");
                        params.put("last_name",last_name.getText()+"");
                        params.put("email",tv_sd_email.getText()+"");
                        params.put("phone",tv_sd_phone.getText()+"");
                        params.put("aadhar_id",tv_sd_uid.getText()+"");
                        params.put("birthdate","01/01/"+tv_sd_yob.getText()+"");
                        params.put("password",tv_sd_pass.getText()+"");

//                        params.put("middle_name",middle_name.getText()+"");
                        params.put("current_city_id", "1");
                        params.put("superannuation_age","60");
                        params.put("experience","2");
                        return params;
                    }
                };
                queue.add(stringRequest);

                Intent i = new Intent(getApplicationContext(),LoginActivity.class);
                startActivity(i);
            }
        });
    }

    public void displayScannedData(){
        // update UI Elements
        tv_sd_uid.setText(pass[0]);
        String str[],str2[];
        str = pass[1].split(" ");
        tv_sd_name.setText(str[0]);
        last_name.setText(str[1]);
      //  tv_sd_gender.setText(pass[2]);
        tv_sd_yob.setText(pass[3]);
        str2 = pass[4].split(" ");
        middle_name.setText(str2[1]);
      //  tv_sd_vtc.setText(pass[5]);
       // tv_sd_po.setText(pass[6]);
       // tv_sd_dist.setText(pass[7]);
       // tv_sd_state.setText(pass[8]);
       // tv_sd_pc.setText(pass[9]);
    }
}
