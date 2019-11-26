$(document).ready(function() {

	$('.button-collapse').sideNav();
	$('select').material_select();
	$("img.lazy").lazyload();

	var box = ""; //Variavel que vai mostrar a div ativa
	var itens = $('.pag').length; //Variavel que conta quantos produtos tem
	var demo = []; //Array para inserir os ids

	for (var i = 0; i < itens; i++) { //Inseri ids variaveis ate chegar o valor total de produtos
		var valoris = { //Armazena a quantidade de ids
			id: i
		}; 
		demo.push(valoris); //Colocar valor na variavel depo
		insert(); //Chama a função
	}

	function insert() {
		var itens = document.getElementsByClassName("pag"); //Pega o elemento com a classe .pag
		var item = document.getElementsByClassName("item"); //Pega o elemento com a classe .pag
		$('.botoes').find('li').first().addClass('active');//Sempre começa pela primeira div ativada
		$('.index').find('.pag').first().addClass('active');//Sempre começa pela primeira div ativada
		itens[i].setAttribute("id",demo[i].id); //Atribui um id unico em cada depoimento
		$('.item').attr( "id", function( demo ) {
			return "pag-" + demo;
  		}); //Atribui um id unico em cada botão
	}

	$('.botoes .item').click(function(event) { //Quando o Botoes for clicado
		var href = this.id;//Pega o id do elemento
		var id = href.split('-');//Filtra o id
		$('.pag.active').removeClass('active'); //Ira remover a classe active da div atual
		$('.item.active').removeClass('active');//Remove a classe active do item atual
		$('.paginacao').find('li.item').first().addClass('active');//Sempre começa pela primeira div ativada
		$('.pag').find('.page').first().addClass('active');//Sempre começa pela primeira div ativada
		$(this).addClass('active'); //Adiciona a classe active no item selecionado
		$('.pag'+'#'+id[1]).addClass('active bounceInRight');//Adiciona a classe active e o efeito de transição na div selecionada
		$('html, body').animate({
			scrollTop: $('#top').offset().top
		}, 1500); //Efeito para manter a visualização sempre no top a cada troca
	});

	var qtdexib = 4; //Numero de páginas por vez (pode alterar)
	var qtdnexib = 0; //Não alterar nada
	var boxis = ""; //Variavel que vai mostrar a div ativa
	var pages = $('.paginacao .page').length; //Variavel que conta quantos paginacao tem
	var paginas = []; //Array para inserir os ids

	if (pages > 1) { // Se houver mais que 1 depoimento acrescente os botões de transição 

		$('.paginacao').append('<ul class="col s12 center pagination"></ul>');
		$('.pagination').append('<li class="prev disabled"><span class="fa fa-chevron-left"></span> Anterior');

	}

	for (var d = 0; d < pages; d++) { //Inseri ids variaveis ate chegar o valor total de paginacao
		var valores = { //Armazena a quantidade de ids
			id: d
		}; 
		paginas.push(valores); //Colocar valor na variavel paginas
		inserir(); //Chama a função
	}

	function inserir() {

		var pages = document.getElementsByClassName("page"); //Pega o elemento com a classe .pag
		var num = document.getElementsByClassName("num"); //Pega o elemento com a classe .num
		var links = document.getElementsByClassName("link");//Pega o elemento com a tag a

		$('.pagination').append('<li class="num"><a class="link">');//Criar um botão para cada pagina
		$('.pagination').find('li.num').first().addClass('active');//Sempre começa pela primeira div ativada
		$('.paginacao').find('.page').first().addClass('active');//Sempre começa pela primeira div ativada
		$('.page').attr( "id", function( paginas ) {
			return "alt-" + paginas;
  		}); //Atribui um id unico em cada botão
  		links[d].innerHTML = paginas[d].id + 1; //Atribui um id unico em cada Pagina)
  		$('.num').attr( "id", function( paginas ) {
  			return "page-" + paginas;
  		}); //Atribui um id unico em cada botão
  	}

  	var contpag = qtdexib;
  	while(contpag < pages){
  		var idnum = '#page-'+contpag;
  		$(idnum).hide();
  		contpag++;
  	}

	if (pages > 1) { // Se houver mais que 1 depoimento acrescente os botões de transição 
		$('.pagination').append('<li class="next">Próximo <span class="fa fa-chevron-right"> ');
	}

	$('.paginacao .num').click(function(event) { //Quando o Botoes for clicado

		var href = this.id;//Pega o id do elemento
		var id = href.split('-');//Filtra o id

		$('.paginacao .active').removeClass('active'); //Ira remover a classe active da div atual
		$('.paginacao .page'+'#alt-'+id[1]).addClass('active bounceInRight')//Adiciona a classe active na div selecionada
		$('.paginacao .num'+'#page'+href).addClass('active');//Adiciona a classe active na div selecionada
		$('.paginacao .num.active').removeClass('active');//Remove a classe active do num atual
		$(this).addClass('active'); //Adiciona a classe active no num selecionado
		$('html, body').animate({
			scrollTop: $('#top').offset().top
		}, 1500); //Efeito para manter a visualização sempre no top a cada troca

		boxis = id[1];
		if (boxis == 0) {
			$('.prev').addClass('disabled');
		}else {
			$('.prev').removeClass('disabled');
		}
		
		if (boxis == (pages - 1)) {
			$('.next').addClass('disabled');
		}else {
			$('.next').removeClass('disabled');
		}

		var atualpag = parseInt(boxis)+1; //Não alterar nada

		if(atualpag == qtdexib && atualpag != pages){
			var idnum = '#page-'+qtdexib;
			$(idnum).show();
			qtdexib++;

			var idnum = '#page-'+qtdnexib;
			$(idnum).hide();
			qtdnexib++;

		}

		if(atualpag == qtdnexib+1 && atualpag != 1){
			var idnum = '#page-'+(qtdexib-1);
			$(idnum).hide();

			qtdexib--;

			var idnum = '#page-'+(qtdnexib-1);
			$(idnum).show();

			qtdnexib--;

		}

	});



	$('.paginacao .next').click(function(event) { //Quando o Botão next for clicado

		if (boxis < (pages - 1)) { //Se o valor da boxis for menor a pag - 1 acrescente mais um
			boxis++;
		}else {
			return false;
		}

		if (boxis > 0 ) {
			$('.paginacao .prev').removeClass('disabled');
		}else {
			$('.paginacao .prev').addClass('disabled');
		}

		if (boxis == (pages - 1)) {
			$('.paginacao .next').addClass('disabled');
		}else {
			$('.paginacao .next').removeClass('disabled');
		}

		$('.paginacao .active').removeClass('active'); //Ira remover a classe active da div atual
		$('.paginacao .page'+'#alt-'+boxis).addClass('active bounceInRight'); //Adiciona a classe active e o efeito de transição na pdiv anterior
		$('.paginacao .num'+'#page-'+boxis).addClass('active');
		$('html, body').animate({
			scrollTop: $('#top').offset().top
		}, 1500); //Efeito para manter a visualização sempre no top a cada 

		var atualpag = parseInt(boxis)+1; //Não alterar nada

		if(atualpag == qtdexib && atualpag != pages){
			var idnum = '#page-'+qtdexib;
			$(idnum).show();
			qtdexib++;

			var idnum = '#page-'+qtdnexib;
			$(idnum).hide();
			qtdnexib++;

		}

		if(atualpag == qtdnexib+1 && atualpag != 1){
			var idnum = '#page-'+(qtdexib-1);
			$(idnum).hide();

			qtdexib--;

			var idnum = '#page-'+(qtdnexib-1);
			$(idnum).show();

			qtdnexib--;

		}

	});



	$('.paginacao .prev').click(function(event) { //Quando o Botão prev for clicado

		if (boxis > 0) { //Se o valor for maior a 0 então tire um valor
			boxis--;
		}else { //Se o valor for igual a 0 vá para o ultimo valor
			return false;
		}

		if (boxis < (pages - 1)) {
			$('.paginacao .next').removeClass('disabled');
		}else {
			$('.paginacao .next').addClass('disabled');
		}

		if (boxis == 0) {
			$('.paginacao .prev').addClass('disabled');
		}else {
			$('.paginacao .prev').removeClass('disabled');
		}

		$('.paginacao .active').removeClass('active'); //Ira remover a classe active da div atual
		$('.paginacao .page'+'#alt-'+boxis).addClass('active bounceInRight'); //Adiciona a classe active e o efeito de transição na pdiv anterior
		$('.paginacao .num'+'#page-'+boxis).addClass('active');
		$('html, body').animate({
			scrollTop: $('#top').offset().top
		}, 1500); //Efeito para manter a visualização sempre no top a cada troca

		var atualpag = parseInt(boxis)+1; //Não alterar nada

		if(atualpag == qtdexib && atualpag != pages){
			var idnum = '#page-'+qtdexib;
			$(idnum).show();
			qtdexib++;

			var idnum = '#page-'+qtdnexib;
			$(idnum).hide();
			qtdnexib++;

		}

		if(atualpag == qtdnexib+1 && atualpag != 1){
			var idnum = '#page-'+(qtdexib-1);
			$(idnum).hide();

			qtdexib--;

			var idnum = '#page-'+(qtdnexib-1);
			$(idnum).show();

			qtdnexib--;

		}

	});


});
