<?php
if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
