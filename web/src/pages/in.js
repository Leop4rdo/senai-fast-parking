"use strict";

import { baseURL, fetchData } from "../services/fetch_data.js";
import { fillSelect } from "../utils/utils.js";

const onFormSubmit = async (e) => {
    e.preventDefault();
    e.target.reportValidity();

    if (!isLicensePlateValid()) return;

    const license = document.getElementById("license-plate").value;
    const res = await fetchData(`vehicles?plate=${license}`);
    if (res.message) return;

    const vehicleId = res.data[0].id;

    const reqBody = {
        vehicle_id: vehicleId,
        parking_spot_id: document.getElementById("parking-spot").value,
    };

    const config = {
        method: "POST",
        body: JSON.stringify(reqBody),
        headers: {
            "content-type": "application/json",
        },
        mode: "cors",
    };

    try {
        const res = await fetch(`${baseURL}/vehicle-in-out`, config);
        const data = await res.json();

        alert(data.message);
    } catch (err) {
        alert(err.message);
    }

    document.getElementById("license-plate").value = "";
};

const isLicensePlateValid = async () => {
    const license = document.getElementById("license-plate").value;

    const res = await fetchData(`vehicles?plate=${license}`);
    return res.status == 200;
};

// EVENTS
fillSelect("parking-spot");

document.getElementById("license-plate").addEventListener("focusout", async (e) => {
    const { target } = e;

    const isValid = await isLicensePlateValid();

    target.className = !isValid ? "invalid" : "";
});

document.getElementById("license-plate").addEventListener("keyup", (e) => {
    e.target.value = e.target.value.toUpperCase();
});

document.getElementById("form").addEventListener("submit", onFormSubmit);
