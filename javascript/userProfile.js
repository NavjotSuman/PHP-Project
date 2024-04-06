
let changePass_start = () => {
    let update = document.querySelector(".update-btn");
    let prePassword = document.querySelector("#prepassword");

    update.addEventListener('click', (e) => {
        e.preventDefault();

        let PrePassDiv = document.querySelector(".username");
        let prePassword_value = prePassword.value;
        // console.log(prePassword_value)

        let fetchValue = {
            "prePassword": `${prePassword_value}`,
        }

        fetch("phpDatabase/checkPrePass.php", {
            method: "POST",
            body: JSON.stringify(fetchValue),
            headers: {
                "Content-type": "application/json",
            }
        }).then((Response) => {
            return Response.json();
        }).then((data) => {
            if (data.prePassword == "true") {
                console.log("true password")
                newPass();
            }

        }).catch((error) => {
            if (!(PrePassDiv.getAttribute("data-detect") == "true")) {
                PrePassDiv.innerHTML += `<small style="color: red; font-weight:500;">Incorrect Password!!</small>`;
                PrePassDiv.setAttribute("data-detect", "true");
                changePass_start();
            }
            changePass_start();
        })
    })

}

changePass_start();

let newPass = () => {
    let form = document.getElementsByTagName("form")[0];
    form.innerHTML = `<div class="Newpassword">
    <div class="npass">
        <label for="npass">New Password</label>
        <input type="password" name="npass" id="npass" value="" placeholder="New Password" class="input-box" required>
    </div>
    <div class="cpass">
        <label for="cpass">Confirm Password</label>
        <input type="text" name="cpass" id="cpass" value="" class="input-box" placeholder="Confirm Password" required>
    </div>
</div> 
 <div class="button">
    <div class="update">
        <button type="submit" class="change-password-btn change-password">Change Password</button>
    </div>
</div>`;

    let issame = document.getElementsByClassName("cpass")[0];
    let changePass = document.querySelector(".change-password-btn");
    changePass.addEventListener('click', (e) => {
        e.preventDefault();

        let nPass = document.querySelector("#npass").value;
        let cpass = document.querySelector("#cpass").value;
        let newPassDiv = document.querySelector(".Newpassword");

        if (nPass === cpass) {

            let fetchValue = {
                "nPass": `${nPass}`,
                "cPass": `${cpass}`,
            }

            fetch("phpDatabase/update_password.php", {
                method: "POST",
                body: JSON.stringify(fetchValue),
                headers: {
                    "Content-type": "application/json",
                }
            }).then((Response) => {
                return Response.json();
            }).then((data) => {
                if (data.updated == "success") {
                    // console.log("updated Password");
                    window.location.href = "userProfile.php";
                }
            })

        }
        else {
            if (!(issame.getAttribute("data-detect"))) {
                issame.innerHTML += `<small style="color: red; font-weight:500;">Password doesn't match!!</small>`
                issame.setAttribute("data-detect", "true");
            }
        }
    })
}