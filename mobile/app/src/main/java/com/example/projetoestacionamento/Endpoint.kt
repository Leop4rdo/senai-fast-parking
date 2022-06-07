package com.example.projetoestacionamento

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import com.google.gson.JsonObject
import retrofit2.Call
import retrofit2.http.GET
import retrofit2.http.Path

interface Endpoint {
    @GET("/v1/vehicles/{id}")
    fun getData(@Path(value="id") id : Int) : Call<JsonObject>
}