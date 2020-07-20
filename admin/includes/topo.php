<div>
  <div>
    <div>
      <h1>Área Administrativa</h1>
      <div>
        <ul>
          <li>
            Para visualizar as postagens diretamente no blog, <a href="../">clique aqui.</a>
          </li>
          <li>
            Para sair da sua conta, <a href="?sair" onClick="return confirm('Deseja realmente fazer o logout?')">Clique aqui</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div>
  <div>
    <div>
      <?php if(isset($_GET['acao'])){	$acao = $_GET['acao'];}else{$acao ='home';}?>    
    
      <ul>
        <li <?php if($acao =="welcome" || ($acao =="home")){echo 'class="active"';}?>><a href="home.php"><i></i><span>Tela da Área Administrativa</span></a></li>
        
        
        <li class="<?php if($acao =="ver-postagens" || ($acao =="cad-postagem")){echo "active";}?> dropdown"><a href="javascript:;" data-toggle="dropdown"><span>Postagens</span></a>
          <ul>
            <li><a href="home.php?acao=ver-postagens">Visualizar</a></li>
            <li><a href="home.php?acao=cad-postagem">Cadastrar</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>