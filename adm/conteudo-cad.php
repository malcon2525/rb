 <? require_once('../lib/validaSessaoAdm.php');?>

<?
$id												= (isset($_POST['id']) 											? $_POST['id']  										: '');
$titulo										= (isset($_POST['titulo']) 									? $_POST['titulo'] 									: '');
$chamada									= (isset($_POST['chamada'])									? $_POST['chamada']									: '');
$conteudo									= (isset($_POST['conteudo'])								? $_POST['conteudo']								: '');
$data											= (isset($_POST['data'])										? $_POST['data']										: '');
$data 										= date('Y-m-d H:i:s');

$foto_reduzida						= (isset($_POST['foto_reduzida'])						? $_POST['foto_reduzida']						: '');
$alt_foto_reduzida				= (isset($_POST['alt_foto_reduzida'])				? $_POST['alt_foto_reduzida']				: '');


$uri 											= (isset($_POST['uri'])											? $_POST['uri']											: '');
$situacao									= (isset($_POST['situacao'])								? $_POST['situacao']								: '');

$conteudo_localizacao_id	= (isset($_POST['conteudo_localizacao_id'])	? $_POST['conteudo_localizacao_id']	: '');
$description							= (isset($_POST['description'])							? $_POST['description']							: '');

$title										= (isset($_POST['title'])										? $_POST['title']										: '');

$menu_id									= (isset($_POST['menu_id'])									? $_POST['menu_id']									: '');
$menu_id									= (empty($menu_id)													? $_GET['menu_id']									: $menu_id);

$usuario_id								= (isset($_POST['usuario_id'])							? $_POST['usuario_id']							: '');

$enviar										= (isset($_POST['enviar'])									? $_POST['enviar']									: '');


$codigo_produto						= (isset($_POST['codigo_produto'])					? $_POST['codigo_produto']					: '');







// SE FOR ALTERAÇÃO -> PEGA OS DADOS DO BANCO
$alterar	= (isset($_GET['alterar'])		? $_GET['alterar']		: '');
$id = ( !empty($alterar) ? $alterar : $id);
if (!empty($alterar)) {
	$read = read('conteudo', "WHERE id=$alterar");
	//mostraMatriz($read);
	if ($read){
	  foreach($read as $upDB){
	  	$titulo 	= $upDB['titulo'];
	  	$chamada 	= $upDB['chamada'];
	  	$conteudo	= $upDB['conteudo'];	  	

	  	$data 											= $upDB['data'];
	  	$foto_reduzida 							= $upDB['foto_reduzida'];
	  	$alt_foto_reduzida 					= $upDB['alt_foto_reduzida'];

	  	$uri 												= $upDB['uri'];
	  	$situacao 									= $upDB['situacao'];

	  	$conteudo_localizacao_id	= $upDB['conteudo_localizacao_id'];

	  	$description 								= $upDB['description'];
	  	$title 											= $upDB['title'];
	  	$menu_id 										= $upDB['menu_id'];
	  	$usuario_id									= $upDB['usuario_id'];
	  	$visitas										= $upDB['visitas'];
	  	$codigo_produto							= $upDB['codigo_produto'];



	  }
	}
}



// EFETUA O CADASTRO OU A ALTERAÇÃO
// se tiver descrição e não tiver id -> grava
// se tiver descrição e id -> altera
// * perceba que o cadastro só acontece com o POST da titulo e id e enviar




if (!empty($titulo) && !empty($enviar)) {

	if (empty($id)) { // CADASTRO
		$datas = array(
	  		"titulo" 						=> "$titulo",
	  		"chamada" 					=> "$chamada",
	  		"conteudo" 					=> "$conteudo",
	  		"data" 							=> "$data",

	  		"foto_reduzida" 		=> "$foto_reduzida",
	  		"alt_foto_reduzida" => "$alt_foto_reduzida",

	  		"uri" 							=> "$uri",
	  		"situacao"					=> "$situacao",

	  		"conteudo_localizacao_id" 	=> "$conteudo_localizacao_id",
	  		
	  		"description" 			=> "$description",
	  		"title"							=> "$title",
	  		"conteudo"					=> "$conteudo",
	  		
	  		"menu_id"						=> "$menu_id",	
	  		"usuario_id"				=> "$usuario_id",
	  		
	  		"codigo_produto"		=> "$codigo_produto"

		);
		$gravarBD = create ('conteudo', $datas);
		
		$id = $gravarBD;


	} else {  //ALTERAÇÃO
		$up = array(
			"titulo" 										=> "$titulo",
			"chamada" 									=> "$chamada",
			"conteudo" 									=> "$conteudo",
			"data" 											=> "$data",
			"alt_foto_reduzida"					=> "$alt_foto_reduzida",
			"uri"												=> "$uri",
			"situacao"									=> "$situacao",
			"conteudo_localizacao_id"		=> "$conteudo_localizacao_id",
			"description"								=> "$description",
			"title"											=> "$title",
			"menu_id"										=> "$menu_id",
			"usuario_id"								=> "$usuario_id",
			"codigo_produto"						=> "$codigo_produto"

		);
		$gravarBD = update('conteudo', $up, "id=$id");
	}

	if ($_FILES['foto_reduzida']['name'] != '') {
		$tabela = 'conteudo';
		$campo = 'foto_reduzida';
		$dirDestino = '../user_files/foto_reduzida';
		$largura_final = 370;
		$altura_final = 270;
		include('image-upload.php');
		include("image-tratamento.php");
	}
}




