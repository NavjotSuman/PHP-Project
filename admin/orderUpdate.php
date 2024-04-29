<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("location: index.php");
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/userProfile.css">

    <!-- open sans font-family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <style>
        .grid-divider {
            display: grid;
            grid-template-columns: 40% 60%;
        }

        .user_details .container {
            width: 60%;
        }

        #order-textarea {
            background-color: #ffffff;
            border: 1px solid #7c7c7c;
            resize: none;
            width: 82%;
            color: #3b3b3b;
            font-weight: 500;
            padding: 6px 7px;
        }

        #order-status {
            font-weight: 500;
            font-size: .85rem;
            border: 1px solid #c2bcbc8c;
            border-radius: 2px;
        }
    </style>
</head>

<body>
    <?php
    $formId = $_GET['form_id'];
    ?>
    <div class="user_details">
        <div class="container">


            <div class="reg-date grey-bg grid-divider">
                <div class="left-pro div-padding">Form Number:</div>
                <div class="right-pro div-padding"><?php echo $formId ?></div>
            </div>
            <div class="fname  grid-divider t-border">
                <div class="left-pro div-padding"></div>
                <div class="right-pro div-padding"></div>
            </div>
            <div class="lname grey-bg grid-divider t-border">
                <div class="left-pro div-padding">Status: </div>
                <div class="right-pro div-padding">
                    <select name="order__status" id="order-status" required="required">
                        <option value="" disabled selected>--Select Order Status--</option>
                        <option value="Dispatched">Dispatched</option>
                        <option value="On The Way">On the way</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
            <div class="email  grid-divider t-border">
                <div class="left-pro div-padding">Message: </div>
                <div class="right-pro div-padding">
                    <textarea name="" id="order-textarea" cols="30" rows="10" required placeholder="Write a Message!!"></textarea>
                </div>
            </div>
            <div class="bottom-div div-padding t-border" style="padding: 1.3rem 1rem;">
                <a id="submit">Submit</a>
                <a class="exit-button__user-modal">close the window</a>
            </div>
        </div>
    </div>


    <script>
        let submit_btn = document.getElementById("submit");

        submit_btn.addEventListener('click', () => {
            let order_status = document.getElementById("order-status");

            if (order_status.value != "") {
                // updating the order status
                order_status = order_status.value;


                // fetching the url parameters
                const queryString = window.location.search;
                // The constructor takes the queryString (obtained in the previous step) as an argument and parses it into a more usable format.
                const urlParams = new URLSearchParams(queryString);
                // It calls the get method on the urlParams object.
                let oid = urlParams.get("form_id");

                let Cancelled_order_reason = "";

                if (order_status == "Cancelled") {
                    Cancelled_order_reason = document.getElementById("order-textarea").value;
                }

                let fetchValues = {
                    "oid": `${oid}`,
                    "status": `${order_status}`,
                    "order_reason":`${Cancelled_order_reason}`,
                }

                // console.log(order_status)
                // console.log(oid)
                fetch("operations-file/all_orders-status-update.php", {
                    method: "POST",
                    body: JSON.stringify(fetchValues),
                    headers: {
                        "Content-type": "application/json",
                    }
                }).then((Response) => {
                    return Response.json();
                }).then((value) => {
                    if (value.updated == 'success') {
                        console.log(`Status Updated Successfully`)

                        setTimeout(() => {
                            window.close();
                        }, 10);
                    }
                }).catch((error) => {
                    console.log('error is ', error);
                })
            }
        })

        document.querySelector(".exit-button__user-modal").addEventListener('click', () => {
            window.close();
        })
    </script>
</body>

</html>