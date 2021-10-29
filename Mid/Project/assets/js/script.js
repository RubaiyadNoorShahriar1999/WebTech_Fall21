console.log("Ready");

const form = document.getElementById("deleteuserform");
const delete_button = document.getElementById("deleteuser");

delete_button.addEventListener('click', (e) => {
    e.preventDefault();

    if (confirm("Are you sure you want to delete ?")) {
        form.submit();
    }

})