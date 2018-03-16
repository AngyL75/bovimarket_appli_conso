$(document).ready(function() {
	$('#holder').toggleClass("visible");

	/*$('a.link').click(function(event) {
		// Over-rides the link
		event.preventDefault();
		// Sets the new destination to the href of the link
		newLocation = this.href;
		color = $(this).data("color");
		$('body').css('background-color', color );
		$('#holder').css('opacity','0' );
		// Delays action
		window.setTimeout(function() {
		    // Redirects to new destination
				window.location = newLocation;
		}, 450);
	});*/

	/*$('h1').click(function(event) {
		$('#holder').toggleClass("visible");
	});*/
	
	$('.button-add-cart').click(function()
	{
		$.get($(this).attr('href') + '?ajax=1') ;
		
		$(this).addClass('button-green') ;
		
		return false ;
	}) ;
	
	$('.toggle').click(function()
	{
		var div = $(this).attr('data-toggle') ;
		
		if($('#' + div).is(':visible'))
		{
			$('#' + div).hide() ;
			$('.fa', this).removeClass('fa-chevron-up') ;
			$('.fa', this).addClass('fa-chevron-down') ;
		}else{
			$('#' + div).show() ;
			$('.fa', this).removeClass('fa-chevron-down') ;
			$('.fa', this).addClass('fa-chevron-up') ;
		}
	}) ;

	$('#switch-list, #back-list').click(switchList) ;
	
	$('.post').click(function()
	{
		$('.extrait', this).toggle() ;
		$('.content', this).toggle() ;
		
		return false ;
	}) ;
	
	$(window).resize(resizeElts) ;
	$(window).resize() ;
});

function resizeElts()
{
	$('#holder').height($(window).height()) ;
}

function switchList()
{
	$('body').toggleClass('map-list') ;
	
	return false ;
}

var MapFilters = 
	{
		initFiltersSlideDone:false,
		filters_value:{label:'',what:'',who:'',where:[]},
		navs:['Label ?', 'Quoi ?', 'Qui ?', 'Où ?'],
		regions:{
			"FR-C":{name:"Auvergne",codes:['03', '15', '43', '63']},
			"FR-B":{name:"Aquitaine",codes:['24', '33', '40', '47', '64']},
		    "FR-A":{name:"Alsace",codes:['67', '68']},
		    "FR-G":{name:"Champagne-Ardenne",codes:['08', '10', '51', '52']},
		    "FR-F":{name:"Centre",codes:['18', '28', '36', '37', '41', '45']},
		    "FR-E":{name:"Bretagne",codes:['22', '29', '35', '56']},
		    "FR-D":{name:"Bourgogne",codes:['21', '58', '71', '89']},
		    "FR-K":{name:"Languedoc-Roussillon",codes:['11', '30', '34', '48', '66']},
		    "FR-J":{name:"Île-de-France",codes:['75', '77', '78', '91', '92', '93', '94', '95']},
		    "FR-I":{name:"Franche-Comté",codes:['25', '39', '70', '90']},
		    "FR-YT":{name:"Mayotte",codes:['976 ']},
		    "FR-O":{name:"Nord-Pas-de-Calais",codes:['59', '62']},
		    "FR-N":{name:"Midi-Pyrénées",codes:['09', '12', '31', '32', '46', '65', '81', '82']},
		    "FR-M":{name:"Lorraine",codes:['54', '55', '57', '88']},
		    "FR-L":{name:"Limousin",codes:['19', '23', '87']},
		    "FR-S":{name:"Picardie",codes:['02', '60', '80']},
		    "FR-R":{name:"Pays de la Loire",codes:['44', '49', '53', '72', '85']},
		    "FR-Q":{name:"Haute-Normandie",codes:['76', '27']},
		    "FR-P":{name:"Basse-Normandie",codes:['14', '50', '61']},
		    "FR-V":{name:"Rhône-Alpes",codes:['01', '07', '26', '38', '42', '69', '73', '74']},
		    "FR-U":{name:"Provence-Alpes-Côte-d'Azur",codes:['04', '05', '06', '13', '83', '84']},
		    "FR-T":{name:"Poitou-Charentes",codes:['16', '17', '79', '86']},
		    "FR-RE":{name:"Réunion",codes:['974']},
		    "FR-GF":{name:"Guyane française",codes:['973']},
		    "FR-H":{name:"Corse",codes:['2A', '2B']},
		    "FR-MQ":{name:"Martinique",codes:['972']},
		    "FR-GP":{name:"Guadeloupe",codes:['971']}
		}
	};

