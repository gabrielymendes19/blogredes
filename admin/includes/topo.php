<div>
  <div>
    <div> <a data-toggle="collapse" data-target=".nav-collapse"><span
                    ></span><span></span><span></span> </a><a href="home.php">Blog de Redes</a>
      <div>
        <ul>
          <li><a href="#" data-toggle="dropdown">Opções<b></b></a>
            <ul>
              <li><a href="../">Acessar o Site</a></li>
              <li><a href="javascript:;">Adicionar Usuários</a></li>
              <li><a href="javascript:;">Site em Manutenção</a></li>
            </ul>
          </li>
          <li><a href="#" data-toggle="dropdown"><?php echo $nomeLogado;?> <b></b></a>
            <ul>
              <li><a href="javascript:;">Perfil</a></li>
              <li><a href="?sair" onClick="return confirm('Deseja realmente fazer o logout?')">Logout</a></li>
            </ul>
          </li>
        </ul>
        <form action="home.php?acao=ver-postagens" method="post" enctype="multipart/form-data">
          <input type="text" name="palavra-busca" placeholder="Pesquisar">
        </form>
      </div>
    </div>
  </div>
</div>
<div>
  <div>
    <div>
      <?php if(isset($_GET['acao'])){	$acao = $_GET['acao'];}else{$acao ='home';}?>    
    
      <ul>
        <li <?php if($acao =="welcome" || ($acao =="home")){echo 'class="active"';}?>><a href="home.php"><i></i><span>Página inicial</span></a></li>
        
        <?php if($nivelLogado ==1){?>
        <li class="<?php if($acao =="ver-postagens" || ($acao =="cad-postagem")){echo "active";}?> dropdown"><a href="javascript:;" data-toggle="dropdown"><span>Postagens</span><b></b></a>
          <ul>
            <li><a href="home.php?acao=ver-postagens">Visualizar</a></li>
            <li><a href="home.php?acao=cad-postagem">Cadastrar</a></li>
          </ul>
        </li>
        <?php }?>
        <li><a href="javascript:;" data-toggle="dropdown"><span>Usuários</span><b></b></a>
          <ul>
            <li><a href="#">Visualizar</a></li>
            <li><a href="home.php?acao=cad-postagem">Cadastrar</a></li>
            <li><a href="#">Editar Perfil</a></li>
          </ul>
        </li>
        <li><a href="#"><span>Manut. Site</span></a></li>
      </ul>
    </div>
  </div>
</div>