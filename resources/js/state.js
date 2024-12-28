import axios from "axios";
import Alpine from "alpinejs";

const baseUrl = document.querySelector("meta[name=site_url]").content;
const formType = location.pathname === "/student" ? "add" : "edit";

Alpine.store("stateStore", {
    activeState: "",
    states: [],
    async getStates(e) {
        const countryId = e.target.value;
        this.fetchState(countryId);
    },
    async fetchState(countryId) {
        const getStateurl = `${baseUrl}/states/${countryId}`;
        const { data } = await axios.get(getStateurl);

        if (data.status) {
            this.states = data.data;
        }
    },
    async init() {
        if (formType === "edit") {
            const country = document.getElementById("country").value;
            await this.fetchState(country);

            // Check if hidden_state is set and matches one of the fetched states
            const hiddenStateId = document.getElementById("hidden_state").value;
            if (hiddenStateId) {
                this.activeState = parseInt(hiddenStateId, 10);
            }
        }
    },
});
