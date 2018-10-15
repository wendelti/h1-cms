
<style>
	.form-horizontal .controls{
		margin-left: 110px !important;
	}
	.form-horizontal .control-label{
		width: 97px !important;
	}
	
</style>

<form action="<?php echo current_url(); ?>" id="formCliente" method="post" class="form-horizontal" >
<div class="row-fluid" style="margin-top:0">
    <div class="span6">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-user"></i>
                </span>
                <h5><?= $acao == "save" ? 'Cadastro' : 'Edição' ?> de Cliente</h5>
            </div>
            <div class="widget-content nopadding">
                <?php if ($custom_error != '') {
                    echo '<div class="alert alert-danger">' . $custom_error . '</div>';
                } ?>
                
            		<input type="hidden" name="IDCliente" value="<?= $registro ? $registro->IDCliente : '' ?>" />
            
                    <div class="control-group">
                        <label for="Nome" class="control-label">Nome </label>
                        <div class="controls">
                            <input id="Nome"  type="text" name="Nome" value="<?php echo $registro ? $registro->Nome : ''; ?>"  />
                        </div>
                    </div>
                    
                        
                    <div class="control-group">
                        <label for="Telefone" class="control-label">Telefone</label>
                        <div class="controls">
                            <input id="Telefone" type="text" name="Telefone" value="<?php echo $registro ? $registro->Telefone : ''; ?>"  />
                        </div>
                    </div>
                        
                    
					
                    
                    
					
        	</div>
    	</div>
    </div>
                    
    

    <div class="span6">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-user"></i>
                </span>
                <h5><?= $acao == "save" ? 'Cadastro' : 'Edição' ?> de Acesso</h5>
            </div>
            <div class="widget-content nopadding">
                    <?php if(!$AcessoLimitado){?>
                           
                    
                    
                    
		            <div class="control-group">
		                <label for="" class="control-label">Status
		                </label>
		                <div class="controls">
							<label>
		                    	<input class="radioTipo" type="radio" name="Status" value="0" 
		                    		<?= $registro ? ($registro->Status == 0 ? 'checked' : '') : ''  ?>> Inativo
		                    </label>
		                    <label>
		                    	<input class="radioTipo" type="radio" name="Status" value="1" 
		                    		<?= $registro ? ($registro->Status == 1 ? 'checked' : '') : 'checked'  ?>> Ativo
		                    </label>
					    </div>
		            </div>
            		<?php } ?>
                                        
                    <div class="control-group">
                        <label for="email" class="control-label">Email</label>
                        <div class="controls">
                            <input id="Email" type="text" name="Email" value="<?php echo $registro ? $registro->Email : ''; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group" class="control-label">
                        <label for="Senha" class="control-label">Senha</label>
                        <div class="controls">
                            <input id="Senha" type="password" name="Senha" value=""  />
                        </div>
                    </div>
                        
        	</div>
    	</div>
    </div>
</div>
<div class="row-fluid" style="margin-top:0">                  
                
                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                            	<?php if($acao != "see"){ ?>
                                <button type="submit" class="btn btn-<?= $acao == "save" ? 'success' : 'primary' ?>">
                                	<i class="icon-<?= $acao == "save" ? 'plus' : 'ok' ?> icon-white"></i> 
                                	<?= $acao == "save" ? 'Adicionar' : 'Alterar' ?>                           
                                </button>
                                <?php } else { ?>
		                        	<a href="<?= base_url() ?>index.php/<?= $controller ?>/update/<?=$registro->IDCliente?>" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar"><i class="icon-pencil icon-white"></i></a>
		                        <?php } 
		                        if(!$AcessoLimitado){
									
		                        ?>
		                        
                                <a href="<?php echo base_url() ?>index.php/<?= $controller?>" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
</div>

</form>
<script src="<?php echo base_url()?>js/jquery.validate.js"></script>
<!--
,

                 
,
                  CPF :{ required: 'Campo Requerido.'},
                  Telefone:{ required: 'Campo Requerido.'},
                  Email:{ required: 'Campo Requerido.'},
                  Rua:{ required: 'Campo Requerido.'},
                  Numero:{ required: 'Campo Requerido.'},
                  Bairro:{ required: 'Campo Requerido.'},
                  Cidade:{ required: 'Campo Requerido.'},
                  UF:{ required: 'Campo Requerido.'},
                  CEP:{ required: 'Campo Requerido.'}
-->
<script type="text/javascript">
      $(document).ready(function(){
           $('#formCliente').validate({
            rules :{
                  Nome:{ required: true}
                  <?php if($AcessoLimitado){ ?>
                  ,CPF:{ required: true},
                  Telefone:{ required: true},
                  Email:{ required: true},
                  Rua:{ required: true},
                  Numero:{ required: true},
                  Bairro:{ required: true},
                  Cidade:{ required: true},
                  UF:{ required: true},
                  CEP:{ required: true},
                  Email:{ required: true},
                  Senha:{ required: true}
                  <?php } ?>
            },
            messages:{
                  Nome :{ required: 'Campo Requerido.'}
                  <?php if($AcessoLimitado){ ?>
                  ,CPF :{ required: 'Campo Requerido.'},
                  Telefone:{ required: 'Campo Requerido.'},
                  Email:{ required: 'Campo Requerido.'},
                  Rua:{ required: 'Campo Requerido.'},
                  Numero:{ required: 'Campo Requerido.'},
                  Bairro:{ required: 'Campo Requerido.'},
                  Cidade:{ required: 'Campo Requerido.'},
                  UF:{ required: 'Campo Requerido.'},
                  CEP:{ required: 'Campo Requerido.'},
                  Email:{ required: 'Campo Requerido.'},
                  Senha:{ required: 'Campo Requerido.'}
                  <?php } ?>
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
           });
      });
</script>
