
        <!--Header area start here-->

        <? include "menu_topo.php"?>
        <!--Header area end here-->
        <!--Breadcumb area start here-->
        <div class="breadcumb-area jarallax"></div>
        <!--Breadcumb area end here-->

        <!--Blog list area start here-->
        <section class="blog-area-page section">
            <div class="container">
               
               <div class="section-heading-three"><h2>ÚLTIMAS POSTAGENS</h2></div>
               
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 pd-0">
                       
                       
<?
              $a=1;

			  $sql = "
				SELECT 
					conteudo.titulo as ct_titulo,
					conteudo.data as ct_data,
					conteudo.foto_reduzida as ct_foto_reduzida,
          conteudo.chamada as ct_chamada,
					conteudo.uri as ct_uri,
					menu.uri as mnu_uri
						
					FROM conteudo 				
					LEFT JOIN menu ON conteudo.menu_id = menu.id
					
					WHERE conteudo.situacao = 'on' AND menu.menu_localizacao_id = '4'
					
					ORDER BY data DESC LIMIT 8
			  ";
			  
				$consulta = "SELECT * FROM conteudo";
				$result = mysql_query($sql);
        echo mysql_error();
		  
				while($row = mysql_fetch_array($result)){

					$uriMenu = $row['mnu_uri'];
					$uriConteudo = $row['ct_uri'];
					
					$foto_reduzida = $row['ct_foto_reduzida'];
					$titulo = $row['ct_titulo'];
					$data = $row['ct_data'];
          $chamada = $row['ct_chamada'];
					
					$diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
					$diasemana_numero = date('w', strtotime($data));
					  
					$mes = array('','Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
					$mes_numero = date('m', strtotime($data))*1;
					//echo "mes:$mes_numero";
          $mes_publicacao = substr($mes[$mes_numero],0,3);
					  
					$dia = date('d', strtotime($data));
					$ano = date('Y', strtotime($data));
					  
					echo "




                        <div class=\"col-lg-6 col-md-6 col-sm-12 col-xs-12\">
                            <div class=\"blog-list\">
                                <figure>
                                    <img src=\"".BASE."/user_files/foto_reduzida\_$foto_reduzida\" alt=\"\"/>
                                    <div class=\"date\">
                                        <strong>$dia</strong>
                                        <span>$mes_publicacao</span>
                                    </div>
                                </figure>
                                <div class=\"content\">
                                    <h3>$titulo</h3>
                                    <p>$chamada</p>
                                    <a href=\"".BASE."/blt/$uriMenu/$uriConteudo\">
                                    Leia mais <i class=\"fa fa-angle-double-right\"></i></a>
                                </div>
                            </div>
                        </div>



						
						
					";
          
		  
		  		}

            ?>
                                              
                       
                        
                        
                        
                        
                        
                        <!--
                        
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="pagination">
                                <div class="media">
                                    <div class="pull-left">
                                        <ul class="list-inline">
                                            <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                            <li><a href="#" class="active">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li>...</li>
                                            <li><a href="#">24</a></li>
                                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="pull-right">
                                        <p>Page 1 of 12</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        -->
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="sidebar">
                            <!-- <div class="widget search-area">
                                <form>
                                    <input type="search" placeholder="Search...">
                                    <button><i class="fa fa-search"></i></button>
                                </form>
                            </div> -->
                       <div class="widget categories">
                                <h3>Categorias</h3>                            
                            
<?
              $a=1;

			  $sql = "
				SELECT 
					*
					FROM menu 				
					WHERE situacao = 'on' AND menu_localizacao_id = '4'
					ORDER BY ordem  
			  ";
				$result = mysql_query($sql);
		  
				while($row = mysql_fetch_array($result)){
					$uriMenu = $row['uri'];
					$titulo = $row['titulo'];
          $id_menu = $row['id'];

          
          //descobrindo quantos conteúdos tem o menu
          $sql_c = "SELECT id FROM conteudo WHERE menu_id = $id_menu"; // Alterar condições para filtrar registros
          $query_c = mysql_query($sql_c);
          $qtde = mysql_num_rows($query_c);
          
					echo "

                       
                                <div class=\"list-categories media\">
                                    <div class=\"pull-left\">
                                        <span>
                                        <a href=\"".BASE."/bll/$uriMenu\" >$titulo</a>
                                        
                                        
                                        </span>
                                    </div>
                                    <div class=\"pull-right\">
                                        <strong>($qtde)</strong>
                                    </div>
                                </div>
                            

					";
  
    		}

  ?>                            
                            
                            
                            
                            
                           </div> 
                            
                            <div class="widget author">
                                <h3>Sobre a Autora</h3>
                                <div class="author-content">
                                    <figure>
                                        <img src="images/blog/10.jpg" alt=""/>
                                        <a href="#" class="btn1"><span>Regina Bianch</span></a>
                                    </figure>
                                    <!-- <h4>Estilista</h4>
                                    <ul class="list-inline">
                                        <li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
                                        <li><a href="#"><i class="fa fa-vimeo-square"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
                                    </ul> -->
                                </div>                               
                            </div>
                            <div class="widget instagram">
                                <h3>Instagram </h3>
                                <? include "instagram.php"?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Blog list area end here-->
