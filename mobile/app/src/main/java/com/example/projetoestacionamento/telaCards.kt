package com.example.projetoestacionamento

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.ImageButton

class telaCards : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_tela_cards)

        val proxBtn = findViewById<ImageButton>(R.id.btnData1)

        proxBtn.setOnClickListener{
            val intent = Intent(this, DataDisplayActivity::class.java)
            startActivity(intent)
        }

        val userProfile = findViewById<ImageButton>(R.id.userProfile)

        userProfile.setOnClickListener{
            val intent = Intent(this, ProfileActivity::class.java)
            startActivity(intent)
        }

    }
}