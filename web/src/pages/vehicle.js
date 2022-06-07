"use strict";

import { fetchData } from "../services/fetch_data.js";
import { createCustomer, updateCustomer } from "../services/customer_service.js";

const container = document.getElementById("data-view-table");

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

const onFormSubmit = async (e) => {
    e.preventDefault();
    document.getElementById("user-form").reportValidity();

    const btnDataset = document.getElementById("submit-btn").dataset;

    const _id = btnDataset.id || "";

    const customer = {
        name: document.getElementById("name").value,
        email: document.getElementById("email").value,
        phone_number: document.getElementById("phone").value,
        cpf: document.getElementById("cpf").value,
        password: document.getElementById("password").value,
    };

    try {
        if (_id === "") {
            await createCustomer(customer);
        } else {
            await updateCustomer(customer, _id);

            setEditing(false);
        }
    } catch (err) {
        alert(err.message);
    }

    clearForm();
    updateTable();
};

const handleClick = async (e) => {
    const { target } = e;

    const [action, id] = target.id.split("-");

    if (action == "edit") {
        const res = await fetchData(`customers/${id}`);
        const customer = res.data;

        fillForm(customer);
        document.getElementById("submit-btn").dataset.id = id;
    }
};

const fillForm = (customer) => {
    document.getElementById("name").value = customer.name;
    document.getElementById("email").value = customer.email;
    document.getElementById("phone").value = customer.phone_number;
    document.getElementById("cpf").value = customer.cpf;
    document.getElementById("password").value = customer.password;

    setEditing(true);
};

const clearForm = () => {
    document.getElementById("name").value = "";
    document.getElementById("email").value = "";
    document.getElementById("phone").value = "";
    document.getElementById("cpf").value = "";
    document.getElementById("password").value = "";
};

const onCancel = (e) => {
    e.preventDefault();

    setEditing(false);
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
        clearForm();
    }
};

// events
updateTable();

document.getElementById("vehicle-form").addEventListener("submit", onFormSubmit);
document.getElementById("cancel-btn").addEventListener("click", onCancel);
document.getElementById("data-view-table").addEventListener("click", handleClick);
