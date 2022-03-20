<?php

function loadJson($id, $name)
{
    $json = file_get_contents("pokedex.json");
    $json_array = json_decode($json, true);

    if (empty($id)) {
        $id = count($json_array) + 1;
    }
    print "<table class='table table-striped' style='width:1000px;'> <tr> <th>ID</th> <th>Nombre</th> <th>Tipos</th> <th>Opciones</th></tr>";

    for ($i = 0; $i < count($json_array); $i ++) {
        if ($name == null) {
            if ($json_array[$i]["id"] <= $id) {
                print "<tr>";
                print "<td id='" . $json_array[$i]["id"] . "' >" . $json_array[$i]["id"] . "</td>";
                print "<td id='" . $json_array[$i]["name"]["english"] . "' >" . $json_array[$i]["name"]["english"] . "</td>";

                $types = null;
                for ($k = 0; $k < count($json_array[$i]["type"]); $k ++) {

                    $types .= $json_array[$i]["type"][$k];
                    if ($k + 1 != count($json_array[$i]["type"])) {
                        $types .= ", ";
                    }
                }

                print "<td>" . $types . "</td>";
                print "<td> <button id='seleccionar'>Seleccionar</button> </td>";
                print "<tr>";
                $types = null;
            }
        } else {
            if ($name == $json_array[$i]["name"]["english"]) {
                print "<tr>";
                print "<td id='" . $json_array[$i]["id"] . "' >" . $json_array[$i]["id"] . "</td>";
                print "<td id='" . $json_array[$i]["name"]["english"] . "' >" . $json_array[$i]["name"]["english"] . "</td>";
                $types = null;
                for ($k = 0; $k < count($json_array[$i]["type"]); $k ++) {

                    $types .= $json_array[$i]["type"][$k];
                    if ($k + 1 != count($json_array[$i]["type"])) {
                        $types .= ", ";
                    }
                }
                print "<td>" . $types . "</td>";
                print "<td> <button id='seleccionar'>Seleccionar</button> </td>";
                print "<tr>";
                $types = null;
            }
        }
    }
    print "</table>";
}

if (isset($_POST['action']) && ! empty($_POST['action'])) {

    $action = $_POST['action'];

    if (isset($_POST['id']) && ! empty($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        $id = 0;
    }
    if (isset($_POST['name']) && ! empty($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $name = null;
    }
    switch ($action) {
        case 'loadJson':
            loadJson($id, $name);
            break;
        case 'savePokemon':
            savePokemon($id, $name);
            break;
        case 'showPokemon':
            showPokemon();
            break;
        case 'deletePokemon':
            deletePokemon($id);
            break;
    }
}

function savePokemon($id, $name)
{
    $connect = mysqli_connect("localhost", "root", "", "pokedex");
    $existsSQL = "SELECT * FROM pokemon WHERE id = '" . $id . "'";
    $queryExists = mysqli_query($connect, $existsSQL);

    if (mysqli_num_rows($queryExists) == 0) {

        $query = "INSERT INTO POKEMON (id, name) VALUES ('" . $id . "', '" . $name . "')";
        if (mysqli_query($connect, $query) === TRUE) {
            echo json_encode(array(
                "statusCode" => 200
            ));
            mysqli_close($connect);
        } else {
            echo json_encode(array(
                "statusCode" => 201
            ));
            mysqli_close($connect);
        }
    } else {
        echo json_encode(array(
            "statusCode" => 201
        ));
        mysqli_close($connect);
    }
}

function showPokemon()
{
    $connect = mysqli_connect("localhost", "root", "", "pokedex");
    $query = "SELECT * FROM pokemon";
    $result = mysqli_query($connect, $query);

    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo json_encode($row);
}

function deletePokemon($id)
{
    $connect = mysqli_connect("localhost", "root", "", "pokedex");
    $query = "DELETE FROM POKEMON WHERE id = '" . $id . "'";

    var_dump($query);
    if (mysqli_query($connect, $query) === TRUE) {
        echo json_encode(array(
            "statusCode" => 200
        ));
        mysqli_close($connect);
    } else {
        echo json_encode(array(
            "statusCode" => 201
        ));
        mysqli_close($connect);
    }
}
?>