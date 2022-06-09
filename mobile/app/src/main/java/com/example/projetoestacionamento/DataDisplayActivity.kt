package com.example.projetoestacionamento

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.*
import com.google.gson.JsonObject
import com.squareup.picasso.Picasso
import org.json.JSONObject
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response
import retrofit2.*
import retrofit2.converter.gson.GsonConverterFactory
import kotlin.properties.Delegates

var vehicleId: Int = 1

class DataDisplayActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_data_display)

        val intent: Intent = getIntent()
        vehicleId = intent.getIntExtra("vehicleId", 1)


        val debugging = findViewById<Button>(R.id.debugBtn)
        debugging.setOnClickListener {
            displayData(vehicleId)
        }

        val profileBtn = findViewById<ImageButton>(R.id.userProfile)

        profileBtn.setOnClickListener {
            val intent = Intent(this, ProfileActivity::class.java)
            startActivity(intent)
        }

        val previousBtn = findViewById<Button>(R.id.previousBtn)

        previousBtn.setOnClickListener {
            finish()
        }

    }


    private fun displayData(id: Int) {

        val url = "http://localhost/projects/senai-fast-parking/api/"
        val retrofitClient = retrofitInstance(url)
        val endpoint = retrofitClient.create(EndPoint::class.java)

        endpoint.getData(id).enqueue(object : Callback<JsonObject> {

            override fun onResponse(call: Call<JsonObject>, response: Response<JsonObject>) {

            val customerId = response.body()?.get("data")?.asString

            val dataTextView = findViewById<TextView>(R.id.carPlate)
            dataTextView.setText(customerId)

            }

            override fun onFailure(call: Call<JsonObject>, t: Throwable) {
                Toast.makeText(applicationContext, "Erro ao exibir os dados!", Toast.LENGTH_LONG)
            }

        })

    }

    private fun retrofitInstance(url: String): Retrofit {
        return Retrofit
            .Builder()
            .baseUrl(url)
            .addConverterFactory(GsonConverterFactory.create())
            .build()
    }
}