"use strict";

import { fetchData } from "../services/fetch_data.js";

/** fill select input with data from api */
export const fillSelect = async (selectId) => {
    const select = document.getElementById(selectId);

    const { type } = select.dataset;

    const optionsData = await fetchData(type);

    const options = optionsData.data.map(({ id, name }) => {
        return `<option value="${id}">${name}</option>`;
    });

    select.innerHTML = options.join();
};
