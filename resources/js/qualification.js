import Alpine from "alpinejs";

const baseUrl = document.querySelector("meta[name=site_url]").content;
const formType = location.pathname === "/student" ? "add" : "edit";
const initialQualification = {
    id: "",
    qualification_id: "",
    year_of_passing: "",
    university: "",
};

Alpine.store("qualificationStore", {
    qualification: [initialQualification],
    add() {
        const newQualification = { ...initialQualification }; // Clone the object
        this.qualification = [...this.qualification, newQualification];
    },
    remove(index) {
        if (index >= 0 && index < this.qualification.length) {
            this.qualification.splice(index, 1);
            this.qualification = [...this.qualification];
        }
    },
    async init() {
        if (formType === "edit") {
            const studentId = location.pathname.split("/").at(-1);
            const getQualificationurl = `${baseUrl}/qualifications/${studentId}`;
            const { data } = await axios.get(getQualificationurl);

            // Ensure unique IDs
            this.qualification = data.data.map((item, index) => ({
                ...item,
                id: item.id || index,
            }));
        }
    },
});

Alpine.start();