MapFilters.init = function()
{
	if(this.initFiltersSlideDone || $('#filters').length == 0) return false ;
	
	$('#filters').slick({slide:'.slide', arrows: false, initialSlide:1}) ;
	//$('#filters').slick('slickGoTo', 1);
	
	$('#filters .nav-left').click(MapFilters.slickPrev);
	$('#filters .nav-right').click(MapFilters.slickNext);
	$('#filters .list a').click(MapFilters.toggleFilter);
	$('#filters .bar a').click(MapFilters.toggleFilters);
	$('#filters-ok').click(MapFilters.toogle) ;
	$('#filters-results > .toogle').click(MapFilters.showFiltersDetails) ;
	$('#filters-details > .toogle').click(MapFilters.hideFiltersDetails) ;
	$('#filter_search').keyup(MapFilters.filterList) ;
	
	$('#filters').on('swipe', function(event, slick, direction)
	{
		MapFilters.updateNav() ;
	});
	
	this.initFiltersSlideDone = true ;
	
	MapFilters.fillFilters() ;
	
	aParams = window.location.search.substr(1).split('&') ;
	
	if(aParams.length)
	{
		var params = {} ;
		for(var i = 0 ; i < aParams.length ; i++)
		{
			var param = aParams[i].split('=') ;
			
			if(param.length == 2) params[param[0]] = param[1] ;
		}
		
		if(params.label)
		{
			this.filters_value.label = params.label.split(',') ;
			this.filters_value.where = MapFilters.getAllCodeDepartements() ;
		}
		if(params.who) this.filters_value.who = params.who.split(',') ;
		
		this.updateFilters() ;
	}else{
		MapFilters.buildList() ;
	}
	
	setTimeout('MapFilters.resize()', 500) ;
	
	return true ;
}

MapFilters.compareKm = function(a, b)
{
	if(a.km == b.km) return 0 ;
	
	return a.km > b.km ? 1 : -1 ;
}

MapFilters.filterList = function()
{
	MapFilters.buildList() ;
}

MapFilters.buildList = function()
{
	var nb = aMarkers.length ;
	var filter = $('#filter_search').val() ;
	
	$('#list .list_container').html('') ;
	
	for(var i = 0 ; i < nb ; i++)
	{
		var km = 0 ;
		if(current_position)
		{
			km = parseInt(getDistanceFromLatLonInKm(current_position.lat(), current_position.lng(), aMarkers[i].getPosition().lat(), aMarkers[i].getPosition().lng())) ;
		}else{
			km = parseInt(getDistanceFromLatLonInKm(map.getCenter().lat(), map.getCenter().lng(), aMarkers[i].getPosition().lat(), aMarkers[i].getPosition().lng())) ;
		}
		
		aMarkersInfos[i].km = km ;
	}
	
	aMarkersInfos.sort(MapFilters.compareKm)
	
	for(var i = 0 ; i < nb ; i++)
	{
		if(!this.canBeDisplayed(i)) continue ;
		if(!this.hasKeywords(i, filter)) continue ;
		
		var html = '<a href="' + aMarkers[aMarkersInfos[i].index].url + '" class="item">' ;
		html += '<div class="img col-xs-1 hide-padding">' ;
		html += '<img src="' + aMarkers[aMarkersInfos[i].index].icon.url + '" />' ;
		html += '</div>' ;
		
		html += '<div class="text col-xs-11">' ;
		html += '<div>' ;
		if(aMarkersInfos[i].km)
		{
			html += '<span class="km">à ' + aMarkersInfos[i].km + ' km</span>' ;
		}
		if(aMarkersInfos[i].vente_directe)html += ' - <span class="vente">Vente directe</span>' ;
		html += '</div>' ;
		html += '<div>' ;
		html += '<h3>' + aMarkersInfos[i].name + '</h3>' ;
		html += '</div>' ;
		html += '<div>' ;
		html += '' + aMarkersInfos[i].address + '' ;
		html += '</div>' ;
		html += '</div>' ;
		
		html += '</a>' ;
		
		$('#list .list_container').append(html) ;
	}
	
	MapFilters.buildResults() ;
}

