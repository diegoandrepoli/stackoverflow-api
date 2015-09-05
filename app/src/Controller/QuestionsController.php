<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Questions Controller
 *
 * @property \App\Model\Table\QuestionsTable $Questions
 * @author Diego Andre Poli <diegoandrepoli@gmail.com>
 */
class QuestionsController extends AppController {
    
	// util constants
	const JSON_DECODE =  'json_decode';
	const AJAX = 'ajax';		

	// constantes de paginação
	const ROWS_PER_PAGE = 99;

	/**
	 * (non-PHPdoc)
	 * @see \App\Controller\AppController::initialize()
	 */
    public function initialize() {    	
        parent::initialize();        
        $this->loadComponent('Paginator');
    }       
    
	/**
	 * Retorna valor de parâmetro da URL
	 * 
	 * @param string - nome do parâmetro
	 * @return string - valor do parâmetro
	 */
	private function getURLParam($param = null){
		return $_GET[$param];
	}
	
	/**
	 * Seta dados em array para conversão em json
	 * @param string $question - item do array
	 */
	private function setItemOutputData($question = null){
		
		// retorna array com novo modelo de dados
		return array(
			// last update for post
			'last_update' => $question->last_update,
				
			// post content
			'content' => array(
					// post id
					'question_id' => $question->id,
					
					// post title
					'title' => $question->title,
				
					// author name
					'owner_name' => $question->owner_name,
					
					// post score
					'score' => $question->score,
					
					// date creation post
					'creation_date' => $question->creation_date,
					
					// post link
					'link'=> $question->link,
					
					// answered post?
					'is_answered' => $question->is_answered,
				)
		);
	}
	
	/**
	 * Retorna coleção de objetos do tipo question  
	 * @param string $questions - array de itens do tipo question
	 * @return array - itens agrupados?
	 */
	private function iterateOutputArray($questions = null){
		
		// new main array data
		$output = array();
		
		// itera no array organizando dados
		foreach ($questions as $question){
			array_push($output, $this->setItemOutputData($question));
		}		
		
		// retorna nova saída (array)
		return $output;		
	}
	
	/**
	 * Retorna query para ordenação pelo label pasado como parâmetro
	 * @param string $sort - label para oderdenação na query
	 */
	private function getSortArray($sort){		
	
		// se a propriedade sort foi informada
		if($sort != null){		
			// adiciona filto
			return array("Questions.{$sort}" => 'ASC');
		}else {			
			// sem filtro informado
			return array();
		}
	}
	
	/**
	 * Retorna query seleção de score maior que o informado por parâmetro
	 * @param string $score - score number
	 */
	private function getScoreArray($score = null){
		
		if($score != null){
			// score maior que o informado
			return array('Questions.score >' => $score);
		}else{
			// return empty score array
			return array();
		}
	}
	
	/**
	 * Verifica e retorna limite de itens por pagina
	 * @return integer - limit per page
	 */
	private function setPageLimit($rpp){
		
		if($rpp != null){
			return array('limit'=> $rpp);
		}else{
			return array('limit'=> self::ROWS_PER_PAGE);
		}
	}
	
	/**
	 * Retorna número da página informada por parâmetro
	 * @param string $page - numero da página passado por parâmetro
	 * @return string | NULL
	 */
	private function getNumberPage($page){
		if($page != null){
			return $page;
		}else{
			return null;
		}
	}
		
	/**
	 * Retorna arry de objetos do tipo question no formato json a partir dos valores pasados 
	 * por parâmetro na URL (page, rpp, sort, score).	 
	 */
    public function get() {

    	// view é ajax, não usa layout
    	$this->layout = false;

    	// get url para page
    	$page = $this->getURLParam('page');
    	
    	// get url param rpp
    	$rpp = $this->getURLParam('rpp');
    	
    	// get url param sort
    	$sort = $this->getURLParam('sort');
    	
    	// get url param score
    	$score = $this->getURLParam('score');    	    		        	  
    	    	
    	// seta página informada (número da página)
    	$this->request->params['named']['page'] = $page; 
    	
    	// set page limit
    	$this->paginate = $this->setPageLimit($rpp);    	    	    			
    	
    	// execute query
    	$questions = $this->Questions->find()
    		->where($this->getScoreArray($score))
    		->order($this->getSortArray($sort));
    	
    	$questions = $this->paginate('Questions');
    	
    	// itera o array organizando dados
    	$mainData = $this->iterateOutputArray($questions);    	   
    	    	    
    	// set result data
    	$this->set('result', json_encode($mainData, JSON_PRETTY_PRINT));
    }    
    
