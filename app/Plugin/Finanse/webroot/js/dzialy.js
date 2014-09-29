function number_format(number, decimals, dec_point, thousands_sep) {
  
  number = (number + '')
    .replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
      .join('0');
  }
  return s.join(dec);
}

function number_format_h(n)
{
	
	/*
	

	
    // first strip any formatting;
    $n = (0 + str_replace(",", "", $n));

    // is this a number?
    if (!is_numeric($n)) return false;

    $_n = abs($n);

    // now filter it;
    if ($_n > 1000000000000000) return round(($n / 1000000000000000), 1) . '&nbsp;Bld';
    else if ($_n > 1000000000000) return round(($n / 1000000000000), 1) . '&nbsp;B';
    else if ($_n > 1000000000) return round(($n / 1000000000), 1) . '&nbsp;Mld';
    else if ($_n > 1000000) return round(($n / 1000000), 1) . '&nbsp;M';
    else if ($_n > 1000) return round(($n / 1000), 1) . '&nbsp;k';
    */

    return number_format(n, 0, '.', ' ');
}



jQuery(document).ready(function () {
    
    /*
    jQuery('#localizeMe').click(function () {
        localizer.request_position()
    });
    */

    var autocomplete = jQuery("#teryt_search_input"),
        cache = {};

    autocomplete.autocomplete({
        minLength: 2,
        source: function (request, response) {
            console.log(request.term);
            var term = request.term;
            if (term in cache) {
                response(cache[ term ]);
                return;
            }
            jQuery.getJSON("/moja_gmina/search.json?q=" + request.term, function (data, status, xhr) {
                var results = jQuery.map(data, function (item) {
                    return {
                        name: item.nazwa,
                        label: item.nazwa + " (" + item.typ + ")",
                        value: item.id
                    }
                });
                if (results.length == 0)
                    results = [
                        {label: _mPHeart.translation.LC_MOJA_GMINA_SEARCH_BRAK_WYNIKOW, value: null}
                    ]
                cache[ term ] = results;
                response(results);
            });
        },
        focus: function (event, ui) {
            if (ui.item.value !== null)
                autocomplete.val(ui.item.name);
            return false;
        },
        select: function (event, ui) {
            if (ui.item.value !== null) {
                autocomplete.val(ui.item.name);
                
                jQuery.getJSON("/finanse/finanse/getBudgetData.json?gmina_id=" + ui.item.value, function (data, status, xhr) {
                	
                	$('#sections ._teryt').remove();
                	
                	var sections = data['sections'];
                	
                	for( var i=0; i<sections.length; i++ ) {

	                	var section = sections[i];


						if( !section['teryt_sum_section_percent'] )
							continue;
						
						
						var v = String( section['teryt_section_percent'] ) + '%';
						console.log( v );


	                	
	                	var section_li = jQuery('#sections .section[data-id=' + section['id'] + ']');
	                	var gradient_cont_div = section_li.find('.gradient_cont');
	                	var gradient_addons = gradient_cont_div.find('.addons');
	                	
	                	gradient_addons.find('._teryt').fadeOut(function(){
		                	$(this).remove();
	                	});
	                	
	                	/*
	                	gradient_addons.html('');
	                	
	                	var li_min = jQuery('<li/>', {
						    html: '<p><a href="/dane/gminy/' + '1' + '">Radom</a></p>',
						}).appendTo(gradient_addons);
	                	
	                	var li_teryt = jQuery('<li/>', {
						    html: '<p><a href="/dane/gminy/' + '1' + '">Kraków</a></p>',
						    class: '_teryt'
						}).appendTo(gradient_addons);
	                	
	                	var li_max = jQuery('<li/>', {
						    html: '<p><a href="/dane/gminy/' + '1' + '">Wałbrzych</a></p>'
						}).appendTo(gradient_addons);

						
						li_min.animate({left: '0%'});
						li_teryt.animate({left: '50%'});
						li_max.animate({left: '100%'});
						
						*/
						
						gradient_addons.find('.min .n').text( section['teryt_min_nazwa'] );
						gradient_addons.find('.min .v').text( number_format_h( section['teryt_min'] ) );

						gradient_addons.find('.max .n').text( section['teryt_max_nazwa'] );
						gradient_addons.find('.max .v').text( number_format_h( section['teryt_max'] ) );
						
						var li_teryt = jQuery('<li/>', {
						    html: '<p><a href="/dane/gminy/' + '1' + '">' + data['stats']['teryt_nazwa'] + '</a><br/>' + number_format_h( section['teryt_sum_section'] ) + '</p>',
						    class: '_teryt'
						}).appendTo(gradient_addons);
						
						
						
							
						li_teryt.css('opacity', 0).animate({left: v, opacity: 1});

	                	
                	}
                	
                });
                
            }
            return false;
        }
    });

});