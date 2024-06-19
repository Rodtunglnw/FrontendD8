<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
</head>

<body>
    <h1>Register</h1>
    <!-- <form id="myForm"> -->
    <div id="divForm">
        <input type="text" name="username" id="username" maxlength="50">
        <input type="password" name="password" id="password">
        
        <input type="submit" onclick="checkForm()"></input>
    </div>
    <!-- </form> -->

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        function checkForm() {

            let username = document.getElementById('username').value;
            let password = document.getElementById('password').value;
            let rex_username = /^[A-Za-z]{8,12}$/;
            const formData = new FormData();
            formData.append("username", username);
            formData.append('password', password);
            console.log(formData);

            if (username == '') {
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

            if (rex_username.test(username) == false) {
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

                    const datastr = "username=" + username + "&" + "passsword=" + password; // เป็นการส่งค่าแบบ key => value

                    $.ajax({
                        type: "POST",
                        url: 'processRegister.php',
                        data: datastr,
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            Swal.fire({
                                title: " Success",
                                text: response,
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