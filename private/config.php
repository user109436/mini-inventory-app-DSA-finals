<?php
include("db.php");
include("helper.php");
include("functions.php");


function openQuery($q) //for one time execute only without binding of data
{
    global $conn;
    if ($sql = isPrep($q)) {
        if (isExecute($sql)) {
            return $sql->get_result();
        }
    }
}
function getById($table, $id, $warning = 1, $msg = "0 Results")
{
    global $conn;
    if ($sql = isPrep("SELECT * FROM " . $table . " WHERE id=? LIMIT 1")) {
        $sql->bind_param("s", $id);
        if (isExecute($sql)) {
            return hasRows($sql->get_result(), $warning, $msg);
        }
    }
}
function getAllFetch($table, $warning = 1, $msg = "0 Result")
{
    global $conn;
    $q = "SELECT * FROM " . $table;
    if ($sql = isPrep($q)) {
        if (isExecute($sql)) {
            return hasRows($sql->get_result(), $warning, $msg);
        }
    }
}

//delete
function deleteById($table, $id)
{
    global $conn;

    $q = "DELETE FROM " . $table . " WHERE id=" . $id;
    if ($sql = $conn->prepare($q)) {
        $sql->execute();
        if (validateParamID($id)) {
            if ($sql->affected_rows > 0) {
                echo success("Successfully Deleted");
                return true;
            } else {
                echo error("ID does not exist", $id);
                return false;
            }
        } else if (!validateParamID($id)) {
            echo error("Invalid ID for deletion", $id);
            return false;
        }
    } else {
        echo warning($q) . "<br>" . error();
        return false;
    }
}
function deleteItem($table, $param, $location)
{
    if (isset($_GET[$param]) && validateParamID($param)) {
        deleteById($table, $_GET[$param]);
        header("location:" . $location);
        return true;
    }
    return false;
}
function delete($table, $id)
{
    if ($sql = isPrep("DELETE FROM " . $table . " WHERE id=?")) {
        $sql->bind_param("s", $id);
        if (isExecute($sql)) {
            return $sql->affected_rows;
        }
    }
}


//prepared statements
function isPrep($q)
{
    // echo warning($q);
    global $conn;
    if ($sql = $conn->prepare($q)) {
        return $sql;
    }
    echo warning($q) . "<br>" . error();
    return false;
}
function isExecute($sql, $msg = "Sorry Failed to Execute Query :<")
{
    global $conn;
    if ($sql->execute()) {
        return true;
    }
    printArr($sql);
    echo error($msg);
    return false;
}
//additional tool for checking
function hasRows($result, $warning = 1, $msg = "")
{
    global $conn;
    if ($result->num_rows > 0) {
        return $result;
    }

    echo $warning ? warning($msg) : "";
    return false;
}
