package com.example.projetoestacionamento

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Button
import android.widget.ImageButton
import android.widget.TextView
import android.widget.Toast
import com.google.gson.JsonObject
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response
import retrofit2.Retrofit
import retrofit2.converter.gson.GsonConverterFactory
import kotlin.properties.Delegates

private val JsonObject?.plate: Unit
    get() {}

var vehicleId by Delegates.notNull<Int>()

class DataDisplayActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_data_display)

        val intent: Intent = getIntent()
        vehicleId = intent.getIntExtra("vehicleId", 0)

//        displayData(vehicleId)

        val profileBtn = findViewById<ImageButton>(R.id.userProfile)

        profileBtn.setOnClickListener{
            val intent = Intent(this, ProfileActivity::class.java)
            startActivity(intent)
        }

        val previousBtn = findViewById<Button>(R.id.btnVoltar)

        previousBtn.setOnClickListener{
            finish()
        }

    }

//    private fun displayData(id : Int) {
//        val url = "http://localhost/projects/senai-fast-parking/api"
//        val retrofitClient = retrofitInstance(url)
//        val endpoint = retrofitClient.create(Endpoint::class.java)
//
//        endpoint.getData(id).enqueue(object : Callback<JsonObject> {
//
//            override fun onResponse(call: Call<JsonObject>, response: Response<JsonObject>) {
//                TODO("Not yet implemented")
//                val customerId = response.body()?.get("data")?.asJsonObject
//
//                val dataTextView = findViewById<TextView>(R.id.customerName)
//                dataTextView.setText(customerId.plate.toString())
//
//            }
//
//            override fun onFailure(call: Call<JsonObject>, t: Throwable) {
//                Toast.makeText(applicationContext, "Erro ao exibir os dados!", Toast.LENGTH_LONG)
//            }
//
//        })
//
//    }

    private fun retrofitInstance(url: String): Retrofit {
        return Retrofit
            .Builder()
            .baseUrl(url)
            .addConverterFactory(GsonConverterFactory.create())
            .build()
    }
}