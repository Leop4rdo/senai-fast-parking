"use strict";

import { baseURL, fetchData } from "../services/fetch_data.js";
import { getURLParam } from "../utils/utils.js";

const id = getURLParam("id") || "NOT FOUND";

if (id === "NOT FOUND") document.location = "out.html";

const loadData = async () => {
    const vehicleInOut = await fetchData(`vehicle-in-out/${id}`);
    const vehicle = await fetchData(`vehicles/${vehicleInOut.data[0].vehicle.id}`);
    const vehicleType = await fetchData(`vehicle-types/${vehicle.data[0].type.id}`);
    const parkingSpot = await fetchData(`parking-spots/${vehicleInOut.data[0].parking_spot.id}`);

    const now = Date.now();
    const deltaTime = getDeltaTime(Date.parse(vehicleInOut.data[0].entrance_time), now);
    const totalPrice = calculateTotalPrice(deltaTime, vehicleType.data.price);

    const formatedDeltaTime = formatDeltaTime(deltaTime);

    document.getElementById("delta-time").textContent = formatedDeltaTime;
    document.getElementById("total-price").textContent = "R$ " + totalPrice;

    /////////////// VEHICLE CARD ///////////////
    document.getElementById("vehicle-license-plate").textContent = vehicle.data[0].plate;
    document.getElementById("vehicle-model").textContent = vehicle.data[0].model.name;
    document.getElementById("vehicle-colour").textContent = vehicle.data[0].colour.name;
    document.getElementById("vehicle-type").textContent = vehicleType.data.name;
    ////////////////////////////////////////////

    //////////// PARKING SPOT CARD /////////////
    document.getElementById("parking-spot").textContent = parkingSpot.data.name;
    document.getElementById("hour-price").textContent = vehicleType.data.price;
    ////////////////////////////////////////////

    //////////////// CUSTOMER //////////////////
    const { name, email, phone_number, cpf } = vehicle.data[0].customer;
    document.getElementById("customer").textContent = name;
    document.getElementById("email").textContent = email;
    document.getElementById("phone").textContent = phone_number;
    document.getElementById("cpf").textContent = cpf;
    ////////////////////////////////////////////
};

const getDeltaTime = (entrance, exit) => {
    console.log(entrance, exit);
    return exit - entrance;
};

const formatDeltaTime = (delta) => {
    const dateObj = new Date(delta);
    const timeString = `${dateObj.getUTCHours()} : ${dateObj.getUTCMinutes()} : ${dateObj.getUTCSeconds()}`;

    return timeString;
};

const calculateTotalPrice = (delta, price) => {
    const deltaHours = Math.round(delta / 36e5);

    return deltaHours > 0 ? deltaHours * price : price;
};

loadData();

document.getElementById("confirm").addEventListener("click", async () => {
    const config = {
        method: "PUT",
        headers: {
            "content-type": "application/json",
        },
        mode: "cors",
    };
});
