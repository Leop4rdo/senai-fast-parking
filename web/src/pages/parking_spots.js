"use strict";

import { fetchData } from "../services/fetch_data.js";
import { createParkingSpot, updateParkingSpot } from "../services/parking_spot_service.js";
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

/** handle click on edit and delete buttons */
const handleClick = async (e) => {
    const { target } = e;

    const [action, id] = target.id.split("-");

    if (action == "edit") {
        const res = await fetchData(`parking-spots/${id}`);
        const parkingSpot = res.data;

        fillForm(parkingSpot);
        document.getElementById("submit-btn").dataset.id = id;
    }
};

const onFormSubmit = async (e) => {
    e.preventDefault();
    document.getElementById("form").reportValidity();

    const btnDataset = document.getElementById("submit-btn").dataset;

    const _id = btnDataset.id || "";

    const parkingSpot = {
        name: document.getElementById("name").value,
        vehicle_type_id: document.getElementById("type").value,
    };

    let res;
    if (_id === "") {
        res = await createParkingSpot(parkingSpot);
    } else {
        res = await updateParkingSpot(parkingSpot, _id);
        setEditing(false);
    }

    alert(res.message);

    clearForm();
    updateTable();
};

const onCancel = (e) => {
    e.preventDefault();

    setEditing(false);
};

const fillForm = (parkingSpot) => {
    document.getElementById("name").value = parkingSpot.name;
    document.getElementById("type").value = parkingSpot.type.id;

    setEditing(true);
};

const clearForm = () => {
    document.getElementById("name").value = "";
    document.getElementById("type").value = 0;
};

const setEditing = (isEditing) => {
    const confirmBtn = document.getElementById("submit-btn");
    const cancelBtn = document.getElementById("cancel-btn");

    if (isEditing) {
        cancelBtn.disabled = false;
        confirmBtn.innerText = "editar";
    } else {
        cancelBtn.disabled = true;
        confirmBtn.innerText = "cadastrar";
        confirmBtn.removeAttribute("data-id");
        clearForm();
    }
};

// EVENTS
document.getElementById("name").addEventListener("keyup", (e) => (e.target.value = e.target.value.toUpperCase()));

updateTable();
fillSelect("type");

document.getElementById("data-view-table").addEventListener("click", handleClick);
document.getElementById("form").addEventListener("submit", onFormSubmit);
document.getElementById("cancel-btn").addEventListener("click", onCancel);
