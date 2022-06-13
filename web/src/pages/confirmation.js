"use strict";

import { getURLParam } from "../utils/utils.js";

const id = getURLParam("id") || "NOT FOUND";

if (id === "NOT FOUND") document.location = "out.html";

const loadData = () => {};

loadData();
