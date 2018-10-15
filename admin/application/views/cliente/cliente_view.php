<?php //if($this->permission->checkPermission($this->session->userdata('permissao'),'aCliente')){ ?>



    <a href="<?php echo base_url();?>index.php/<?=$controller?>/save" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Cliente</a>    



<?php //} ?>




	    <form action="<?= base_url(); ?>index.php/<?=$controller?>/busca" method="post" id="formPesquisa" class="form-horizontal">

	    	

	    	<div class="row-fluid" style="margin-top:0">      

 

     <div class="span12">

    

<div class="widget-box">





     <div class="widget-title">

        <span class="icon">

            <i class="icon-user"></i>

         </span>

        <h5>Pesquisa</h5>

     </div>

	<div class="widget-content nopadding">

<div class="row-fluid" style="margin-top:0">          

    

<div class="span12">

<div class="widget-box">



	<div class="widget-content nopadding">

		



            <div class="control-group">

				<label for="Nome" class="control-label">Nome</label>

				<div class="controls"><input type="text" id="Nome" name="Nome" value="" /></div>

			</div>

            <div class="control-group">

				<label for="Email" class="control-label">Email</label>

				<div class="controls"><input type="text" id="Email" name="Email" value="" /></div>

			</div>
            
            <div class="control-group">

				<label for="Telefone" class="control-label">Telefone</label>

				<div class="controls"><input type="text" id="Telefone" name="Telefone" value="" /></div>

			</div>

            

 	</div>

 

 </div>

</div>	


 </div>

 

            <div class="form-actions">

                <div class="span12">

                    <div class="span4">

                    

			            <div class="control-group">

			                <label for="Ordenar" class="control-label">Ordenar Por</label>

						    <div class="controls">

						    	<select name="Ordenar">

						    		<optgroup label="Crescente">
							    		<option value="Nome Asc">Nome</option>
							    		<option value="Telefone Asc">Telefone</option>
						    		</optgroup>					    		

						    		<optgroup label="Decrescente">
							    		<option value="Nome DESC">Nome</option>
							    		<option value="Telefone DESC">Telefone</option>
							    	</optgroup>

						    	</select>

						    </div>

			            </div>

	    			</div>
                    

                    <div class="span4">

                        

			            <div class="control-group">

						    <div class="controls">

					            <button type="submit" class="btnPesquisa btn btn-primary">

		                        	<i class="icon-search icon-white"></i> 

		                        	Pesquisar                           

		                        </button>

						    </div>

			            </div>

                    </div>

                </div>

            </div>





	    	<input  type="hidden" name="busca" id="busca" />

	    	

 	</div>

 

 </div>



 </div>

 </div>

 

	    </form>	

	    

<div class="widget-box">

     <div class="widget-title">

        <span class="icon">

            <i class="icon-user"></i>

         </span>

        <h5>Clientes</h5>

        		

     </div>

     

     

<div class="widget-content nopadding">

<table class="table table-bordered data-table">

    <thead>

        <tr>

            <th>#</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th></th>

        </tr>

    </thead>



    <tbody>

        <?php 

         if(is_array($data_table)){

		 	 foreach ($data_table as $r) {

	            echo '<tr>';

	            echo '<td>'.$r->IDCliente.'</td>';

	            echo '<td>'.$r->Nome.'</td>';

	            echo '<td>'.$r->Email.'</td>';

	            echo '<td>'.$r->Telefone.'</td>';

	          

	            echo '<td>';
	                echo '<a href="'.base_url().'index.php/'.$controller.'/see/'.$r->IDCliente.'" style="margin-right: 1%" class="btn tip-top" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
	                echo '<a href="'.base_url().'index.php/'.$controller.'/update/'.$r->IDCliente.'" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Cliente"><i class="icon-pencil icon-white"></i></a>'; 
	                echo '<a href="#modal-excluir" role="button" data-toggle="modal" cliente="'.$r->IDCliente.'" style="margin-right: 1%" class="btn btn-danger tip-top" title="Excluir Cliente"><i class="icon-remove icon-white"></i></a>'; 
	            echo '</td>';

	            echo '</tr>';



	        }

        

		 }

        ?>



        <tr>



            



        </tr>



    </tbody>



</table>



</div>



</div>



<?php echo $this->pagination->create_links();?>





<!-- Modal -->



<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">



  <form action="<?php echo base_url() ?>index.php/<?=$controller?>/delete" method="post" >



  <div class="modal-header">



    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>



    <h5 id="myModalLabel">Excluir Cliente</h5>



  </div>



  <div class="modal-body">



    <input type="hidden" id="IDCliente" name="IDCliente" value="" />



    <h5 style="text-align: center">Deseja realmente excluir este cliente e os dados associados a ele (OS, Vendas, Receitas)?</h5>



  </div>



  <div class="modal-footer">



    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>



    <button class="btn btn-danger">Excluir</button>



  </div>



  </form>



</div>



  <style>

  .form-horizontal .control-label {

    width: 100px;

  }

  .form-horizontal .controls {

    margin-left: 110px;

  }

  </style>



<script type="text/javascript">



function getPesquisa(){
    var pesquisa = {Telefone:"", Nome:"", Email: ""};
    pesquisa.Nome = $("#Nome").val();
    pesquisa.Telefone = $("#Telefone").val();
    pesquisa.Email = $("#Email").val();
    $("#busca").val(JSON.stringify(pesquisa));
}



$(document).ready(function(){

	

   $(document).on('click', 'a', function(event) {

        var cliente = $(this).attr('cliente');

        $('#IDCliente').val(cliente);

    });



    $("#formPesquisa").submit(function(){

        getPesquisa();

    })





});



</script>



