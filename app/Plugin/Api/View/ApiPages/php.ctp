<div class="subpage">

    <div class="baner">
        <h1>PHP API</h1>
    </div>


    <div class="wrap columns">

        <div class="wrap_column side">

            <h2>Spis treści</h2>

            <ul class="toc">
                <li><a href="#podstawy">Podstawy</a></li>
                <!--<li><a href="#autoryzacja">Autoryzacja</a></li>-->
                <li><a href="#przeszukiwanie">Wyszukiwanie obiektów</a></li>
                <li><a href="#obiekty">Pobieranie podstawowych danych obiektu</a></li>
                <li><a href="#warstwy">Pobieranie dodatkowych warstw danych obiektu</a></li>
                <!-- 							<li><a href="#datasety_zagniezdzone">Przeszukiwanie dataset'ów zagnieżdżonych</a></li> -->
            </ul>

        </div>

        <div class="wrap_column main">


            <!-- PODSTAWY -->

            <h2 id="podstawy">Podstawy</h2>

            <p>PHP API jest biblioteką za pomocą którek możesz pobierać dane udostępniane na portalu Sejmometr.
                Ogólna zasada jego działania jest następująca:</p>

            <p>Ładujemy plik <code>ep_Api.php</code> wybieramy dataset, ustawiamy filtry i wywołujemy metodę <code>ep_Dataset::search()</code>
            </p>

            <!-- 	        <div class="well">Accept: application/vnd.EPF_API.v1+json</div> -->


            <!-- AUTORYZACJA -->

            <!--
            <h2 name="autoryzacja">Autoryzacja</h2>

            <p>Dodatkowo żądania REST API muszą być autoryzowane za pomocą kluczy, które możesz wygenerować, po wyrobieniu <a target="_blank" href="http://paszport.epf.org.pl">Paszportu ePaństwa</a>, na stronie <a href="#">Klucze API</a>.</p>

   <p>Po utworzenie swoich kluczy, po prostu dostaw je do każdego żądania:</p>

   <div class="well">Przykład dostawiania kluczy</div>

   -->


            <!-- Wyszukiwanie obiektów -->

            <h2 id="przeszukiwanie">Wyszukiwanie obiektów</h2>

            <p>Sejmometr to baza danych publicznych, które są podzielone w tzw "dataset'y". Każdy dataset składa się
                z obiektów. Obiekty należące do jednego dataset'u udostępniają zestaw pól i wartości. Listę
                wszystkich dataset'ów i pól, które udostępniają możesz zobaczyć w dziale <a
                    href="/api/dane">Dane</a>.</p>

            <p>Aby przeglądać wszystkie obiekty, zgromadzone we wszystkich dataset'ach, zainicjuj klasę:</p>

            <div class="well">
		    <pre>
$o = new ep_Search();
$o->search();
foreach($o->getObjects() as $object) {
	var_dump((array)$object->data);
}
		    </pre>
            </div>


            <!--
                             <p>W odpowiedzi, dostaniesz strukturę podobną do tej:</p>

                             <div class="well"><pre>
            {
                "document": {
                    "type": "search-results",
                    "content": {
                      "objects": [], # ta tabela będzie wypełniona obiektami, zawierającymi dane
                    "pagination": {"total":0,"limit":20,"page":1}
                }
              }
            }
                             </pre></div>
            -->


            <p class="separator">Wyniki są stronnicowane po 20 obiektów na stronę. Aby poruszać się po stronach
                wyników, użyj funkcji <code>ep_Search::setPage(int);</code>, np:</p>


            <div class="well">
					<pre>
$o = new ep_Search();
$o->setPage(2)->search();
					</pre>
            </div>


            <p class="separator">Aby wyszukiwać dane, dla określonego słowa kluczowego, użyj metody <code>ep_Search::setQ(string)</code>
                np:</p>

            <div class="well">
				<pre>
$o = new ep_Search();
$o->setQ('API')->search();
				</pre>
            </div>


            <p class="separator">Jeśli chcesz szukać tylko w określonym dataset'cie, musisz ustawić alias :<br/>(Listę
                wszystkich dataset'ów i ich numery aliasy możesz zobaczyć w dziale <a href="/api/dane">Dane</a>) lub
                stworzyć obiekt odpowiedniej klasy ( obiekty są umieszczone strukturze biblioteki w folderze objects
                )</p>

            <div class="well">
					<pre>
$o = new ep_Search();
$o->setDataset('dane')->search();
# lub
$o = new ep_Dane();
$o->search();
					</pre>
            </div>

            <p class="separator">Poniższy snippet zwróci wskaźniki Banku Danych Lokalnych odnoszące się do rozwodów
                w Polsce:</p>

            <div class="well">
<pre>
$o = new ep_BdlWskaznikiPodgrupy();
$o->setQ('rozwody')->search();
</pre>
            </div>

            <p class="separator">Możesz też filtrować wyniki przez wszystkie pola, które udostępniają obiekty w
                konkretnym dataset'cie. Poniższy snippet zwróci listę wszystkich zamówień publicznych na roboty
                budowlane w Polsce:</p>

            <div class="well">
				<pre>
$o = new ep_ZamowieniaPubliczne();
$o->setFilter('rodzaj_id', 1)->search();
				</pre>
            </div>

            <h2 id="obiekty">Pobieranie podstawowych danych obiektu</h2>

            <p>Wszystkie obiekty, posiadają swój unikalny numer ID (jest on unikalny, w obrębie danego dataset'u).
                Jeśli znasz ID dataset'u, oraz ID obiektu, możesz pobrać jego podstawowe dane ustawiając alias w
                instancji epObject lub wywołując instancję klasy datasetu w liczbie pojedynczej:</p>


            <p>Poniższy przykład zwróci podstawowe dane na temat miasta Krakowa:</p>

            <div class="well">
				<pre>
$o = new ep_Object();
$o->setDataset('gminy');
$o->loadObjectById(903);
var_dump((array)$o->data);
# lub
$o = new ep_Gmina(903);
var_dump((array)$o->data);
				</pre>
            </div>

            <h2 id="warstwy">Pobieranie dodatkowych warstw danych obiektu</h2>

            <p>Niektóre obiekty udostępniają dodatkowe warstwy danych (ich wykaz znajdziesz <a
                    href="/api/dane">tu</a>). Są one dostpne przez metodę <code>ep_Object::loadLayer(string)</code>
            </p>

            <p>Poniższy przykład zwróci współrzędne geograficzne granic obszaru miasta Krakowa:</p>

            <div class="well">
<pre>
$o = new ep_Object();
$o->setDataset('gminy');
$o->loadObjectById(903);
$o->loadLayer('spat');
var_dump($o->layers->spat);
# lub
$o = new ep_Gmina(903);
$o->loadLayer('spat');
var_dump($o->layers->spat);
</pre>
            </div>
        </div>
    </div>
</div>

<? include '../inc/bottom.php'; ?>
