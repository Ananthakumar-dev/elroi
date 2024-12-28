import axios from "axios";

const studentForm = document.getElementById("studentForm");
const baseUrl = document.querySelector("meta[name=site_url]").content;
const formType = location.pathname === "/student" ? "add" : "edit";

const removeErrors = () => {
    const errorElements = document.querySelectorAll(".error-msg");
    errorElements.forEach((el) => (el.innerText = ""));
};

studentForm.addEventListener("submit", async function (e) {
    e.preventDefault();

    removeErrors();
    const studentId = location.pathname.split("/").at(-1);
    const formUrl =
        formType === "add"
            ? `${baseUrl}/student`
            : `${baseUrl}/student/update/${studentId}`;
    const formValues = new FormData(e.target);

    try {
        const { data } = await axios.post(formUrl, formValues);

        if (data.status) {
            location.href = `${baseUrl}`;
        }
    } catch (error) {
        if (error.response) {
            const errors = error.response.data.errors;

            if (errors) {
                for (const key in errors) {
                    const el = document.getElementById(`error-${key}`);
                    if (el) el.innerText = `${errors[key]}`;
                }
            }
        }
    }
});
