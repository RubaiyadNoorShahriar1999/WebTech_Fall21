<?php require_once "functions.php"; ?>
<?php

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header("Location: login.php");
    exit();
}

?>
<?php header_page("View Profile"); ?>
<?php primary_menu(); ?>

    <section class="main">

        <?php aside_menu(); ?>

        <main class="main__content main__content--view-profile">
            <fieldset>
                <legend>PROFILE</legend>
                <div class="main__content--view-profile__container">
                    <div class="main__content--view-profile__details">
                        <table>
                            <tr>
                                <td>Name</td>
                                <td>: <?php echo ucfirst($_SESSION['name']); ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>: <?php echo $_SESSION['email']; ?></td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>: <?php echo ucfirst($_SESSION['gender']); ?></td>
                            </tr>
                            <tr>
                                <td>Date Of Birth</td>
                                <td>: <?php echo date("d/m/Y", strtotime($_SESSION['dob'])); ?></td>
                            </tr>
                        </table>
                        <br>
                        <a href="edit-profile.php">Edit Profile</a>
                    </div>
                    <div class="main__content--view-profile__profile-pic">
                        <img src="<?php echo !empty($_SESSION['pp_path']) ? $_SESSION['pp_path'] : "images/default-pp.png"; ?>" alt="Profile Picture"><br>
                        <a href="change-profile-picture.php">Change</a>
                    </div>
                </div>
            </fieldset>
        </main>
    </section>

<?php footer_page(); ?>