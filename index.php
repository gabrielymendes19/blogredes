<?php
    include_once("settings/settings.php")
?>

<!DOCTYPE html>
<html lang="pt_br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistema de postagens</title>
    </head>
    <body>
        <div id="body">
            <?php
                if(isset($_GET['pagina'])) {
                    $do = ($_GET['pagina']);
                }
                else {
                    $do = "inicio";
                }

                if(file_exists("paginas/".$do.".php")) {
                    include("paginas/".$do.".php");
                }
                else {
                    print "pagina nao encontrada";
                }
            ?>
        </div>
    </body>
</html>
