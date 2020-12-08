<?php
include_once("config.php");
if (isset($_POST['s']) && $_POST['s'] == 1) {
    $username = $conn->real_escape_string($_POST['username']);
    $username = htmlentities($username);
    $pwd = $conn->real_escape_string($_POST['password']);
    $pwd = htmlentities($pwd);



    if (!empty($username) && !empty($pwd)) {
        if ($sql = $conn->prepare("SELECT * FROM accounts")) {
            if ($sql->execute()) {
                //see if there's an existing account;
                $result = $sql->get_result();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row['userName'] == $username) {
                            if (password_verify($pwd, $row['password'])) {
                                //make the user log in 

                                if ($row['accountType'] > 1) {
                                }
                                $_SESSION['userName'] = $row['userName'];
                                //redirect
                            } else {
                                //Wrong Password Credential
                                echo error("Wrong Password Credential");
                            }
                            break;
                        }
                    }
                } else {
                    //Account doesn't exist
                    echo error("Account Doesn't Exist");
                }
            } else {
                //error
                echo error("There's Something Wrong Processing the Query");
            }
        } else {
            echo error("Error in Query");
        }
    } else {
        echo error("Please Fill Up the Required Fields");
    }
}
?>
<div></div>