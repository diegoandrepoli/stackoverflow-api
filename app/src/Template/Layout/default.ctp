<!DOCTYPE html>
	<html>
		<head>
    		
    		<?= $this->Html->charset() ?>
    		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    		
    		<title><?= h('PHP - StackOverflow')?></title>
    		    		
    		<?= $this->Html->meta('icon') ?>

			<?= $this->Html->css('bootstrap.min.css') ?>
			<?= $this->Html->css('custom.css') ?>
	
    		<?= $this->Html->script('jquery-1.11.3.min.js') ?>
    		<?= $this->Html->script('custom.js') ?>			
    		
    		<?= $this->fetch('meta') ?>
    		<?= $this->fetch('css') ?>
    		<?= $this->fetch('script') ?>
    		    		
		</head>
	<body>	
		<!-- Messages -->
		<?= $this->Flash->render() ?>
		
		<!-- Page content -->
		<?= $this->fetch('content') ?>
	</body>
</html>
