import { baseURL } from "./fetch_data.js";

export const createVehicle = async (vehicle) => {
    const config = {
        method: "POST",
        body: JSON.stringify(vehicle),
        headers: {
            "content-type": "application/json",
        },
        mode: "cors",
    };

    const res = await fetch(`${baseURL}/vehicles`, config);
    return await res.json();
};

export const updateVehicle = async (vehicle, id) => {
    const config = {
        method: "PUT",
        body: JSON.stringify(vehicle),
        headers: {
            "content-type": "application/json",
        },
        mode: "cors",
    };

    const res = await fetch(`${baseURL}/vehicles/${id}`, config);
    return await res.json();
};
