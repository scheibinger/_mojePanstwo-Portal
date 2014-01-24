<div class="row">
    <div class="page-header">
        <h2><a id="wstep">0. Słowem wstępu</a></h2>
    </div>
    <p class="lead">
        Poniżej zaprezentujemy 6 przykładów wykorzystania naszego REST API
    </p>

    <p>
        Nasze przykłady mają cele wyłącznie demonstracyjne, chociaż może kogoś zainspirują do stworzenia pełnego
        projektu.
    </p>

    <p>
        Sposób realizacji przykładu będzie pokazany na dwa sposoby, jako zapytanie restowe oraz jako snippet kodu PHP
        przy użyciu biblioteki
    </p>
</div>
<div class="row">
    <div class="page-header">
        <h2><a id="ogolne">1. Ogólne przeszukiwanie danych z podziałem na dataset i bez</a></h2>
    </div>
    <p>
        Przykład bez wyboru datasetu, czyli szukamy po wszystkich zasobach sejmometru
    </p>

    <div class="span12">
        <div class="span6">
            <strong>REST:</strong><br/>
    <pre>
Accept: application/vnd.EPF_API.v1+json
http://sejmometr.pl/dane?q=Warszawa
	</pre>
        </div>
        <div class="span6">
            <strong>PHP:</strong><br/>
    <pre>
$o = new ep_Search();
$o->setQuery('Warszawa')->search();
foreach($o->getObjects() as $object) {
	var_dump((array)$object->data);
}
	</pre>
        </div>
    </div>
    <p>
        Przykład z wyborem datasetu
    </p>

    <div class="span12">
        <div class="span6">
            <strong>REST:</strong><br/>
    <pre>
Accept: application/vnd.EPF_API.v1+json
http://sejmometr.pl/gminy?q=Warszawa
	</pre>
        </div>
        <div class="span6">
            <strong>PHP:</strong><br/>
    <pre>
$o = new ep_Gminy();
$o->setQuery('Warszawa')->search();
    </pre>
        </div>
    </div>
</div>
<div class="row">
    <div class="page-header">
        <h2><a id="gmina">2. Pobieranie danych przestrzennych gminy</a></h2>
    </div>
    <p>
        W tym przykładzie zakładamy, że znamy już id jakiejś gminy, której dane przestrzenne chcemy poznać.
        Wykorzystamy
        tak jak poprzednio Warszawę, która ma ID <code>2226</code>
    </p>

    <div class="span12">
        <div class="span6">
            <strong>REST:</strong><br/>
    <pre>
Accept: application/vnd.EPF_API.v1+json
http://sejmometr.pl/gminy/2226/spat
</pre>
        </div>
        <div class="span6">
            <strong>PHP:</strong><br/>
    <pre>
# ladujemy gmine
$o = new ep_Gmina(2226);
# zrzut danych ogolnych
var_dump($o->data);
# doladowanie warstwy
$o->loadLayer('spat');
# zrzut wartosci warstwy
var_dump($o->layers->spat);</pre>
        </div>
    </div>
</div>
<div class="row">
    <div class="page-header">
        <h2><a id="wyszukiwanie_prl">3. Wyszukiwanie radnych, którzy współpracowali ze służbami PRL</a></h2>
    </div>
    <p>
        Chcemy znaleźć wszystkich radnych, którzy w swoich oświadczeniach zeznali, że współpracowali ze służbami PRL
        (
        <code>oswiadczenie_id</code> = 3)
    </p>

    <div class="span12">
        <div class="span6">
            <strong>REST:</strong><br/>
    <pre>
Accept: application/vnd.EPF_API.v1+json
http://sejmometr.pl/radni_gmin?f_oswiadczenie_id=3
</pre>
        </div>
        <div class="span6">
            <strong>PHP:</strong><br/>
            <pre>
$o = new ep_RadniGmin();
$o->setFilter('oswiadczenie_id', 3)->search();
            </pre>
        </div>

    </div>
</div>
<div class="row">
    <div class="page-header">
        <h2><a id="rozwody">4. Pobieranie danych o liczbie i przyczynach rozwodów w Polsce</a></h2>
    </div>
    <p>
        W tym przykładzie chcemy znaleźć liczbę rozwodów w Polsce
    </p>

    <div class="span12">
        <div class="span6">
            <strong>REST:</strong><br/>
    <pre>
Accept: application/vnd.EPF_API.v1+json
http://sejmometr.pl/bdl_wskazniki/290/dane
</pre>
        </div>
        <div class="span6">
            <strong>PHP:</strong><br/>
    <pre>
$object = new ep_BdlWskaznikPodgrupy(290);
# ładujemy warstawe dane
$object->loadLayer('dane');
var_dump((array)$object->layers->dane);
		</pre>
        </div>
    </div>
</div>
<div class="row">

    <div class="page-header">
        <h2><a id="twitter">5. Pobieranie usuniętych tweet'ów posłów.</a></h2>
    </div>
    <p>
        Znajdźmy wszystkie tweety, którzy nasi drodzy posłowie usunęli ze swojego twittera.
    </p>

    <div class="span12">
        <div class="span6">
            <strong>REST:</strong><br/>
    <pre>
Accept: application/vnd.EPF_API.v1+json
http://sejmometr.pl/twitter/?f_usuniety=1
</pre>
        </div>
        <div class="span6">
            <strong>PHP:</strong><br/>
    <pre>
$o = new ep_Twitty();
$o->setFilter('usuniety', 1)->search();
		</pre>
        </div>
    </div>
</div>
<div class="row">
    <div class="page-header">
        <h2><a id="zamowienia_publiczne">6. Pobieranie zamówień publicznych danej gminy.</a></h2>
    </div>
    <p>
        Znajdźmy zamówienia publiczne z Warszawy - ponownie gmina_id = <code>2226</code>.
    </p>

    <div class="span12">
        <div class="span6">
            <strong>REST:</strong><br/>
    <pre>
Accept: application/vnd.EPF_API.v1+json
http://sejmometr.pl/zamowienia_publiczne/?f_gmina_id=2226
</pre>
        </div>
        <div class="span6">
            <strong>PHP:</strong><br/>
    <pre>
$o = new ep_ZamowieniaPubliczne();
$o->setFilter('gmina_id', 2226)->search();
		</pre>
        </div>
    </div>
</div>
