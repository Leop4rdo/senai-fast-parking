package com.example.projetoestacionamento

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.view.View
import android.widget.*
import androidx.cardview.widget.CardView
import com.example.projetoestacionamento.databinding.ActivityLoginBinding
import com.google.gson.JsonObject
import com.squareup.picasso.Picasso
import org.json.JSONObject
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response
import retrofit2.*
import retrofit2.converter.gson.GsonConverterFactory
import kotlin.properties.Delegates

class DataDisplayActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_data_display)

        var vehicleId = 1
        var dogBreed = "mexicanhairless"

//        val intent: Intent = getIntent()
//        vehicleId = intent.getIntExtra("vehicleId", 1)

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
//        val url = "https://dog.ceo/"
        val retrofitClient = retrofitInstance(url)
        val endpoint = retrofitClient.create(EndPoint::class.java)

        endpoint.getData(id).enqueue(object : Callback<JsonObject> {
//        endpoint.getDog(id).enqueue(object : Callback<JsonObject> {

            override fun onResponse(call: Call<JsonObject>, response: Response<JsonObject>) {
            val vehicleData = response.body()?.get("data")?.asString
//            val urlImage  = response.body()?.get("message")?.asString

            val plateTextView = findViewById<TextView>(R.id.carPlate)

//            val pfp = findViewById<ImageButton>(R.id.userProfile)
//            Picasso.get().load(urlImage).into(pfp)
//            plateTextView.setText(urlImage?.length.toString())

            plateTextView.setText(vehicleData?.length.toString())

            }

            override fun onFailure(call: Call<JsonObject>, t: Throwable) {
                Toast.makeText(applicationContext, "Erro ao exibir os dados!", Toast.LENGTH_LONG).show()

                val vehicleData = t.message

                val thrownMessage = findViewById<TextView>(R.id.thrownMessage)
                thrownMessage.setText(vehicleData)

                val t1 = findViewById<TextView>(R.id.name)
                val tv1 = findViewById<TextView>(R.id.customerName)

                val t2 = findViewById<TextView>(R.id.plate)
                val tv2 = findViewById<TextView>(R.id.carPlate)

                val t3 = findViewById<TextView>(R.id.model)
                val tv3 = findViewById<TextView>(R.id.carModel)

                val t4 = findViewById<TextView>(R.id.parkingSpot)
                val tv4 = findViewById<TextView>(R.id.currentParkingSpot)

                val t5 = findViewById<TextView>(R.id.entrance)
                val tv5 = findViewById<TextView>(R.id.timeEntrance)

                val cv = findViewById<CardView>(R.id.cardViewColour)

                cv.setVisibility(View.GONE)

                t1.setVisibility(View.GONE)
                tv1.setVisibility(View.GONE)

                t2.setVisibility(View.GONE)
                tv2.setVisibility(View.GONE)

                t3.setVisibility(View.GONE)
                tv3.setVisibility(View.GONE)

                t4.setVisibility(View.GONE)
                tv4.setVisibility(View.GONE)

                t5.setVisibility(View.GONE)
                tv5.setVisibility(View.GONE)

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