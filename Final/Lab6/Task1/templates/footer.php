<?php

/**
 * Can't access directly by URL
 */

defined("_DIRECT_ACCESS") or exit("<h1>Your are not allowed</h1>");
?>
<?php function footer_page() { ?>

    <footer class="footer">
        <p>Copyright &copy; <?php echo date("Y"); ?></p>
    </footer>

</body>

</html>

<?php } ?>