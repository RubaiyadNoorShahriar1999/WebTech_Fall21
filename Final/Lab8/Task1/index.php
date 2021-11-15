<?php include_once "header.php"; ?>

    <section class="main">
        <form id="registration-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <fieldset>
                <legend>REGISTRATION</legend>
                <div>
                    <table>
                        <tr>
                            <td><label for="name">Name</label></td>
                            <td>:<input type="text" name="name" id="name"></td>
                            <td id="err_name"></td>
                        </tr>
                    </table>
                    <hr>
                    <table>
                        <tr>
                            <td><label for="email">Email</label></td>
                            <td>:<input type="text" name="email" id="email"></td>
                            <td id="err_email"></td>
                        </tr>
                    </table>
                    <hr>
                    <table>
                        <tr>
                            <td><label for="username">User Name</label></td>
                            <td>:<input type="text" name="username" id="username"></td>
                            <td id="err_username"></td>
                        </tr>
                    </table>
                    <hr>
                    <table>
                        <tr>
                            <td><label for="password">Password</label></td>
                            <td>:<input type="password" name="password" id="password"></td>
                            <td id="err_password"></td>
                        </tr>
                    </table>
                    <hr>
                    <table>
                        <tr>
                            <td><label for="cpassword">Confirm Password</label></td>
                            <td>:<input type="password" name="cpassword" id="cpassword"></td>
                            <td id="err_cpassword"></td>
                        </tr>
                    </table>
                    <hr>
                    <fieldset>
                        <legend>Gender</legend>
                        <input type="radio" name="gender" value="male" id="male"><label for="male">Male</label>
                        <input type="radio" name="gender" value="female" id="female"><label for="female">Female</label>
                        <input type="radio" name="gender" value="other" id="other"><label for="other">Other</label>
                        <span id="err_gender"></span>
                    </fieldset>
                    <fieldset>
                        <legend>Date of Birth</legend>
                        <input type="date" name="dob" id="dob">
                        <span id="err_dob"></span>
                    </fieldset>
                </div>
                <div>
                    <input type="submit" name="registration_btn" id="registration_btn" value="Submit">
                    <input type="reset" id="reset">
                </div>
            </fieldset>
        </form>
        </main>
    </section>

<?php include_once "footer.php"; ?>