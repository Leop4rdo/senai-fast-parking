"use strict";

import { fetchData } from "../services/fetch_data.js";
import { createCustomer, updateCustomer } from "../services/customer_service.js";

const container = document.getElementById("data-view-table");

const renderUsers = async () => {
    const users = await fetchData("customers/");

    const usersRows = [getTableHeader()];

    usersRows.push(
        ...users.data.map((user) => {
            const row = document.createElement("tr");

            row.innerHTML = `
            <td class="table-item">${user.name}</td>
            <td class="table-item">${user.email}</td>
            <td class="table-item">${user.cpf}</td>
            <td class="table-item">${user.phone_number}</td>
            <td class="table-item options">
                <div class="edit-btn"><span class="material-icons" id="edit-${user.id}">edit</span></div>
            </td>
        `;
            return row;
        })
    );

    container.replaceChildren(...usersRows);
};

const getTableHeader = () => {
    const header = document.createElement("tr");
    header.innerHTML = `
        <th class="table-header">Nome</th>
        <th class="table-header">Email</th>
        <th class="table-header">CPF</th>
        <th class="table-header">Telefone</th>
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
    renderUsers();
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
renderUsers();

document.getElementById("user-form").addEventListener("submit", onFormSubmit);
document.getElementById("cancel-btn").addEventListener("click", onCancel);
document.getElementById("data-view-table").addEventListener("click", handleClick);
