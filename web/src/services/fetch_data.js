"use strict";

const baseURL = "http://localhost/projects/senai-fast-parking/api/v1/";

export const fetchData = async (endpoint) => {
    const res = await fetch(`${baseURL}customers/`);
    const data = await res.json();
    return data;
}