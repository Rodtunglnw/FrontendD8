<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script>
        $(function () {
            $("#datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
            });
        });
    </script>
</head>

<body>
    <h1>Register</h1>
    <form id ='formRegister'>
        <input type="text" name="username" id="username" maxlength="50">
        <input type="password" name="password" id="password">
        <p>Date: <input type="text" id="datepicker"></p>
        <input type="button" value="Submit" onclick="checkForm()">
    </form>
    <script>
        function checkForm() {
            let username = document.getElementById('username').value;
            let password = document.getElementById('password').value;
            let rex_username = /^[A-Za-z]{8,12}$/;
            let formData = $('#formRegister').serialize();
                console.log(formData);
       
            
            if (username === '') {
                Swal.fire({
                    title: "กรอกข้อมูลไม่ถูกต้อง",
                    text: "เช็คข้อมูล Username อีกที",
                    icon: "error"
                });
                return false;
            }
            if (password === '') {
                Swal.fire({
                    title: "กรอกข้อมูลไม่ถูกต้อง",
                    text: "กรุณากรอก Password",
                    icon: "error"
                });
                return false;
            }

            if (rex_username.test(username) === false) {
                Swal.fire({
                    title: "กรอกข้อมูลไม่ถูกต้อง",
                    text: "เช็คข้อมูล Username อีกที",
                    icon: "error"
                });
                return false;
            }
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // const datastr = "username=" + username + "&password=" + password; // Fix the typo here

                    $.ajax({
                        type: "POST",
                        url: 'processRegister.php',
                        data: formData,
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            Swal.fire({
                                title: " Success",
                                text: response.username,
                                icon: "success"
                            });
                        }
                    });
                }
            });
        }
    </script>
</body>

</html>
