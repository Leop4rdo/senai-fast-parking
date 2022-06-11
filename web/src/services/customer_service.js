"use strict";

import { baseURL, fetchData } from "../services/fetch_data.js";

export const createCustomer = async (user) => {
    const config = {
        method: "POST",
        body: JSON.stringify(user),
        headers: {
            "content-type": "application/json",
        },
        mode: "cors",
    };

    const res = await fetch(`${baseURL}/customers`, config);
    return await res.json();
};

export const deleteCustomer = async (id) => {
    const options = { method: "DELETE" };

    const res = await fetch(`${baseURL}/customers/${id}`, options);

    return res.ok;
};

export const updateCustomer = async (customer, id) => {
    const config = {
        method: "PUT",
        body: JSON.stringify(customer),
        headers: {
            "content-type": "application/json",
        },
        mode: "cors",
    };

    const res = await fetch(`${baseURL}/customers/${id}`, config);
    return await res.json();
};

export const isCustomerCpfValid = async () => {
    const cpf = document.getElementById("cpf").value;

    const res = await fetchData(`customers?cpf=${cpf}`);
    return res.status == 200;
};
