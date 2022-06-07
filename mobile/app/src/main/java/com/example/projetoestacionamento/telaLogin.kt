package com.example.projetoestacionamento

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import com.example.projetoestacionamento.databinding.ActivityLoginBinding


class telaLogin : AppCompatActivity() {

    private lateinit var binding: ActivityLoginBinding

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        binding = ActivityLoginBinding.inflate(layoutInflater)

        val view = binding.root

        setContentView(view)

        binding.btnEntrar.setOnClickListener{
            val intent = Intent(this, telaCards::class.java)
            startActivity(intent)
        }

        }
}