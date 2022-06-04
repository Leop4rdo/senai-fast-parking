"use strict";

import { fetchData } from "../services/fetch_data.js";

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
                <div class="delete-btn"><span class="material-icons">delete</span></div>
                <div class="edit-btn"><span class="material-icons">edit</span></div>
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

renderUsers();