<?php
include_once "conexao_a.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Rafão - GROUP BY</title>
    <link rel="shortcut icon" href="images/favicon.ico" />
</head>

<body>
    <h2>Aulas acessadas</h2>

    <?php
    $usuario = 1;

    $query_acesso_aulas = "SELECT aul.id, aul.nome,
                            ace.usuario_id,
                            COUNT(ace.aula_id) AS qnt_acessos
                            FROM aulas AS aul
                            INNER JOIN acessos_aulas AS ace ON ace.aula_id=aul.id
                            WHERE ace.usuario_id = $usuario
                            GROUP BY ace.aula_id";
    $result_acesso_aulas= $conn->prepare($query_acesso_aulas);
    $result_acesso_aulas->execute();

    while($row_acesso_aula = $result_acesso_aulas->fetch(PDO::FETCH_ASSOC)){
        //var_dump($row_acesso_aula);
        extract($row_acesso_aula);
        echo "Nome da aula: $nome <br>";
        echo "Quantidade de acesso: $qnt_acessos <br>";
        echo "<hr>";
    }

    ?>

</body>

</html>