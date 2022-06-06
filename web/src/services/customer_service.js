"use strict";

const baseURL = "http://localhost/projects/senai-fast-parking/api/v1";


export const createCustomer = async (user) => {
    const config = {
        method: 'POST',
        body: JSON.stringify(user),
        headers: {
            "content-type": "application/json",
        },
        mode: "cors"
    }

    console.log(config);

    const res = await fetch(`${baseURL}/customers/`, config);
    return await res.json() 
}

export const deleteCustomer = async (id) => {
    const options = { method: "DELETE" };

    const res = await fetch(`${baseURL}/customers/${id}`, options);

    return res.ok;
}