?>

<?
//***** GRAVANDO AS FOTOS DO CONTEÚDO *****

/*

if (!empty($titulo) && !empty($enviar)) {
	
	$files = $_FILES['foto'];
	$numFile = count(array_filter($files['name']));
	if ($numFile > 0) {

		for($i=0; $i<$numFile; $i++) {

				$tabela = 'galeria_foto_conteudo';
				$campo = 'foto';
				$dirDestino = '../user_files/foto_conteudo';
				$largura_final = 830;
				$altura_final = 540;

				$nome_foto = $_FILES[$campo]['name'][$i];
				$formato = $_FILES[$campo]['type'][$i];
				$tamanho = $_FILES[$campo]['size'][$i];
				$tmp_name = $_FILES[$campo]['tmp_name'][$i];

				$nome_foto = corrigeNomeFoto($nome_foto);
				//mostraVar('nome foto', $nome_foto);

				$fotoValida = validaFoto($formato, $tamanho);
				//mostraVar('fotoValida', $fotoValida);


				if ($fotoValida =="ok") {
					//faz upload
					move_uploaded_file($tmp_name, "$dirDestino/".$nome_foto);

					//tratamento
					$foto_original = $dirDestino.'/'.$nome_foto;
					trataFoto($foto_original, $nome_foto, $largura_final, $altura_final, $dirDestino);


					//grava no banco
					$datas = array(
					  "titulo"						 		=> "",
					  "foto" 									=> $nome_foto, 
					  "conteudo_id"				 		=> "$id",
					  "conteudo_menu_id"	 		=> "$menu_id",
					);
					create ($tabela, $datas);


				}

			}
		}
}	

*/

?>



