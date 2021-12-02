const validate_name = (name) => {
    const err_name = document.getElementById("err_name");

    if (name.length === 0) {
        err_name.innerText = "Name is required";
    } else if (name.length < 2) {
        err_name.innerText = "Name must be greater than 2 character";
    } else if (!name.match(/^[a-zA-Z-.]/g)) {
        err_name.innerText =
            "Name must be contains alpha character, (.) and (-)";
    } else {
        err_name.innerText = "";
        return true;
    }

    return false;
};

const validate_email = (email) => {
    const err_email = document.getElementById("err_email");

    if (email.length === 0) {
        err_email.innerText = "Email is required";
    } else if (
        !email.match(
            /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+(?:\.[a-zA-Z0-9-]+)*$/g
        )
    ) {
        err_email.innerText = "Email is not valid";
    } else {
        err_email.innerText = "";
        return true;
    }

    return false;
};

const validate_username = (username) => {
    const err_username = document.getElementById("err_username");

    if (username.length === 0) {
        err_username.innerText = "User Name is required";
    } else if (username.length < 2) {
        err_username.innerText = "User Name must be lager than 2 character";
    } else if (!username.match(/^([a-zA-z0-9_-]*)$/g)) {
        err_username.innerText =
            "User Name must be alphanumeric, dash (-) and Underscore (_)";
    } else {
        err_username.innerText = "";
        return true;
    }

    return false;
};

const validate_password = (password) => {
    const err_password = document.getElementById("err_password");

    if (password.length === 0) {
        err_password.innerText = "Password is required";
    } else if (password.length < 8) {
        err_password.innerText = "Password must be 8 characters or greater";
    } else if (!password.match(/[@#$%]+/g)) {
        err_password.innerText =
            "Password must include special characters (@ # $ %)";
    } else {
        err_password.innerText = "";
        return true;
    }

    return false;
};

const validate_cpassword = (cpassword, password) => {
    const err_cpassword = document.getElementById("err_cpassword");

    if (cpassword.length === 0) {
        err_cpassword.innerText = "Confirm Password is required";
    } else if (cpassword !== password) {
        err_cpassword.innerText = "Confirm Password must equal to Password";
    } else {
        err_cpassword.innerText = "";
        return true;
    }

    return false;
};

const validate_gender = (genders) => {
    const err_gender = document.getElementById("err_gender");

    // console.log(genders);

    for (let i = 0; i < genders.length; ++i) {
        if (genders[i].checked) {
            err_gender.innerText = "";

            if (!genders[i].value.trim().match(/(male|female|other)/g)) {
                err_gender.innerText = "Gender is not valid";
            } else {
                err_gender.innerText = "";
                break;
            }
        } else {
            err_gender.innerText = "Gender is required";
        }
    }

    return err_gender.innerText.length === 0;
};

const validate_dob = (dob) => {
    const err_dob = document.getElementById("err_dob");

    if (dob.length === 0) {
        err_dob.innerText = "Date of birth is required";
    } else if (!dob.match(/^\d{4}-\d{2}-\d{2}$/g)) {
        err_dob.innerText = "Date of birth is not valid";
    } else {
        err_dob.innerText = "";
        return true;
    }

    return false;
};

const validate_duplication_email = (email) => {
    const err_email = document.getElementById("err_email");
    const xhttp = new XMLHttpRequest();

    xhttp.onload = function () {
        // console.log(this.responseText);
        if (this.status === 200 && this.readyState === 4) {
            const res = JSON.parse(this.responseText.trim());
            // console.log(res);

            if (res.error && (res.error.email || res.error.is_duplicate)) {
                err_email.innerText = res.error.email.trim();
            } else {
                err_email.innerText = "";
            }
        } else {
            err_email.innerText = "Server Error";
        }
    };

    xhttp.open("GET", `controller/AjaxController.php?email=${email}`, true);
    xhttp.send(null);
};

document.addEventListener("DOMContentLoaded", () => {
    console.log("Ready");

    const registration_form = document.forms["registration-form"];
    const edit_profile_form = document.forms["edit-profile-form"];

    if (registration_form) {
        const name = registration_form["name"];
        const email = registration_form["email"];
        const username = registration_form["username"];
        const password = registration_form["password"];
        const cpassword = registration_form["cpassword"];
        const genders = registration_form["gender"];
        const dob = registration_form["dob"];
        const registration_btn = registration_form["registration-btn"];

        // console.log(name, email, username, password, cpassword, genders, dob, registration_btn);
        // console.log(genders);

        name.addEventListener("keyup", (e) => {
            e.preventDefault();
            validate_name(e.target.value.trim());
        });

        email.addEventListener("change", (e) => {
            e.preventDefault();
            validate_duplication_email(e.target.value.trim());
        });

        email.addEventListener("keyup", (e) => {
            e.preventDefault();
            validate_email(e.target.value.trim());
        });

        username.addEventListener("keyup", (e) => {
            e.preventDefault();
            validate_username(e.target.value.trim());
        });

        password.addEventListener("keyup", (e) => {
            e.preventDefault();
            validate_password(e.target.value.trim());
        });

        cpassword.addEventListener("keyup", (e) => {
            e.preventDefault();
            validate_cpassword(e.target.value.trim(), password.value.trim());
        });

        genders.forEach((gender) => {
            gender.addEventListener("change", (e) => {
                e.preventDefault();
                validate_gender(genders);
            });
        });

        dob.addEventListener("change", (e) => {
            e.preventDefault();
            validate_dob(e.target.value.trim());
        });

        document.addEventListener("submit", (e) => {
            e.preventDefault();

            validate_name(name.value.trim());
            validate_email(email.value.trim());
            validate_username(username.value.trim());
            validate_password(password.value.trim());
            validate_cpassword(cpassword.value.trim(), password.value.trim());

            validate_gender(genders);

            validate_dob(dob.value.trim());

            if (
                validate_name(name.value.trim()) &&
                validate_email(email.value.trim()) &&
                validate_username(username.value.trim()) &&
                validate_password(password.value.trim()) &&
                validate_cpassword(
                    cpassword.value.trim(),
                    password.value.trim()
                ) &&
                validate_gender(genders) &&
                validate_dob(dob.value.trim())
            ) {
                e.target.submit();
            }
        });
    }

    if (edit_profile_form) {
        const name = edit_profile_form["name"];
        const email = edit_profile_form["email"];
        const genders = edit_profile_form["gender"];
        const dob = edit_profile_form["dob"];
        const edit_btn = edit_profile_form["edit"];

        // console.log(name, email, genders, dob, edit_btn);

        name.addEventListener("keyup", (e) => {
            e.preventDefault();
            validate_name(e.target.value.trim());
        });

        email.addEventListener("change", (e) => {
            e.preventDefault();
            validate_duplication_email(e.target.value.trim());
        });

        email.addEventListener("keyup", (e) => {
            e.preventDefault();
            validate_email(e.target.value.trim());
        });

        genders.forEach((gender) => {
            gender.addEventListener("change", (e) => {
                e.preventDefault();
                validate_gender(genders);
            });
        });

        dob.addEventListener("change", (e) => {
            e.preventDefault();
            validate_dob(e.target.value.trim());
        });
    }
});