MapFilters.buildResults = function()
{
	var nb = $('#list .list_container .item').length ;
	
	$('#filters-results h3, #filters-details h3').text(nb + ' résultat' + (nb > 1 ? 's' : '')) ;
	$('#filters-results .infos > div, #filters-details .infos').html('') ;
	
	var aTextsLabel = MapFilters.getResultsLabels('#filters-what .filter_what') ;
	$('#filters-details .infos').append('<b>Quoi ?</b>') ; 
	$('#filters-results .infos > div, #filters-details .infos').append('<span>' + aTextsLabel.join(', ') + '</span>') ;
	
	aTextsLabel = MapFilters.getResultsLabels('#filters-who .filter_who') ;
	$('#filters-details .infos').append('<b>Qui ?</b>') ; 
	$('#filters-results .infos > div, #filters-details .infos').append('<span>' + aTextsLabel.join(', ') + '</span>') ;
	
	nb = this.filters_value.label.length ;
	var aTextsLabelRegion = MapFilters.getResultsRegions() ;
	var nb2 = aTextsLabelRegion.length ;
	$('#filters-results .infos > div').append('<span>' + nb + ' label' + (nb > 1 ? 's' : '') + ' - ' + nb2 + ' région' + (nb2 > 1 ? 's' : '') + '</span>') ;
	
	aTextsLabel = MapFilters.getResultsLabels('#filters-label .filter_label') ;
	$('#filters-details .infos').append('<b>Label ?</b>') ; 
	$('#filters-details .infos').append('<span>' + aTextsLabel.join(', ') + '</span>') ;
	
	$('#filters-details .infos').append('<b>Ou ?</b>') ; 
	$('#filters-details .infos').append('<span>' + aTextsLabelRegion.join(', ') + '</span>') ;
}

MapFilters.buildMap = function()
{
	$('#mapFr').html('') ;
	
	MapFilters.vectorMap = new jvm.Map({
		container: $('#mapFr'),
		map: 'fr_regions_merc',
        zoomOnScroll: false,
        backgroundColor: "transparent",
        regionsSelectable: true,
        /*regionsSelectableOne: true,*/
        zoomMin:1,
        zoomMax:1,
        regionStyle:{
            initial:{
                fill: "rgb(95, 47, 67)",
                stroke: "#7c5264",
                "stroke-width": 1
            },
            hover:{
                fill: 'ontouchstart' in window ? "#5d3043" : "#8bb000"
            },
            selected:{
                fill: "#8bb000"
            }
        },
        selectedRegions:MapFilters.getSelectedMapRegions(),
        onRegionSelected:MapFilters.selectMap
    }) ;
}

MapFilters.getSelectedMapRegions = function()
{
	var aRegions = {} ;
    for(var code in MapFilters.regions)
    {
    	var bSelected = false ;
    	var aCodes = MapFilters.regions[code].codes ;
    	
    	for(var i = 0 ; i < aCodes.length ; i++)
    	{
    		if(this.filters_value.where.indexOf(aCodes[i]) != -1)
    		{
    			bSelected = true ;
    			break ;
    		}
    	}
    	
    	aRegions[code] = bSelected ;
    }
    
	return aRegions ;
}

