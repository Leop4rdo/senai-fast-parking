"use strict";

export const baseURL = "http://localhost/projects/senai-fast-parking/api/v1";

export const fetchData = async (endpoint) => {
    try {
        const res = await fetch(`${baseURL}/${endpoint}`);
        const data = await res.json();

        return data;
    } catch (err) {
        throw err;
    }
};
