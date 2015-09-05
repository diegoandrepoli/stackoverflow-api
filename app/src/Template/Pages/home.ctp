<div class="main" >
	<div class="container" >
		<div class="row">
    		<h1><?= h('PHP - StackOverflow') ?></h1>    	
    		    		    		  
			<button class="btn btn-primary persist-data"><?= h('Persistir Dados')?></button>    	
			<div class="message">
    			<!-- ajax messages here -->
    		</div>
    	
    		<br/>    	
    		<div class="row">
    			<div class="col-sm-7">
    				<div class="form-container">
    					<?php echo $this->Form->create(); ?>    		
    						<div class="row">    	  					
  								<div class="col-sm-3">
	  								<div class="form-group">
	  								<label><?= h('Page')?></label>
    								<?php echo $this->Form->input('page', array('label' => false, 'class' => 'form-control')); ?>
	  							</div>
  							</div>
  			
  							<div class="col-sm-3">
  								<div class="form-group">
  									<label><?= h('RPP')?></label>
    								<?php echo $this->Form->input('rpp', array('label' => false, 'class' => 'form-control')); ?>
								</div>
  							</div>
  					
  							<div class="col-sm-3">
  								<div class="form-group">
  									<label><?= h('Sort')?></label>
    								<?php echo $this->Form->input('sort', array('label' => false, 'class' => 'form-control')); ?>
  								</div>
  							</div>
  
  							<div class="col-sm-3">
  								<div class="form-group">
  									<label><?= h('Score')?></label>
    								<?php echo $this->Form->input('score', array('label' => false, 'class' => 'form-control')); ?>
  								</div>
	  						</div>
	  				
		  					<div class="col-sm-12">  						
								<?php echo $this->Form->button('Buscar', array('class' => 'btn btn-success'));?> 
							</div>     
						</div>     	
					<?php echo $this->Form->end(); ?>		
    			</div>	
    		</div>
    		
    		<div class="row">    			
    			<div class="col-sm-12">
    				<div class="output-data">    				
    					<!--  output data ajax here! -->    				    	
    				</div>
    			</div>	
    		</div>	   		    	
		</div>    			
	</div>
</div>

<script>
	var apiURL = '<?php echo $apiUrl ?>';
	var context = '<?php echo $this->Url->build('/', true);?>'
	var loading = '<?php echo $this->Html->image('/img/loading.gif', array('class' => 'loading')) ?>'
</script>