"use strict";

export const maskCPF = (cpf) => {
    let maskedCpf = cpf.replace(/\D/g, "");

    maskedCpf = maskedCpf.replace(/(\d{3})(\d)/, "$1.$2");
    maskedCpf = maskedCpf.replace(/(\d{3})(\d)/, "$1.$2");
    maskedCpf = maskedCpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

    return maskedCpf;
};
