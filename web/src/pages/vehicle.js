"use strict";

import { isCustomerCpfValid } from "../services/customer_service.js";
import { fetchData } from "../services/fetch_data.js";
import { createVehicle, updateVehicle } from "../services/vehicle_service.js";
import { maskCPF } from "../utils/masks.js";
import { fillSelect } from "../utils/utils.js";

const container = document.getElementById("data-view-table");

/** updates table content */
const updateTable = async () => {
    const vehicles = await fetchData("vehicles");

    const rows = [getTableHeader()];

    rows.push(
        ...vehicles.data.map((vehicle) => {
            const row = document.createElement("tr");

            row.innerHTML = `
                <td class="table-item">${vehicle.plate}</td>
                <td class="table-item">${vehicle.model.name}</td>
                <td class="table-item">${vehicle.colour.name}</td>
                <td class="table-item">${vehicle.customer.name}</td>
                <td class="table-item options">
                    <div class="edit-btn"><span class="material-icons" id="edit-${vehicle.id}">edit</span></div>
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
        <th class="table-header">Placa</th>
        <th class="table-header">Modelo</th>
        <th class="table-header">Cor</th>
        <th class="table-header">Dono</th>
        <th class="table-header">Opções</th>
    `;
    return header;
};

/** this function is responsible for creating or editing a record in the api */
const onFormSubmit = async (e) => {
    e.preventDefault();
    document.getElementById("vehicle-form").reportValidity();

    const btnDataset = document.getElementById("submit-btn").dataset;

    const _id = btnDataset.id || "";

    const cpf = document.getElementById("cpf").value;
    const isCpfValid = await isCustomerCpfValid(cpf);
    if (!isCpfValid) return alert("Cpf do cliente não encontrado");

    const customer = await fetchData(`customers?cpf=${cpf}`);

    const vehicle = {
        plate: document.getElementById("license-plate").value,
        vehicle_colour_id: document.getElementById("colour").value,
        vehicle_type_id: document.getElementById("type").value,
        vehicle_model_id: document.getElementById("model").value,
        customer_id: customer.data.id,
    };

    try {
        let res;
        if (_id === "") {
            res = await createVehicle(vehicle);
        } else {
            res = await updateVehicle(vehicle, _id);
            setEditing(false);
        }

        alert(res.message);
    } catch (err) {
        console.log(err.message);
    }

    clearForm();
    updateTable();
};

/** handle click on edit buttons */
const handleClick = async (e) => {
    const { target } = e;

    const [action, id] = target.id.split("-");

    if (action == "edit") {
        const res = await fetchData(`vehicles/${id}`);
        const vehicle = res.data[0];

        fillForm(vehicle);
        document.getElementById("submit-btn").dataset.id = id;
    }
};

const fillForm = (vehicle) => {
    document.getElementById("license-plate").value = vehicle.plate;
    document.getElementById("type").value = vehicle.type.id;
    document.getElementById("colour").value = vehicle.colour.id;
    document.getElementById("model").value = vehicle.model.id;
    document.getElementById("cpf").value = vehicle.customer.cpf;

    setEditing(true);
};

const clearForm = () => {
    document.getElementById("license-plate").value = "";
    document.getElementById("type").value = 1;
    document.getElementById("colour").value = 1;
    document.getElementById("model").value = 1;
    document.getElementById("cpf").value = "";
};

const onCancel = (e) => {
    e.preventDefault();

    setEditing(false);
};

const setEditing = (isEditing) => {
    const confirmBtn = document.getElementById("submit-btn");
    const cancelBtn = document.getElementById("cancel-btn");

    document.getElementById("model").disabled = isEditing;
    document.getElementById("type").disabled = isEditing;

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

// events
updateTable();
fillSelect("type");
fillSelect("colour");
fillSelect("model");

document.getElementById("license-plate").addEventListener("keyup", (e) => {
    e.target.value = e.target.value.toUpperCase();
});

document.getElementById("cpf").addEventListener("keypress", (e) => (e.target.value = maskCPF(e.target.value)));

document.getElementById("cpf").addEventListener("focusout", async (e) => {
    const { target } = e;

    const isValid = await isCustomerCpfValid();

    target.className = !isValid ? "invalid" : "";
});

document.getElementById("vehicle-form").addEventListener("submit", onFormSubmit);
document.getElementById("cancel-btn").addEventListener("click", onCancel);
document.getElementById("data-view-table").addEventListener("click", handleClick);
