<?php

require_once "env_config.php";

function connectToDatabase() {
    return new mysqli(SERVER, USER, PASSWORD, DATABASE,);
}
