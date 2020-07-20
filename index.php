<?php
  require_once("admin/conexao/conecta.php");
  require_once("admin/functions/limita-texto.php");
?>

<!DOCTYPE html>
<html lang="pt-4">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Página inicial</title>

    <!-- Custom fonts for this template-->
    <link href="public/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="public/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="public/style.css" rel="stylesheet">

  </head>
  <body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark">
      <li id="home"><a href="index.php">Página inicial</a></li>
      <li id="atleticas"><a href="?categoria=Antenada e Maquinada">Antenada e Maquinada</a></li>
      <li id="auxilio-socioeconomico"><a href="?categoria=Auxílio socioeconômico">Auxílio socioeconômico</a></li>
      <li id="calouro"><a href="?categoria=Calouro">Calouro</a></li>
      <li id="caredes"><a href="?categoria=CAREDES">CAREDES</a></li>
      <li id="concessao-ingles"><a href="?categoria=Concessão de créditos em língua estrangeira">Concessão de créditos em língua estrangeira</a></li>
      <li id="divulgacao"><a href="?categoria=Divulgação de materiais de estudo, de serviços e de produtos">Divulgação de materiais de estudo, de serviços e de produtos</a></li>
      <li id="EngNet"><a href="?categoria=EngNet">EngNet</a></li>
      <li id="materias"><a href="?categoria=Matérias">Matérias</a></li>
      <li id="Oportunidade-de-estagio"><a href="?categoria=Oportunidades de estágio">Oportunidades de estágio</a></li>
      <li id="sigaa"><a href="?categoria=SIGAA">SIGAA</a></li>
    </ul>
      

      <div id="content-wrapper" class="d-flex flex-column">

        
        <div id="content">

          <!-- Topbar -->
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Busque aqui" aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

              <!-- Nav Item - Search Dropdown (Visible Only XS) -->
              <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                  <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                      <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                          <i class="fas fa-search fa-sm"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </li>

              <!-- Nav Item - Alerts -->
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-bell fa-fw"></i>
                  <!-- Counter - Alerts -->
                  <span class="badge badge-danger badge-counter">3+</span>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                  <h6 class="dropdown-header">
                    Mensagens da Semana
                  </h6>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-primary">
                        <i class="fas fa-file-alt text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500">Jun 15, 2020</div>
                      <span class="font-weight-bold">Notificação</span>
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-success">
                        <i class="fas fa-donate text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500">Jun 15, 2020</div>
                      Notificação
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-warning">
                        <i class="fas fa-exclamation-triangle text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500">Jun 15, 2020</div>
                      Notificação
                    </div>
                  </a>
                  
                </div>
              </li>

          

              

            
            </ul>

          </nav>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="divcenter">
            <?php
              if (!isset($_GET['categoria'])) {
            ?>
            <h1>Todas as postagens</h1>
            <?php
              }
              else {
            ?>
            <h1><?php echo $_GET['categoria'];?></h1>
            <?php
              }
            ?>
            <ul style="list-style-type: none;" class="boxposts">

            <!-- mostrando todas as postagens do banco de dados -->
            <?php
              if (!isset($_GET['categoria'])) {
                $sql = "SELECT * from posts ORDER BY id DESC";
                try {
                  $resultado = $conexao->prepare($sql);
                  $resultado->execute();
                  $contar = $resultado->rowCount();
                  if ($contar > 0) {
                    while ($exibe = $resultado->fetch(PDO::FETCH_OBJ)) {
            ?>
              <li>
                <span class="thumb">
                  <img src="imagens/<?php echo $exibe->categoria; ?>/<?php echo $exibe->categoria; ?>.png" alt="<?php echo $exibe->titulo; ?>" title="<?php echo $exibe->titulo; ?>" width="166" height="166">
                </span>
                <span class="content">
                  <h2><?php echo $exibe->titulo; ?></h2>
                  <p><?php echo limitarTexto($exibe->conteudo, $limite = 380); ?></p>
                  <div class="footer_post">
                    <a href="#">Ler postagem completa</a>
                    <span class="datapost">Data de publicação: <strong><?php echo $exibe->data; ?></strong></span>
                  </div>
                </span>
              </li>

              <?php
                }
                    }
                    else {
                    echo '<li>Não existe postagem cadastrada no sistema.</li>';
                    }
                }
                catch (PDOException $e) {
                  echo $e; 
                }
              }
              ?>
              
              <!-- filtrando postagens por categoria -->
              <?php
                if (isset($_GET['categoria'])) {
                  $pega_categoria = $_GET['categoria'];
                  $sql = "SELECT * from posts WHERE categoria='$pega_categoria' ORDER BY id DESC";
                  try {
                    $resultado = $conexao->prepare($sql);
                    $resultado->execute();
                    $contar = $resultado->rowCount();
                    if ($contar > 0) {
                      while ($exibe = $resultado->fetch(PDO::FETCH_OBJ)) {
              ?>
                <li>
                  <span class="thumb">
                    <img src="imagens/<?php echo $exibe->categoria; ?>/<?php echo $exibe->categoria; ?>.png" alt="<?php echo $exibe->titulo; ?>" title="<?php echo $exibe->titulo; ?>" width="166" height="166">
                  </span>
                  <span class="content">
                    <h2><?php echo $exibe->titulo; ?></h2>
                    <p><?php echo limitarTexto($exibe->conteudo, $limite = 380); ?></p>
                    <div class="footer_post">
                      <a href="#">Ler postagem completa</a>
                      <span class="datapost">Data de publicação: <strong><?php echo $exibe->data; ?></strong></span>
                    </div>
                  </span>
                </li>

                <?php
                  }
                      }
                      else {
                      echo '<li>Não existe postagem cadastrada no sistema.</li>';
                      }
                  }
                  catch (PDOException $e) {
                    echo $e; 
                  }
                }
                ?>
            </ul>

            <!--inicio botoes paginacao-->
            <style>
              <?php
                  if(isset($_GET['pg'])) {
                      $num_pg = $_GET['pg'];
                  }
                  else {
                      $num_pg = 1;
                  }
              ?>
              .paginas a.ativo<?php echo $num_pg; ?> {
                  background: red;
                  color: white;
              }
            </style>
            <?php
                if (empty($_GET['pg'])) {

                }
                else {
                    $pg = $_GET['pg'];
                    if (!is_numeric($pg)) {
                        echo '<script language="JavaScript">location.href="home.php?acao=ver-postagens";</script>';
                    }
                }
                if (isset($pg)) {
                    $pg = $_GET['pg'];
                }
                else {
                    $pg = 1;
                }
                $quantidade = 3;
                $inicio = ($pg*$quantidade) - $quantidade;
                $sql = "SELECT * from posts ORDER BY id DESC LIMIT $inicio,$quantidade";
                try {
                    $result = $conexao->prepare($sql);
                    $result->execute();
                    $totalRegistros = $result->rowCount();
                }
                catch (PDOException $e) {
                    echo $e;
                }
                if ($totalRegistros <= $quantidade) {
                    
                }
                else {
                    $paginas = ceil($totalRegistros/$quantidade);
                    if ($pg > $paginas) {
                        echo '<script language="JavaScript">location.href="home.php?acao=ver-postagens";</script>';
                    }
                    $links = 5;
                    if (isset($i)) {

                    }
                    else {
                        $i = '1';
                    }
            ?>

            <div class="paginas">
              <a href="home.php?acao=ver-postagens&pg=1">Primeira Página</a>
              <?php
                  if (isset($_GET['pg'])) {
                      $num_pg = $_GET['pg'];
                  }
                  for ($i = $pg - $links; $i <= $pg - 1 ; $i++) {
                      if ($i <= 0) {

                      }
                      else {
              ?>
              <a href="home.php?acao=ver-postagens&pg=<?php echo $i; ?>" class="ativo<?php echo $i; ?>"><?php echo $i; ?></a>
              <?php
                      }
                  }
              ?>
              <a href="home.php?acao=ver-postagens&pg=<?php echo $pg; ?>" class="ativo<?php echo $i; ?>"><?php echo $pg; ?></a>

              <?php
                  for($i = $pg + 1 ; $i <= $pg + $links ; $i++) {
                      if($i > $paginas) {

                      }
                      else {
              ?>

              <a href="home.php?acao=ver-postagens&pg=<?php echo $i; ?>" class="ativo<?php echo $i; ?>"><?php echo $i; ?></a>

              <?php            

                      }
                  }
              ?>

              <a href="home.php?acao=ver-postagens&pg=<?php echo $paginas; ?>">Última Página</a>  

      </div> <!--paginas-->
      
      <?php
          }

      ?>
      <!--fim botoes paginacao-->
          </div>
          <!-- /.divcenter -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>UNB &copy; Engenharia de Redes de Comunicação</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->



    <script src="public/jquery/jquery.min.js"></script>
    <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="public/jquery-easing/jquery.easing.min.js"></script>
    <script src="public/script.js"></script>


  </body>

</html>
