"use strict";

import { baseURL, fetchData } from "../services/fetch_data.js";

export const createParkingSpot = async (parkingSpot) => {
    const config = {
        method: "POST",
        body: JSON.stringify(parkingSpot),
        headers: {
            "content-type": "application/json",
        },
    };

    const res = await fetch(`${baseURL}/parking_spots`, config);
    return await res.json();
};

export const updateParkingSpot = async (parkingSpot, id) => {
    const config = {
        method: "PUT",
        body: JSON.stringify(parkingSpot),
        headers: {
            "content-type": "application/json",
        },
    };

    const res = await fetch(`${baseURL}/parking_spots/${id}`, config);
    return await res.json();
};
