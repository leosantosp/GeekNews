"use strict"
var tagConfig = {origem:"active-tag" , destino: "disable-tag"}

function tagEvent(){
	var item;
	if(tagConfig.origem==this.dataset.status){
		item = templateTag(this.dataset.nome,this.dataset.id,tagConfig.destino);
		var container = document.querySelector('.'+tagConfig.destino);
		container.appendChild(item);
	}
	if(tagConfig.destino==this.dataset.status){
		item = templateTag(this.dataset.nome,this.dataset.id,tagConfig.origem);
		var container = document.querySelector('.'+tagConfig.origem);
		container.appendChild(item);
	}
	this.remove();
}
function templateTag(nome,id,status=tagConfig.origem){

	var div = document.createElement('a');

	/* add class */
	//div.classList.add("btn");
	//div.classList.add("btn-default");
	div.classList.add("item-tag");
	div.classList.add("noselect");
	
	div.style.cursor ='pointer';

	/* add Atributos div */
	div.setAttribute("data-nome", nome);
	div.setAttribute("data-id", id);
	div.setAttribute("data-status", status);
	div.addEventListener('click', tagEvent);

	var input = document.createElement('input');

	/* add Atributos input */
	input.setAttribute("type", "hidden");
	

	if(tagConfig.origem == status){ input.setAttribute("name", "tagRvm[]"); }
	if(tagConfig.destino == status){ input.setAttribute("name", "tagAdd[]"); }

	input.setAttribute("value", id);

	var buttonStatus = document.createElement('div');

	if(tagConfig.origem == status){ buttonStatus.classList.add("btn-success"); }
	if(tagConfig.destino == status){ buttonStatus.classList.add("btn-danger"); }

	buttonStatus.classList.add("btn");
	buttonStatus.classList.add("btn-circle");
	buttonStatus.classList.add("btn-md");

	var  buttonIcon = document.createElement('span');
	buttonIcon.classList.add("glyphicon");
	if(tagConfig.origem == status){ buttonIcon.classList.add("glyphicon-share-alt"); }
	if(tagConfig.destino == status){ buttonIcon.classList.add("glyphicon-remove"); }

	buttonStatus.style.cursor ='pointer';
	buttonStatus.appendChild(buttonIcon);


	buttonStatus.appendChild(input);
	div.innerHTML = nome;
	div.appendChild(buttonStatus);

	return div;
}