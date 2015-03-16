<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="<?php echo site_url('assets/bootstrap/css'); ?>/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo site_url('assets/merchant/css'); ?>/merchant.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<div class="container">
		<?php echo validation_errors(); ?>
		<form action="<?php echo site_url('merchant/login'); ?>" method="POST" class="form-inline">
			<div class="form-group">
				<label class="sr-only" for="exampleInputEmail3"><?php echo lang('Escribe tu email'); ?></label>
				<input type="email" name="email" class="form-control" id="exampleInputEmail3" placeholder="<?php echo lang('Escribe tu email'); ?>" value="<?php echo $email ?>">
			</div>

			<div class="form-group">
				<label class="sr-only" for="exampleInputPassword3"><?php echo lang('Escribe tu contraseña'); ?></label>
				<input type="password" name="password" class="form-control" id="exampleInputPassword3" placeholder="<?php echo lang('Escribe tu contraseña'); ?>">
			</div>

			<div class="checkbox">
				<label>
					<input type="checkbox"> <?php echo lang('Recordarme'); ?>
				</label>
			</div>
			<button type="submit" class="btn btn-default"><?php echo lang('Ingresar'); ?></button>
		
		</form>

    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo site_url('assets/bootstrap/js'); ?>/bootstrap.min.js"></script>
  </body>
</html>