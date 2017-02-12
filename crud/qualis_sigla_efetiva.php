<?php
include('../cabecalho.php');
?>

Atualizando siglas...

<?php
    function calcularSiglaSintetica($titulo) {
        $words = preg_split("/[\s,_-]+/", $titulo);
        $sigla = "";

        foreach ($words as $w) {
          $sigla .= $w[0];
        }
        return "DUMMY $sigla";
    }

    $query = $db->query("SELECT id, titulo FROM `qualis` where `sigla_efetiva` like 'DUMMY%'");
    while($row = $query->fetch_array(MYSQLI_ASSOC)) {
        if ($stmt = $mysqli->prepare("UPDATE `qualis` SET `sigla_efetiva` =? WHERE id = ?")){
            $stmt->bind_param('si', calcularSiglaSintetica($row['titulo']), $row['id']);
            $stmt->execute();
            $stmt->close();
        }
        else {
            //Error
            printf("Prep statment failed: %s\n", $mysqli->error);
        }
    }
?>

<br>
Foi?
<br>


<?php include('crud_rodape.php'); ?>