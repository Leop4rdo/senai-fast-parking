"use strict";

import { fetchData } from "../services/fetch_data.js";
import { fillSelect } from "../utils/utils.js";

const container = document.getElementById("data-view-table");

/** updates table content */
const updateTable = async () => {
    const spots = await fetchData("parking-spots");

    const rows = [getTableHeader()];

    rows.push(
        ...spots.data.map((spot) => {
            const row = document.createElement("tr");

            row.innerHTML = `
                <td class="table-item">${spot.name}</td>
                <td class="table-item">${spot.type.name}</td>
                <td class="table-item options">
                    <div class="delete-btn"><span class="material-icons" id="delete-${spot.id}">delete</span></div>
                    <div class="edit-btn"><span class="material-icons" id="edit-${spot.id}">edit</span></div>
                </td>
            `;
            return row;
        })
    );

    container.replaceChildren(...rows);
};

/** render the table header */
const getTableHeader = () => {
    const header = document.createElement("tr");
    header.innerHTML = `
        <th class="table-header">Nome</th>
        <th class="table-header">Tipo de vaga</th>
        <th class="table-header">Opções</th>
    `;
    return header;
};

// EVENTS
document.getElementById("name").addEventListener("keypress", (e) => (e.target.value = e.target.value.toUpperCase()));

updateTable();
fillSelect("type");