MapFilters.getAllCodeDepartements = function()
{
	var aDepartements = [] ;
    for(var code in MapFilters.regions)
    {
    	var aCodes = MapFilters.regions[code].codes ;
    	
    	aDepartements = aDepartements.concat(aCodes) ;
    }
    
	return aDepartements ;
}

MapFilters.selectMap = function(e,code,isSelected,regions)
{
	MapFilters.filters_value.where = [] ;
	
	var aRegions = [] ;
	for(var i = 0 ; i < regions.length ; i++)
	{
		var code = regions[i] ;
		
		MapFilters.filters_value.where = MapFilters.filters_value.where.concat(MapFilters.regions[code].codes) ;
		
		aRegions.push(MapFilters.regions[code].name) ;
	}
		
	$("#localization_input").val(aRegions.join(', ')) ;
	
	MapFilters.updateFilters() ;
}

MapFilters.getResultsRegions = function()
{
	if(!MapFilters.vectorMap) return [] ;
	
	var regions = MapFilters.vectorMap.getSelectedRegions() ;
	var aRegions = [] ;
	for(var i = 0 ; i < regions.length ; i++)
	{
		var code = regions[i] ;
		
		aRegions.push(MapFilters.regions[code].name) ;
	}
		
	return aRegions ;
}

MapFilters.getResultsLabels = function(selector)
{
	var aTextsLabel = [] ;
	var aTextsValue = [] ;
	
	$(selector).each(function()
	{
		var value = $(this).attr('filter-value') ;
		var type = $(this).attr('filter-type') ;
		var aValues = value.indexOf(',') == -1 ? [value] : value.split(',') ;
		var bSelected = false ;
		
		if(aValues.length > 1)
		{
			bSelected = true ;
			
			for(var i = 0 ; i < aValues.length ; i++)
			{
				var index = MapFilters.filters_value[type].indexOf(aValues[i]) ;
				
				if(index == -1)
				{
					bSelected = false ;
					break ;
				}
			}
			
		}else{
			bSelected = $(this).hasClass('selected') && aTextsValue.indexOf(aValues[0]) == -1 ;
		}
		
		if(bSelected)
		{
			aTextsLabel.push($(this).text()) ;
			
			aTextsValue = aTextsValue.concat(aValues) ;
		}
	}) ;
	
	return aTextsLabel ;
}

MapFilters.resize = function()
{
	$('#filters .slick-track, #filters .slide').width($('#filters').width()) ;
}

MapFilters.show = function()
{
	$('#filters').slick('slickGoTo', 1);
	
	$('#filters').show() ;
	$('#filters-results').show() ;
	
	MapFilters.buildMap() ;
	MapFilters.buildResults() ;
}

MapFilters.hide = function()
{
	$('#filters').hide() ;
	$('#filters-results').hide() ;
}

MapFilters.toogle = function()
{
	if($('#filters').is(':visible'))
	{
		$('body').removeClass('filters-opened') ;
		
		//$('.nav3 a').removeClass('fa-check') ;
		//$('.nav3 a').addClass('fa-search') ;
		
		MapFilters.hide() ;
	}else{
		MapFilters.show() ;
		
		//$('.nav3 a').removeClass('fa-search') ;
		//$('.nav3 a').addClass('fa-check') ;
		
		$('body').addClass('filters-opened') ;
	}
	
	return false ;
}

MapFilters.fillFilters = function()
{
	var aFilterLabel = [] ;
	
	$('#filters-label .filter_label').each(function()
	{
		var value = $(this).attr('filter-value') ;
		
		if(value.indexOf(',') == -1 && $(this).hasClass('selected') && aFilterLabel.indexOf(value) == -1)
		{
			aFilterLabel.push(value) ;
		}
	}) ;
	
	this.filters_value.label = aFilterLabel ;
	
	var aFilterWhat = [] ;
	
	$('#filters-what .filter_what').each(function()
	{
		var value = $(this).attr('filter-value') ;
		
		if(value.indexOf(',') == -1 && $(this).hasClass('selected') && aFilterWhat.indexOf(value) == -1)
		{
			aFilterWhat.push(value) ;
		}
	}) ;
	
	this.filters_value.what = aFilterWhat ;
	
	var aFilterWho = [] ;
	
	$('#filters-who .filter_who').each(function()
	{
		var value = $(this).attr('filter-value') ;
		
		if(value.indexOf(',') == -1 && $(this).hasClass('selected') && aFilterWho.indexOf(value) == -1)
		{
			aFilterWho.push(value) ;
		}
	}) ;
	
	this.filters_value.who = aFilterWho ;
	
	MapFilters.updateMap() ;
}

