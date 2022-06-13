"use strict";

import { fetchData } from "../services/fetch_data.js";

const container = document.getElementById("data-view-table");

let selectedId = 0;

const updateTable = async () => {
    const vehicles = await fetchData("vehicle-in-out");

    const parkedVehicles = vehicles.data.filter((vehicle) => vehicle.exit_time === null);

    const rows = [getTableHeader()];

    console.log(parkedVehicles);

    rows.push(
        ...parkedVehicles.map(({ id, vehicle, parking_spot }) => {
            const row = document.createElement("tr");

            // handling selection
            row.onclick = () => {
                selectedId = selectedId === id ? 0 : id;
                updateTable();
            };

            row.classList.add(selectedId === id ? "selected" : "row");

            row.innerHTML = `
                <td class="table-item">${vehicle.plate}</td>
                <td class="table-item">${parking_spot.name}</td>
            `;
            return row;
        })
    );

    container.replaceChildren(...rows);

    document.getElementById("next").disabled = selectedId == 0;
};

/** render the table header */
const getTableHeader = () => {
    const header = document.createElement("tr");
    header.innerHTML = `
        <th class="table-header">Placa</th>
        <th class="table-header">vaga</th>
    `;
    return header;
};

const openConfirmationPage = () => {
    document.location = `confirmation.html?id=${selectedId}`;
};

updateTable();
document.getElementById("next").addEventListener("click", openConfirmationPage);
