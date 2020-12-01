<?php
include("db.php");
include("helper.php");

function openQuery($q) //for one time execute only without binding of data
{
    global $conn;
    if ($sql = $conn->prepare($q)) {
        $sql->execute();
        return $result = $sql->get_result();
    } else {
        echo warning($q) . "<br>" . error();
        return false;
    }
}
function getAll($table)
{
    global $conn;
    $q = "SELECT * FROM " . $table;
    if ($sql = $conn->prepare($q)) {
        $sql->execute();
        return $result = $sql->get_result();
    } else {
        echo warning($q) . "<br>" . error();
        return false;
    }
}
function getById($table, $id)
{
    global $conn;
    $q = "SELECT * FROM " . $table . " WHERE id=" . $id . " LIMIT 1";
    if ($sql = $conn->prepare($q)) {
        $sql->execute();
        return $result = $sql->get_result();
    } else {
        echo warning($q) . "<br>" . error();
        return false;
    }
}

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
function isPrep($sql)
{
    global $conn;
    if ($sql = $conn->prepare($sql)) {
        return $sql;
    }
    echo error();
    return false;
}
function isExecute($sql)
{
    global $conn;
    if ($sql->execute()) {
        return true;
    }
    echo error("Sorry Failed to Query :<");
    return false;
}