    /**
     * Limpa informações antigas
     */
    private function clean() {    	
    	// só não entendi porque não funciona sem a condição 1=1 :(
    	$this->Questions->deleteAll(array('1'=>'1'));
    }
    
    /**
     * Seta item no objeto derivado do model quando ambos labels são comapativeis
     * @param string $question - origem
     * @param string $item -  destino
     * @param string $label - parâmetro
     */
    private function setObjectItem($question, $item, $label){
    	$question[$label] = $item[$label];
    	return $question;
    }
    
    /**
     * Atribui item ao objeto destino quandos os labels forem diferentes
     * @param string $question - objeto destino
     * @param string $item - objeto origem
     * @param string $label - parâmetro destino
     * @param string $way - parâmetro origem
     */
    private function setObjectItemWay($question, $item, $label, $way){    	
		$question[$label] = $item[$way];    	    	    
    	return $question;
    }
    
    /**
     * Seta valor do objeto destino no objeto origem
     * @param string $question - objeto destino
     * @param string $item - objeto origem
     * @param string $label - parâmetro odetino
     * @param string $value - valor de origem
     */
    private function setObjectItemValue($question, $item, $label, $value){
    	$question[$label] = $value;
    	return $question;
    }
        
    /**
     * Set dados no objeto derivado do model
     * @param string $question - origem
     * @param string $item - destino
     */
    private function getObjectData($question, $item){
    	
    	// ser title object
    	$question = $this->setObjectItem($question, $item, 'title');
    	
		// set socore object
    	$question = $this->setObjectItem($question, $item, 'score');
    	
    	// set link object
    	$question = $this->setObjectItem($question, $item, 'link');
    	    	   
    	// set last update data
    	$question = $this->setObjectItemWay($question, $item, 'last_update', 'last_activity_date');
    	
    	// set last update object
    	$displayName = $item['owner']['display_name'];
    	$question = $this->setObjectItemValue($question, $item, 'owner_name', $displayName);
    	
    	// creation date
    	$question = $this->setObjectItem($question, $item, 'creation_date');
    	
    	// creation date
    	$question = $this->setObjectItem($question, $item, 'is_answered');    	     	
    	return $question;    	 
    }
    
    /**
     * Prepara mensagem para envi no formato Json
     * @param string $mesage - mensagem
     */
    private function getOutputJsonDecode($mesage = null){
    	return json_encode(Array('save' => $mesage));    	
    }
        
    /**
     * Persiste dados no banco de dados, limpa dados existentes e adiciona novos dados
     */
    public function add() {    	
    	
    	// ajax view
    	$this->layout = false;    	
    	    
    	// se request é um ajax
    	if($this->request->is(self::AJAX)) {    		    	
    		
    		// apaga informações antigas
    		$this->clean();
    		
    		// get json data
    		$data = $this->request->input(self::JSON_DECODE);
    		
    		// get json itens
    		$items = $this->request['data']['items'];    		   	
    		    		    	
    		// iterate no objeto json
			foreach ($items as $item){
		    
		    	// nova entidade
		        $question = $this->Questions->newEntity();
		        
		        // seta dados no model
		        $question = $this->getObjectData($question , $item);
		        		       
		        // prepare
				$question = $this->Questions->patchEntity($question, $this->request->data);
		        
				// save data
		        if ($this->Questions->save($question)) {		        		        	
		        	// success
		        	$this->set('result', $this->getOutputJsonDecode('Dados persistidos com sucesso'));
		       	} else {		       				       		
		       		// error
		        	$this->set('result', $this->getOutputJsonDecode('Ops, houve um problema ao persistir os dados, tente novamente.'));
		       	}
			}
    	}        
    }    
}