MapFilters.updateFilters = function()
{
	$('#filters-what .filter_what, #filters-what .filter_who, #filters-what .filter_label, #filters-who .filter_who, #filters-label .filter_label').each(function()
	{
		var value = $(this).attr('filter-value') ;
		var type = $(this).attr('filter-type') ;
		var aValues = value.indexOf(',') == -1 ? [value] : value.split(',') ;
		
		var bSelected = false ;
		for(var i = 0 ; i < aValues.length ; i++)
		{
			var index = MapFilters.filters_value[type].indexOf(aValues[i]) ;
			
			if(aValues[i] == 'all' && MapFilters.filters_value[type].length) index = 1 ;
			if(aValues[i] == 'nothing' && MapFilters.filters_value[type].length == 0) index = 1 ;
			
			if(index != -1)
			{
				bSelected = true ;
				break ;
			}
		}
		
		if(bSelected)
		{
			$(this).addClass('selected') ;
		}else{
			$(this).removeClass('selected') ;
		}
	}) ;
	
	if(MapFilters.vectorMap)
	{
		MapFilters.vectorMap.setSelectedRegions(MapFilters.getSelectedMapRegions()) ;
	}
	
	MapFilters.updateMap() ;
}

MapFilters.slickNext = function()
{
	$('#filters').slick('slickNext');
	
	MapFilters.updateNav() ;
	
	return false ;
}

MapFilters.slickPrev = function()
{
	$('#filters').slick('slickPrev');
	
	MapFilters.updateNav() ;
	
	return false ;
}

MapFilters.getCurrentSlide = function()
{
	return $('#filters').slick('slickCurrentSlide') ;
}

MapFilters.updateNav = function()
{
	var prev = MapFilters.getCurrentSlide() - 1 ;
	if(prev < 0) prev = MapFilters.navs.length - 1 ;
	var next = MapFilters.getCurrentSlide() + 1 ;
	if(next >= MapFilters.navs.length) next = 0 ;
	
	$('#filters .nav-left span').text(MapFilters.navs[prev]) ;
	$('#filters .nav-right span').text(MapFilters.navs[next]) ;
	
	return false ;
}

MapFilters.toggleFilter = function()
{
	$(this).toggleClass('selected') ;
	
	var selected = $(this).hasClass('selected') ;
	var type = $(this).attr('filter-type') ;
	var value = $(this).attr('filter-value') ;
	
	if(value == 'all' || value == 'nothing')
	{
		MapFilters.setValues(type, value) ;
		
		return false ;
	}
	
	var aValues = value.indexOf(',') == -1 ? [value] : value.split(',') ;
	
	if(selected)
	{
		MapFilters.filters_value[type] = MapFilters.filters_value[type].concat(aValues) ;
	}else{
		for(var i = 0 ; i < aValues.length ; i++)
		{
			var index = MapFilters.filters_value[type].indexOf(aValues[i]) ;
			
			if(index != -1) MapFilters.filters_value[type].splice(index, 1) ;
		}
	}
	
	MapFilters.updateFilters() ;
	
	return false ;
}

MapFilters.toggleFilters = function(item)
{
	var type = $(this).attr('filter-type') ;
	var value = $(this).attr('filter-value') ;
	
	if(type == 'all')
	{
		for(var t in MapFilters.filters_value)
		{
			MapFilters.setValues(t, value) ;
		}
	}else{
		MapFilters.setValues(type, value) ;
	}
	
	return false ;
}

