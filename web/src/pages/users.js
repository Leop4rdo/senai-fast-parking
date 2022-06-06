"use strict";

import { fetchData } from "../services/fetch_data.js";
import { createCustomer, deleteCustomer } from "../services/customer_service.js";

const container = document.getElementById("data-view-table");

const renderUsers = async () => {
    const users = await fetchData("customers/");

    const usersRows = [getTableHeader()]

    usersRows.push(...users.data.map((user) => {
        const row = document.createElement("tr");
        
        row.innerHTML = `
            <td class="table-item">${user.name}</td>
            <td class="table-item">${user.email}</td>
            <td class="table-item">096.676.210-06</td>
            <td class="table-item">${user.phone_number}</td>
            <td class="table-item options">
                <div class="delete-btn" ><span class="material-icons" id="delete-${user.id}">delete</span></div>
                <div class="edit-btn"><span class="material-icons" id="edit-${user.id}">edit</span></div>
            </td>
        `;
        return row;
    }))

    container.replaceChildren(...usersRows);
}

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
}

const onFormSubmit = async (e) => {
    e.preventDefault();

    const user = {
        name : document.getElementById("name").value,
        email : document.getElementById("email").value,
        phone_number : document.getElementById("phone").value,
        password : document.getElementById("password").value
    }

    console.log(JSON.stringify(user));

    const res = await createCustomer(user);
    
    alert(res.message);

    renderUsers();
}

const handleClick = async (e) => {
    const { target } = e;


    const [ action, id ] = target.id.split("-");

    console.log(action)

    if (action == "delete") {
        if (!confirm("Deseja mesmo excluir esse cliente?")) return;

        const res = await deleteCustomer(id);
        await renderUsers();

        if (!res) alert("error na exclusão");
    }
}


// events
renderUsers();

document.getElementById("user-form").addEventListener("submit", onFormSubmit);
document.getElementById("data-view-table").addEventListener("click", handleClick);