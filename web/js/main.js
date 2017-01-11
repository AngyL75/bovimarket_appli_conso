$(document).ready(function() {
	$('#holder').toggleClass("visible");

	$('a.link').click(function(event) {
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
	});

	/*$('h1').click(function(event) {
		$('#holder').toggleClass("visible");
	});*/

});

var MapFilters = 
	{
		initFiltersSlideDone:false,
		navs:['Label ?', 'Quoi ?', 'Qui ?'],
	};
MapFilters.init = function()
{
	if(this.initFiltersSlideDone) return false ;
	
	$('#filters').slick({slide:'.slide', arrows: false, initialSlide:1}) ;
	$('#filters').slick('slickGoTo', 1);
	
	$('#filters .nav-left').click(MapFilters.slickPrev);
	$('#filters .nav-right').click(MapFilters.slickNext);
	$('#filters .list a').click(MapFilters.toggleFilter);
	$('#filters .bar a').click(MapFilters.toggleFilters);
	
	this.initFiltersSlideDone = true ;
	
	return true ;
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
	
	if(value == 'group')
	{
		if(selected)
		{
			$('a', $(this).next('ul')).addClass('selected') ;
		}else{
			$('a', $(this).next('ul')).removeClass('selected') ;
		}
	}
	
	MapFilters.updateMap() ;
	
	return false ;
}

MapFilters.toggleFilters = function()
{
	var type = $(this).attr('filter-type') ;
	var value = $(this).attr('filter-value') ;
	
	if(value == 'all')
	{
		$('.filter_' + type).addClass('selected') ;
	}
	
	if(value == 'nothing')
	{
		$('.filter_' + type).removeClass('selected') ;
	}
	
	MapFilters.updateMap() ;
}

MapFilters.updateMap = function()
{
	
	
	return false ;
}


function showFilters()
{
	MapFilters.init() ;
	
	$('#filters').show() ;
	
	return false ;
}