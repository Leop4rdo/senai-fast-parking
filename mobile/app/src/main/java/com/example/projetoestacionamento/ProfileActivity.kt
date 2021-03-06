package com.example.projetoestacionamento

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Button

class ProfileActivity : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_profile)

        val previousBtn = findViewById<Button>(R.id.previousBtn)
        previousBtn.setOnClickListener{
            finish()
        }

        val exitBtn = findViewById<Button>(R.id.exitBtn)
        exitBtn.setOnClickListener{
            finishAffinity()
        }
    }
}