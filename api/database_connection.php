<?php

const SERVER = "localhost";
const USER = "root";
const PASSWORD = "root";
const DATABASE = "db_fastparking";

function connectToDatabase() {
    return new mysqli(SERVER, USER, PASSWORD, DATABASE,);
}