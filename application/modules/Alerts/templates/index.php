<?php
if (isset($_SESSION['alerts'])) {
    echo $_SESSION['alerts'];
    unset($_SESSION['alerts']);
}
