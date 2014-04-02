$(document).ready(function(){
	var url = 'http://bzp1.portal.uzp.gov.pl/index.php?ogloszenie=show&pozycja=' + zamowienie['ogloszenie_nr'] + '&rok=' + zamowienie['data'];
	
	$('#source').html('<a target="_blank" href="' + url + '">Źródło</a>');
});