<p class="nome-recurso"><?=$recurso?></p>
<p class="nome-acao"><?=$acao?></p>
 
  
<div id="accordion" role="tablist" >
 
  
  <div class="card ">
    <div class="card-header bg-dark" role="tab" id="headingOne">
      <h5 class="mb-0 titulo-localizacao-menu">
        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Cadastrando Conteúdo no menu: <span class="conteudo-tit-cad"> 
          	<? echo getCampo("menu", "$menu_id", "titulo");  ?> </span>
        </a>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        
 
		<?php
		
		if (empty($gravarBD)){ 
		
		?>

        <form action="index.php?pag=conteudo-cad" method="post" enctype="multipart/form-data">
        			<? $usuario_id = $_SESSION['secao_usuario']['id']; ?>
			    	<input type="hidden" name="menu_id" id="menu_id" value="<?=$menu_id?>">
			    	<input type="hidden" name="usuario_id" id="usuario_id" value="<?=$usuario_id?>">
			    	<input type="hidden" name="id" id="id" value="<?=$id?>">
        	
        	
			<div class="form-row">
			    <div class="form-group col-md-10">
			      <label for="titulo">titulo </label>
     	          <input class="form-control" type="text" name="titulo" id="titulo" value="<?=$titulo?>" required="" onkeyup="generateURL()">
			    </div>
			    <div class="form-group col-md-2">
			      <? $checked = ($situacao=="on"  ? 'checked' : '' )  ?>
			      <label for="situacao">Situação </label>
			      <input class="form-control" type="checkbox" maxlength="25" name="situacao" id="situacao" <?=$checked?> data-toggle="toggle" data-on="Ativado"  data-off="Desativado" data-onstyle="success" data-offstyle="danger"  >
			    </div>
			</div>
			

			<div class="form-row">	
				<div class="form-group">	
					
					<label for="conteudo">conteudo</label>
			            <textarea name="conteudo" id="conteudo" rows="10" cols="80">
			                <?=$conteudo?>
			            </textarea>
			            <script>
			                // Replace the <textarea id="conteudo"> with a CKEditor
			                // instance, using default configuration.
			                CKEDITOR.replace( 'conteudo' );
			            </script>

			            
			        </div>			
			</div>			

			<div class="form-row">	
				<div class="form-group col-md-10">
					<label for="chamada">Chamada</label><span id="faltaCH" class="caracteres-restantes"> 150</span>  <span class="caracteres-restantes">caracteres restantes</span>
					<textarea class="form-control" id="chamada" name="chamada" rows="3" maxlength="150" onkeyup="validaCampo('chamada', 'faltaCH', 150)"><?=$chamada?></textarea>
				</div> 
				<div class="form-group col-md-2 ">	
					<label for="gerar_chamada">&nbsp</label>
					<button type="button" class="btn btn-info d-flex pt-3 pb-3 " id="gerar_chamada" data-toggle="tooltip" data-placement="left" title="Pega os 150 primeiros caracteres do conteúdo."> Gerar <br> automático </button>
				</div>
			</div>	

			
			<div class="form-row">	
				<div class="form-group col-md-6">
					<label for="conteudo_localizacao_id">	O Conteúdo será destacado na Página Inicial?</label>
					<?
					//  combro(tabela, nome da tag option, valor exibido na tela, valor que está gravado no bcom)
						combo('conteudo_localizacao', 'conteudo_localizacao_id', 'descricao', $conteudo_localizacao_id);
					?>


				</div>
				<div class="form-group col-md-6">	
					<label for="codigo_produto">	Código do Produto</label>
					<input type="text" name="codigo_produto" id="codigo_produto" class="form-control" value="<?=$codigo_produto?>">
				</div> 

			</div>	

			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="foto_reduzida">Foto Reduzida (370x264) - <?=$foto_reduzida?></label>
					<input class="form-control-file" type="file" id="foto_reduzida" name="foto_reduzida" class="file_upload" value="<?=$foto_reduzida?>" >
					
				</div>
				<div class="form-group col-md-6">	
					<label for="alt_foto_reduzida">	SEO: < Texto Alternativo > - Foto reduzida </label>
					<input type="text" name="alt_foto_reduzida" id="alt_foto_reduzida" class="form-control" value="<?=$alt_foto_reduzida?>">
				</div>
			</div>

			<div class="grupo-campo">
			<div class="form-row">


				<div class="form-group col-md-12">
					<label for="title">	SEO: Title: </label><span id="faltat" class="caracteres-restantes"> 60</span>  <span class="caracteres-restantes">caracteres restantes</span> 


					    <div class="input-group">
					      <input onkeyup="validaCampo('title', 'faltat', 60)" type="text" name="title" id="title" class="form-control" maxlength="60" value="<?=$title?>">
					      <span class="input-group-btn">
					        <button class="btn btn-secondary" type="button" id="gerar_titulo" data-placement="left"  data-toggle="tooltip" title="Pega os 60 primeiros caracteres do titulo.">Gerar</button>
					      </span>
					    </div>
					
				</div>

				<div class="form-group col-md-12">
					<label for="uri">	SEO: URI </label>
     				 <input type="text" name="uri" id="uri" class="form-control" value="<?=$uri?>">
				</div>

				<div class="form-group col-md-12">
					<label for="description">SEO - Descriprion:  </label>
					<span id="falta" class="caracteres-restantes"> 150</span>  <span class="caracteres-restantes">caracteres restantes</span> 
				    <textarea class="form-control" id="description" rows="3" name="description" maxlength="150"  onkeyup="validaCampo('description', 'falta', 150)" ><?=$description?></textarea>
				    

				</div>
			</div>
			</div>
			






			<!-- cadastro de fotos do conteudo -->
			
<!--
			<div id="sessao_foto" class="grupo-campo">

					<div class="form-group col-md-12">
						<label for="foto">Fotos do Produto (830X540)</label>
						<input class="form-control-file" type="file" id="foto" name="foto[]" class="file_upload" value="oi" multiple>
						
					</div>

-->

					<!-- lista de imagens -->
<!--
					<iframe src="<?//=BASE?>/adm/galeria-foto-conteudo-lista.php?conteudo_id=<?//=$alterar?>" height="210" width="765" style="border: 0px"></iframe>

			</div>
-->

			<!-- fim do cadastro de fotos do conteudo -->










        	<div class="d-flex justify-content-end " >
	        	<button type="button" name="voltar" value="voltar" class="btn btn-secondary mr-2" onclick="window.location = 'index.php?pag=menu-lista'">Voltar</button>
	        	<button type="submit" name="enviar" value="enviar" class="btn btn-primary">
	        		<?
	        		$tituloBotao = (empty($alterar) ? 'Gravar' : 'Alterar');
	        		echo $tituloBotao;
	        		?>
	        	</button>
		    </div> 

        </form>

		<?php } else {?>

	 	<p class="alert alert-success p-3">REGISTRO GRAVADO COM SUCESSO.</p>
	 	<div class="d-flex justify-content-end">
       		<button type="button" name="listarC" value="listarC" class="btn btn-dark mr-2" onclick="window.location = 'index.php?pag=conteudo-lista&menu_id=<?=$menu_id?>'">Listar Conteúdos</button>
	 			
	       	<button type="button" name="listar" value="listar" class="btn btn-dark mr-2" onclick="window.location = 'index.php?pag=menu-lista'">Listar Menus</button>

	       	<button type="button" name="voltar" value="voltar" class="btn btn-dark mr-2" onclick="window.location = 'index.php?pag=conteudo-cad&menu_id=<?=$menu_id?>'">Efetuar Outro Cadastro</button>
		</div>
		<?php }?>


        
      </div>
    </div>
  </div>
  
 
</div>  

