$( document ).ready(function() {
    
    var PrawoApp = Class.create({
		
		tagsDiv: $('#tagsDiv'),
		tagsDivUl: $('#tagsDiv ul'),
			
		init: function() {
			
			console.log('init');
			
			this.resizeTagsUl();			
			this.initTags();
			this.layoutTags();
			this.showTags();
						
		},
		
		onTagClick: function(event) {
			
			var a = $( event.target );
			var li = a.parent();
			
			if( li.hasClass('_active') ) {
				
				var top = this.getTagTop( li );
				
				li.removeClass('_active').animate({
					top: top + 'px',
				}, 1000, 'easeInOutQuart');
				
				this.showTags();
				this.search();
			
			} else {
				
				
				
				li.addClass('_active').animate({
					top: 0
				}, 1000, 'easeInOutQuart');
							
				this.tagsDivUl.animate({
					scrollTop: 0
				}, 1000, 'easeInOutQuart');
				
				this.hideTags();
				this.search();
				
			}
		
		},
		
		resizeTagsUl: function(offset = 120) {
			
			this.tagsDivUl.height( $(window).height() - offset + 'px' );
			
		},
		
		hideTags: function() {
						
			var as = this.tagsDivUl.find('a');
			
			for( var i=0; i<as.length; i++ ) {
				
				var a = $( as[i] );
				var li = a.parent();
				
				if( !li.hasClass('_active') ) {
					
					li.css('transition-delay', i / 10 + 's');
					li.addClass('_hidden');
					
				}
				
			}
			
		},
		
		initTags: function() {
			
			this.tagsDivUl.find('a').click( $.proxy(this.onTagClick, this) );
			
		},
		
		showTags: function() {
						
			var as = this.tagsDivUl.find('li._hidden a');
			
			for( var i=0; i<as.length; i++ ) {
				
				var a = $( as[i] );
				var li = a.parent();
				
				if( !li.hasClass('_active') ) {
					
					li.css('transition-delay', i / 10 + 's');
					li.removeClass('_hidden');
					
				}
				
			}
			
		},
		
		layoutTags: function() {
			
			var lis = this.tagsDivUl.find('li');
			for( var i=0; i<lis.length; i++ ) {
				
				var li = $( lis[i] );
				
				li.addClass('_absolute').css({
					top: i*35 + 'px',
				}).attr('data-i', i);
				
			}
			
		},
		
		
		search: function() {
			
			var data = {
				tags: [1, 2, 3]
			};
			
			$.ajax('/prawo/search.json', {
				dataType: 'json',
				data: data
			}).done( $.proxy(this.searchCallback, this) );
			
		},
		
		searchCallback: function(data) {
			
			console.log('searchCallback', data);
			
		},
		
		getTagTop: function(li) {
			
			var i = Number( li.data('i') );
			return i * 35;
			
		}
		
	});
	
	app = new PrawoApp();
	
});

var app;