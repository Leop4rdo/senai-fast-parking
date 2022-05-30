<?php

// SERVER CONNECTION CONFIG ->
const SERVER = "localhost";
const USER = "root";
const PASSWORD = "bcd127";
const DATABASE = "db_fastparking";



function connectToDatabase() {
    return new mysqli(SERVER, USER, PASSWORD, DATABASE,);
}
