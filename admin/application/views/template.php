<!DOCTYPE html>
<html lang="en">
<head>
<title>Sistema</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-style.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-media.css" />
<link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/fullcalendar.css" /> 
<link rel="stylesheet" href="<?php echo base_url();?>assets/image-picker/image-picker.css" /> 

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<script type="text/javascript"  src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script type="text/javascript"  src="<?php echo base_url();?>assets/image-picker/image-picker.min.js"></script>


<script type="text/javascript"  src="<?php echo base_url();?>assets/js/jquery.uniform.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/uniform.css" /> 

<script type="text/javascript"  src="<?php echo base_url();?>assets/js/select2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/select2.css" /> 


<script type="text/javascript"  src="<?php echo base_url();?>assets/js/wysihtml5-0.3.0.js"></script>
<script type="text/javascript"  src="<?php echo base_url();?>assets/js/bootstrap-wysihtml5.js"></script>
<script type="text/javascript"  src="<?php echo base_url();?>assets/js/moneymask.js"></script>
<script type="text/javascript"  src="<?php echo base_url();?>assets/js/maskaras.js"></script>
<script type="text/javascript"  src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript"  src="<?php echo base_url();?>assets/js/jquery.blockUI.js"></script>

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-wysihtml5.css" /> 


<link rel="stylesheet" href="<?php echo base_url();?>js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.min.css">
<script src="<?php echo base_url();?>js/jquery-ui/js/jquery-ui.js"></script>


<!-- Notificacoes -->
<script src="<?php echo base_url();?>assets/js/jquery.gritter.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.gritter.css" /> 

<script>
	
	$(document).ready(function(){
		<?php if($acao != 'images'){?>
		//$('select').select2();
		$('input[type=radio], input[type=checkbox], input[type=file]').uniform();
		$('.textarea_editor').wysihtml5();
		
		$('.tip').tooltip();	
		$('select').select2();	
		
		$("input[rel='dinheiro']").maskMoney({symbol:"R$",decimal:",",thousands:"."});
		$("input[rel='percent']").mask("99%");
		$("input[rel='hora']").mask("99:99");
		$("input[rel='data']").mask("99/99/9999");
		$("input[rel='cnpj']").mask("99.999.999/9999-99");
		$("input[rel='fone']").mask("(99) 9999-9999");
		$("input[rel='cpf']").mask("999.999.999-99");
		$("input[rel='cep']").mask("99999-999");
		
		<?php } ?>
		
	})
	
</script>
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="">Sistema</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
   
    <li class=""><a title="" href="<?php echo base_url();?>index.php/mapos/sair"><i class="icon icon-share-alt"></i> <span class="text">Sair do Sistema</span></a></li>
  
    <li class=""><a title="" href="<?php echo base_url()?>"><i class="icon icon-home"></i> <span class="text">Início</span></a></li>
    
  </ul>
</div>


<?php
if(!isset($acao))
	$acao = "undefined";
?>
<!--start-top-serch-->
<div id="search">
  <form action="<?php echo base_url()?>index.php/mapos/pesquisar">
    <input type="text" name="termo" placeholder="Pesquisar..."/>
    <button type="submit"  class="tip-bottom" title="Pesquisar"><i class="icon-search icon-white"></i></button>
    
  </form>
</div>
<!--close-top-serch--> 

<!--sidebar-menu-->

<div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-list"></i> Menu</a>
  <ul>


    <li class="<?php if(isset($menuPainel)){echo 'active';};?>"><a href="<?php echo base_url()?>"><i class="icon icon-home"></i> <span>Dashboard</span></a></li>
    
    <?php //if($this->permission->checkPermission($this->session->userdata('permissao'),'vCliente')){ ?>
        <li class="<?php if($controller == "cliente"){echo 'active';};?>"><a href="<?php echo base_url()?>index.php/cliente"><i class="icon icon-group"></i> <span>Clientes</span></a></li>
    <?php //} ?>
    
    
  </ul>
</div>

<div id="content">

<?php if(!$AcessoLimitado){ ?>
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url()?>" title="Dashboard" class="tip-bottom"><i class="icon-home"></i> Dashboard</a> <?php if($this->uri->segment(1) != null){?><a href="<?php echo base_url().'index.php/'.$this->uri->segment(1)?>" class="tip-bottom" title="<?php echo ucfirst($this->uri->segment(1));?>"><?php echo ucfirst($this->uri->segment(1));?></a> <?php if($this->uri->segment(2) != null){?><a href="<?php echo base_url().'index.php/'.$this->uri->segment(1).'/'.$this->uri->segment(2) ?>" class="current tip-bottom" title="<?php echo ucfirst($this->uri->segment(2)); ?>"><?php echo ucfirst($this->uri->segment(2));} ?></a> <?php }?></div>
  </div>
<?php } ?>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
          <?php if($this->session->flashdata('error') != null){?>
                            <div class="alert alert-danger">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <?php echo $this->session->flashdata('error');?>
                           </div>
                      <?php }?>

                      <?php if($this->session->flashdata('success') != null){?>
                            <div class="alert alert-success">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <?php echo $this->session->flashdata('success');?>
                           </div>
                      <?php }?>
                          
                      <?php if(isset($__PAGINA__)){echo $this->load->view($__PAGINA__);}?>


      </div>
    </div>
  </div>
</div>
<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2018 &copy; WDEZ - Desenvolvimento de Sistemas</div>
</div>
<!--end-Footer-part-->


<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/matrix.js"></script> 


</body>
</html>

