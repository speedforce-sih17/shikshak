package com.flashz.shikshak;

import android.content.Context;
import android.content.DialogInterface;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.NavigationView;
import android.support.design.widget.Snackbar;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class Successful extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener {

    ListView doctorList; //Storing listview fetched from vacancy database
    ArrayList<String> names;
    ArrayList<String> title;
    ArrayList<String> qualification;
    ArrayList<String> description;
    ArrayList<Integer> vacancy_id;

    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_successful);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Snackbar.make(view, "Replace with your own action", Snackbar.LENGTH_LONG)
                        .setAction("Action", null).show();
            }
        });

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.setDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

        names = new ArrayList<String>();
        title = new ArrayList<>();
        qualification = new ArrayList<>();
        description = new ArrayList<>();
        vacancy_id = new ArrayList<Integer>();

        //Connecting to volley to contact with server
        RequestQueue queue = Volley.newRequestQueue(getApplicationContext());
        String url = "http://6cda6a52.ngrok.io/shikshak/public/api/vacancies/9"; // vacancy database link
        StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String jsonStr) {
                        try{
                            JSONObject obj = new JSONObject(jsonStr);
                            JSONArray vacancies = obj.getJSONArray("vacancies");
                            for(int i=0;i<vacancies.length();i++){
                                JSONObject obj2 = vacancies.getJSONObject(i);
                                String name = obj2.getString("institute");
                                String title_local = obj2.getString("title");
                                String qualification_local = obj2.getString("qualification");
                                String description_local = obj2.getString("description");
                                int vacancy_id_local = obj2.getInt("id");
                                Toast.makeText(getApplicationContext(),name,Toast.LENGTH_LONG).show();
                                names.add(name);
                                title.add(title_local);
                                qualification.add(qualification_local);
                                description.add(description_local);
                                vacancy_id.add(vacancy_id_local);
                            }

                            doctorList = (ListView) findViewById(R.id.listView);
                            MyAdapter adapter = new MyAdapter(Successful.this, names, title, qualification);
                            doctorList.setAdapter(adapter);
                            doctorList.setOnItemClickListener(new AdapterView.OnItemClickListener() {
                                @Override
                                public void onItemClick(AdapterView<?> parent, View view, final int position, long id) {


                                    AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(Successful.this);
                                    alertDialogBuilder.setTitle("Vacancy");
                                    alertDialogBuilder.setMessage(description.get(position));
                                    alertDialogBuilder.setPositiveButton("yes",
                                            new DialogInterface.OnClickListener() {
                                                @Override
                                                public void onClick(DialogInterface arg0, int arg1) {
                                                    Toast.makeText(getApplicationContext(),"You clicked yes button",Toast.LENGTH_LONG).show();
                                                    int v_id = vacancy_id.get(position);
                                                    String url2 = "http://6cda6a52.ngrok.io/shikshak/public/api/matchForVacancy/"+ v_id +"/9";
                                                    RequestQueue queue2 = Volley.newRequestQueue(getApplicationContext());
                                                    StringRequest stringRequest2 = new StringRequest(Request.Method.GET, url2,
                                                            new Response.Listener<String>() {
                                                                @Override
                                                                public void onResponse(String jsonStr) {
                                                                    Toast.makeText(getApplicationContext(), jsonStr, Toast.LENGTH_LONG).show();
                                                                    finish();
                                                                    startActivity(getIntent());
                                                                }
                                                            }, new Response.ErrorListener() {
                                                        @Override
                                                        public void onErrorResponse(VolleyError err) {
                                                            Toast.makeText(getApplicationContext(), err.getMessage(), Toast.LENGTH_LONG).show();
                                                        }
                                                    });
                                                    queue2.add(stringRequest2);
                                                }
                                            });

                                    alertDialogBuilder.setNegativeButton("No",new DialogInterface.OnClickListener() {
                                        @Override
                                        public void onClick(DialogInterface dialog, int which) {
                                            finish();
                                        }
                                    });

                                    AlertDialog alertDialog = alertDialogBuilder.create();
                                    alertDialog.show();
                                }
                            });

                        }catch (JSONException e){
                            e.printStackTrace();
                        }
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError err) {
                Toast.makeText(getApplicationContext(), err.getStackTrace()+"", Toast.LENGTH_LONG).show();
            }
        });
        queue.add(stringRequest);
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

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.successful, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();

        if (id == R.id.nav_vacancy) {

        } else if (id == R.id.nav_Applied_Institutes) {

        } else if (id == R.id.nav_admits) {

        } else if (id == R.id.nav_match) {

        } else if (id == R.id.nav_share) {

        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }


}

class MyAdapter extends ArrayAdapter<String> {
    Context con;
    ArrayList<String> name;
    ArrayList<String> clinicName;
    ArrayList<String> clinicAddress;

    MyAdapter(Context c , ArrayList<String> names, ArrayList<String> clinicName , ArrayList<String> clinicAdd){
        super(c,R.layout.single_row,R.id.textView2,names);
        this.con = c;
        this.name = names;
        this.clinicAddress = clinicAdd;
        this.clinicName = clinicName;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {

        LayoutInflater inflater = (LayoutInflater) con.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View row = inflater.inflate(R.layout.single_row,parent,false);
        TextView doctorName = (TextView) row.findViewById(R.id.textView2);
        TextView clinicName1 = (TextView) row.findViewById(R.id.textView3);
        TextView clinicAddress1 = (TextView) row.findViewById(R.id.textView4);
        doctorName.setText(name.get(position));
        clinicName1.setText(clinicName.get(position));
        clinicAddress1.setText(clinicAddress.get(position));
        return row;
    }

//    public void reload()
}

