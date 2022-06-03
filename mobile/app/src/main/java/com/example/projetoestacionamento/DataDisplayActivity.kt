package com.example.projetoestacionamento

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Button
import android.widget.ImageButton

class DataDisplayActivity : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_data_display)

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
}