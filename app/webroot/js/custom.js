/**
 * Prototype
 * Manipulação de String
 */
String.prototype.format = function() {
	var formatted = this;
	for (var i = 0; i < arguments.length; i++) {
		var regexp = new RegExp('\\{' + i + '\\}', 'gi');
		formatted = formatted.replace(regexp, arguments[i]);
	}
	return formatted;
};

/**
 * Mostra imagem animada ao buscar dados via ajax
 * @param element - element destino do loading (classe)
 */
function setLoading(element){
	$('.{0}'.format(element)).html(loading);				
}

/**
 * Retorna valor do component input	 
 * @param id - elemento html
 */
function getInputValue(id){
	return $('#{0}'.format(id)).val();
}

/**
* Utilizado para buscar fragmento
* @param url - endereço do serviço
* @param locate - classe destino
*/
var Fragment = function() {
	
	return {
		initialize : function(url, locate) {

			// destino
			var element = '.{0}'.format(locate); 
					
			// get data
			$.get(url, function(data) {
				$('.{0}'.format(locate)).html(data);				
			});												
		}
	}	
}

/**
 * Persistência dos dados
 * @param url - url da api
 * @param element - element html destino
 */
var Persist = function() {
	
	// add data json url
	var postURL = '{0}questions/add'.format(context);
	
	// main action
	return {
		initialize : function(url, element) {
			
			// adiciona animação - aguarde...
			setLoading(element);						
			
			// get data from api
			$.getJSON(url, function(data) {					
				postData(data, element);
			});											
		}
	}
	
	// post data to controller
	function postData(data, element) {
		
		// send data to controller
		$.ajax({
			url: postURL,
			type: 'POST',
			data: data,
			dataType: 'json',
			async: false
		}).done(function(data){
			addMessage(data, element);
		});
	}
	
	// mensagem de sucesso ou erro
	function addMessage(data, element) {		
		$('.{0}'.format(element)).html(data.save);
	}
}

/**
 * Pega todos elementos do formulário e cria url com estes parâmetros, faz get nesta
 * URL e adiciona os dados no elemento passado como parâmetro
 * @param element - elemento html destino (classe)
 */
var GetData = function() {				
	
	// form data values
	var _page = getInputValue('page');
	var _rpp = getInputValue('rpp');
	var _sort = getInputValue('sort');
	var _score = getInputValue('score');
	
	return {
		initialize : function(element) {

			// adiciona animação
			setLoading(element);

			// url do serviço
			var url  = '{0}/questions/get?page={1}&rpp={2}&sort={3}&score={4}'.format(context, _page, _rpp, _sort, _score);						
			
			// busca dados e adiciona na div destino - sobscreve loading
			$.get(url, function(data) {
				$($('.{0}'.format(element)).html(data));						
			});		
				
			// stop submit - false or prevent default
			return false;											
		}
	}	
}

/**
 * Ações globais
 */
$(document).ready(function(){
	
	/**
	 * Persistencia dos dados - ação do botão
	 */
	$('.persist-data').click(function(){	
		
		// persist data function
		var persist = new Persist();
		persist.initialize(apiURL, 'message');
	});	
	
	/**
	 * Ação ao submeter form
	 */
	$('.form-container form').submit(function(){			
		
		// action data
		var get = new GetData();
		get.initialize('output-data');
		
		// stop form :P
		return false;
	});
});