MapFilters.setValues = function(type, value)
{
	if(value == 'all')
	{
		var aFilters = [] ;
		
		if(type == 'where')
		{
			aFilters = MapFilters.getAllCodeDepartements() ;
		}else{
			$('#filters-' + type + ' .filter_' + type).each(function()
			{
				var value = $(this).attr('filter-value') ;
				
				if(value.indexOf(',') == -1 && aFilters.indexOf(value) == -1)
				{
					aFilters.push(value) ;
				}
			}) ;
		}
		
		MapFilters.filters_value[type] = aFilters ;
	}
	
	if(value == 'nothing')
	{
		MapFilters.filters_value[type] = [] ;
	}
	
	MapFilters.updateFilters() ;
}

MapFilters.canBeDisplayed = function(i)
{
	var bDisplay = true ;
	
	if(this.filters_value.who.length == 0 && this.filters_value.what.length == 0 && this.filters_value.where.length == 0 && this.filters_value.label.length == 0) return false ;
	
	if(this.filters_value.who.length) bDisplay = bDisplay && this.filters_value.who.indexOf(aMarkersInfos[i].activite) != -1 ;
	if(this.filters_value.what.length) bDisplay = bDisplay && this.filters_value.what.indexOf(aMarkersInfos[i].produits) != -1 ;
	if(this.filters_value.where.length) bDisplay = bDisplay && this.filters_value.where.indexOf(aMarkersInfos[i].departement) != -1 ;
	
	if(this.filters_value.label.length)
	{
		var bLabel = false ;
		for(var j = 0 ; j < aMarkersInfos[i].certifications.length ; j++)
		{
			if(this.filters_value.label.indexOf(aMarkersInfos[i].certifications[j]) != -1)
			{
				bLabel = true ;
			}
		}
		
		bDisplay = bDisplay && bLabel ;
	}
	
	return bDisplay ;
}

MapFilters.hasKeywords = function(i, search)
{
	var marker = aMarkersInfos[i] ;
	
	
	return aMarkersInfos[i].name.toLowerCase().indexOf(search.toLowerCase()) != -1 || aMarkersInfos[i].address.toLowerCase().indexOf(search.toLowerCase()) != -1 ;
}

MapFilters.updateMap = function()
{
	var nb = aMarkersInfos.length ;
	
	for(var i = 0 ; i < nb ; i++)
	{
		var index = aMarkersInfos[i].index ;
		if(this.canBeDisplayed(i))
		{
			if(!aMarkers[index].getMap()) aMarkers[index].setMap(map) ;
		}else{
			if(aMarkers[index].getMap()) aMarkers[index].setMap(null) ;
			
		}
	}
	
	MapFilters.buildList() ;
	
	return false ;
}

MapFilters.showFiltersDetails = function()
{
	$('#filters-details').show() ;
	$('#filters-details').animate({top:0}) ;
	
	return false ;
}

MapFilters.hideFiltersDetails = function()
{
	$('#filters-details').animate({top:'100%'}, MapFilters.hideFiltersDetailsDone) ;
	
	return false ;
}

MapFilters.hideFiltersDetailsDone = function()
{
	$('#filters-details').hide() ;
}

function showFilters()
{
	MapFilters.toogle() ;
	
	return false ;
}

function showAccountMenu()
{
	$('#content').toggle() ;
	$('#menu-compte').toggle() ;
	
	$('.nav5').toggleClass('selected') ;
	
	return false ;
}

function showCart()
{
	$('#content').toggle() ;
	$('#cart').toggle() ;
	
	return false ;
}

function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2)
{
  var R = 6371; // Radius of the earth in km
  var dLat = deg2rad(lat2-lat1);  // deg2rad below
  var dLon = deg2rad(lon2-lon1); 
  var a = 
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
    Math.sin(dLon/2) * Math.sin(dLon/2)
    ; 
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  var d = R * c; // Distance in km
  return d;
}

function deg2rad(deg)
{
	return deg * (Math.PI/180)
}