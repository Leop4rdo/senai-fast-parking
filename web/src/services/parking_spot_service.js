"use strict";

import { baseURL, fetchData } from "../services/fetch_data.js";

export const createParkingSpot = async (parkingSpot) => {
    const config = {
        method: "POST",
        body: JSON.stringify(parkingSpot),
        headers: {
            "content-type": "application/json",
        }
    };
    
    const res = await fetch(`${baseURL}/parking-spots`, config);
    return await res.json();
};

export const updateParkingSpot = async (parkingSpot, id) => {
    const config = {
        method: "PUT",
        body: JSON.stringify(parkingSpot),
        headers: {
            "content-type": "application/json",
        }
    };
    console.log(config);

    const res = await fetch(`${baseURL}/parking-spots/${id}`, config);
    return await res.json();
};
