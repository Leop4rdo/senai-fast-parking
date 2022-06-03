"use strict";

class Sidebar extends HTMLElement {
    constructor() {
        super();

        this.build();
    }

    build() {
        const shadowDOM = this.attachShadow({ mode: "open" });
        shadowDOM.append(this.style());
        shadowDOM.append(this.render());
    }

    style() {
        const styleTag = document.createElement("style");

        const styles = `
            .sidebar {
                height: 100vh;
                width: clamp(100px, 7.5vw, 200px);
            
                background-color: var(--dark);
            
                padding: clamp(20px, 5vh, 50px) 0;
            }
            
            .sidebar-nav {
                display: flex;
                flex-direction: column;
                gap: 5vh;
            }
            
            .nav-item {
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
            
                position: relative;
            
                height: 6vh;
            }
            
            .nav-item.active::before {
                content: "";
                display: block;
            
                background-color: var(--primary);
                width: 0.75vw;
                max-width: 10px;
                height: 100%;
            
                border-radius: 5px;
            
                position: absolute;
                left: 0;
            }
            
            .nav-item a {
                width: clamp(32px, 4vw, 64px);
            }
            
            .nav-item a > img {
                width: 100%;
            }
        `;

        styleTag.innerText = styles;

        return styleTag;
    }

    render() {
        const side = document.createElement("div");
        side.classList.add("sidebar");

        const { activeIndex } = this.dataset;

        side.innerHTML = `
        <nav class="sidebar-nav">
            <div class="nav-item ${activeIndex === 0 ? "active" : ""}">
                <a href="/">
                    <img src="assets/icons/users-${activeIndex === 0 ? "yellow" : "white"}.png" alt="usuarios" />
                </a>
            </div>
            <div class="nav-item ${activeIndex === 1 ? "active" : ""}">
                <a href="/">
                    <img src="assets/icons/vehicle-${activeIndex === 1 ? "yellow" : "white"}.png" alt="usuarios" />
                </a>
            </div>
            <div class="nav-item ${activeIndex === 2 ? "active" : ""}">
                <a href="/">
                    <img src="assets/icons/parking-${activeIndex === 2 ? "yellow" : "white"}.png" alt="usuarios" />
                </a>
            </div>
            <div class="nav-item ${activeIndex === 3 ? "active" : ""}">
                <a href="/">
                    <img src="assets/icons/in-out-${activeIndex === 3 ? "yellow" : "white"}.png" alt="usuarios" />
                </a>
            </div>
            <div class="nav-item ${activeIndex === 4 ? "active" : ""}">
                <a href="/">
                    <img src="assets/icons/dashboard-${activeIndex === 4 ? "yellow" : "white"}.png" alt="usuarios" />
                </a>
            </div>
        </nav>
        `;

        return side;
    }
}

customElements.define("sidebar-component", Sidebar);
