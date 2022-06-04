class Sidebar extends HTMLElement {
    activeIndex = 0;

    constructor() {
        super();
        this.build();
    }

    build() {
        const shadowDOM = this.attachShadow({ mode: "open" });

        this.activeIndex = this.dataset.activeIndex;

        shadowDOM.append(this.render());
        shadowDOM.append(this.style());
    }

    style() {
        const styleTag = document.createElement("style");

        const styles = `
            .sidebar {
                height: 90vh;
                width: clamp(60px, 7.5vw, 120px);
            
                background-color: var(--dark);
            
                padding: 5vh 0;

                border-right: dashed 2px var(--primary);
            }
            
            .sidebar-nav {
                display: flex;
                flex-direction: column;
                gap: clamp(20px, 2.5vw, 25px);
            }
            
            .nav-item {
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
            
                position: relative;
            
                height: clamp(32px, 5vw, 64px);
            }
            
            .nav-item.active::before {
                content: "";
                display: block;
            
                background-color: var(--primary);
                width: 0.75vw;
                max-width: 8px;
                height: 100%;
            
                border-radius: 5px;
            
                position: absolute;
                left: 0;
            }
            
            .nav-item a {
                width: clamp(24px, 4vw, 48px);
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

        side.innerHTML = `
            <nav class="sidebar-nav">
                <div class="nav-item ${this.activeIndex == "0" ? "active" : ""}">
                    <a href="users.html">
                        <img src="assets/icons/users-${this.activeIndex == 0 ? "yellow" : "white"}.png" alt="usuarios" />
                    </a>
                </div>
                <div class="nav-item ${this.activeIndex == "1" ? "active" : ""}">
                    <a href="vehicles.html">
                        <img src="assets/icons/vehicle-${this.activeIndex == 1 ? "yellow" : "white"}.png" alt="usuarios" />
                    </a>
                </div>
                <div class="nav-item ${this.activeIndex == "2" ? "active" : ""}">
                    <a href="parking.html">
                        <img src="assets/icons/parking-${this.activeIndex == 2 ? "yellow" : "white"}.png" alt="usuarios" />
                    </a>
                </div>
                <div class="nav-item ${this.activeIndex == "3" ? "active" : ""}">
                    <a href="in-out.html">
                        <img src="assets/icons/in-out-${this.activeIndex == 3 ? "yellow" : "white"}.png" alt="usuarios" />
                    </a>
                </div>
                <div class="nav-item ${this.activeIndex == "4" ? "active" : ""}">
                    <a href="dashboard.html">
                        <img src="assets/icons/dashboard-${this.activeIndex == 4 ? "yellow" : "white"}.png" alt="usuarios" />
                    </a>
                </div>
            </nav>
        `;

        return side;
    }
}

customElements.define("sidebar-component", Sidebar);
