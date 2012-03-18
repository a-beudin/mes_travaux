var FlickrSearch = new Class({
	
	Binds: ['display', 'createDiv'],

	initialize: function(i, d){
		this.recherche = $(i).value;
		this.nom = $(i).name;
		this.selectionDiv = d;
		this.imageDiv = 'images';
	},
	display: function(){
		var url = '../ajax/index.php';
		var getdata = this.nom + "=" + this.recherche;
		var ajax = new Request({
			'url': url,
			'method': 'get',
			'data': getdata,
			onComplete: this.createDiv.bind(this)
		});
		ajax.send();
	},
	createDiv: function(data) {
		var selDiv = this.selectionDiv;
		div = new Element('div', {'id' : this.imageDiv});
		div.inject($(document.body), 'bottom');
		div.set('html', data);
		div.getElements(".photo a").addEvent('click', function(ev){
			var parent = $(this).getParent();
			var clone = parent.clone();
			var lien = clone.getElement('a');
			lien.set('text', 'Supprimer');
			lien.addEvent('click', function(e) {
				lien.getParent().dispose();
				e.stop();
			});
			clone.inject(selDiv, 'bottom');
			input = new Element('input', {
							'type' : 'hidden',
							'name' : $(this).getParent().getElement('img').get('alt'),
							'value'	: $(this).getParent().getElement('img').get('src')		  	
			});
			input.inject(selDiv, 'bottom');
			ev.stop();
		});
		div.getElements("#finirSelection").addEvent('click', function(ev){
			div.dispose();
			ev.stop();
		});
	}
});
