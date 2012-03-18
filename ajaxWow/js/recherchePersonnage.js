var RecherchePersonnage = new Class({

	Binds: ['display', 'createDiv'],
	Gender : {0 : 'Hommes', 1 : 'Femmes'},
	Classe : {'Hommes' : {
				1 : 'Guerrier',
				4 : 'Voleur',
				5 : 'Prêtre',
				3 : 'Chasseur',
				2 : 'Paladin',
				7 : 'Chaman',
				9 : 'Démoniste',
				6 : 'Chevalier de la mort',
				11 : 'Druide',
				8 : 'Mage'
				},
			 'Femmes' : {
				1 : 'Guerrière',
				4 : 'Voleuse',
				5 : 'Prêtresse',
				3 : 'Chasseresse',
				2 : 'Paladin',
				7 : 'Chamane',
				9 : 'Démoniste',
				6 : 'Chevalier de la mort',
				11 : 'Druidesse',
				8 : 'Mage'
				}
			},
	Race : {'Hommes' : {
				4 : 'Elfe de la nuit',
				22 : 'Worgen',
				1 : 'Humain',
				8 : 'Troll',
				9 : 'Gobelin',
				7 : 'Gnome',
				10 : 'Elfe de sang',
				11 : 'Draeneï',
				3 : 'Nain',
				6 : 'Tauren',
				5 : 'Mort-vivant',
				2 : 'Orc'
				},
			'Femmes' : {
				4 : 'Elfe de la nuit',
				22 : 'Worgen',
				1 : 'Humaine',
				8 : 'Trollesse',
				9 : 'Gobeline',
				7 : 'Gnome',
				10 : 'Elfe de sang',
				11 : 'Draeneï',
				3 : 'Naine',
				6 : 'Taurène',
				5 : 'Morte-vivante',
				2 : 'Orque'
				}
			},
	
	initialize: function(p, s, d){
		this.recherchePersonnage = $(p).value;
		this.nomRecherchePersonnage = $(p).name;
		this.rechercheServeur = $(s).value;
		this.nomRechercheServeur = $(s).name;
		this.selectionDiv = d;
		this.resultDiv = 'resultat';
	},
	display: function(){
		var url = '../ajax/index.php';
		var getdata = 'serveur=' + this.rechercheServeur +'&nom=' + this.recherchePersonnage;
		var ajax = new Request.JSON({
			url: url,
			method: 'get',
			data: getdata,
			onComplete: this.createDiv.bind(this)
		});
		ajax.send();
	},
	createDiv: function(data) {
		var race = this.Race[this.Gender[data['gender']]][data['race']];
		var classe = this.Classe[this.Gender[data['gender']]][data['class']];
		
		$$('#'+this.selectionDiv+' legend').set('text', data['name']+', '+race+' '+classe+' de niveau '+data['level']);
		
		p = new Element('p').inject($(this.selectionDiv));
		p.set('html', 'Membre de : '+data['guild']['name']+'<br />'+
						data['achievementPoints']+' points de hauts-faits<br />'+
						'Niveau d\'objet : '+data['items']['averageItemLevel']+' / '+data['items']['averageItemLevelEquipped']+' équipé');
		
		h3 = new Element('h3');
		h3.set('text', 'Progression :');
		h3.inject($(this.selectionDiv), 'bottom');
		
		var raids = data['progression']['raids'];
		for (var n=19; n<raids.length; n++) {
			var raid = data['progression']['raids'][n];
			tabBosses = new Element('table', {'class' : 'tabBosses'}).inject($(this.selectionDiv), 'bottom');
			tabBosses.set('html', '<tr><th colspan="3">'+raid['name']+'</th></tr><tr><th>Boss</th><th>NM</th><th>HM</th></tr>');
			var bosses = raid['bosses'];

			for (var m=0; m<bosses.length; m++) {
				tr = new Element('tr');
				tr.set('html', '<td>'+bosses[m]['name']+'</td><td>'+bosses[m]['normalKills']+'</td><td>'+bosses[m]['heroicKills']+'</td>');
				tr.inject(tabBosses, 'bottom');
			}
		}
	}
});
