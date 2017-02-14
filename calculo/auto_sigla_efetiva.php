<?php
include('../cabecalho.php');

include('calcularSiglaSintetica.php');
?>

<br>

Atualizando siglas...

<?php

    $i = 0;

    $query = $db->query("SELECT id, titulo FROM `qualis` where `sigla` is null or `sigla` = ''");
    while($row = $query->fetch_array(MYSQLI_ASSOC)) {
        
        $update = "UPDATE `qualis` SET `sigla_efetiva` =? WHERE id = ?";
        if ($stmt = $db->prepare($update)) {
            $stmt->bind_param('si', calcularSiglaSintetica($row['titulo']), $row['id']);
            $stmt->execute();
            $stmt->close();
            $i++;
        }
        else {
            //Error
            printf("Prep statment failed: %s\n", $mysqli->error);
        }

    }
?>

Executadas <?= $i?> alterações.
<br>

<?php include('../crud/crud_rodape.php'); ?>