<div class="subpage">
    <div class="baner">
        <h1>REST API</h1>
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

            <p>REST API jest interfejsem za pomocą którego możesz pobierać dane udostępniane na portalu Sejmometr.
                Ogólna zasada jego działania jest następująca:</p>

            <p>Cokolwiek widzisz przez przeglądarkę na portalu Sejmometr, możesz pobrać w formacie JSON,
                wysyłając żądanie pod ten sam adres URL strony, ale z dodatkowym parametrem nagłówka HTTP:</p>

            <div class="well">Accept: application/vnd.EPF_API.v1+json</div>


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

            <p>Aby przeglądać wszystkie obiekty, zgromadzone we wszystkich dataset'ach, wykonaj żądanie:</p>

            <div class="well">GET http://sejmometr.pl/dane</div>


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
				 </pre>
            </div>


            <p class="separator">Wyniki są stronnicowane po 20 obiektów na stronę. Aby poruszać się po stronach
                wyników, użyj zmiennej GET "page", np:</p>


            <div class="well">GET http://sejmometr.pl/dane?p=2</div>


            <p class="separator">Aby wyszukiwać dane, dla określonego słowa kluczowego, użyj zmiennej GET "q",
                np:</p>

            <div class="well">GET http://sejmometr.pl/dane?q="API"</div>


            <p class="separator">Jeśli chcesz szukać tylko w określonym dataset'cie, musisz użyć adresu URL:<br/>(Listę
                wszystkich dataset'ów i ich numery ID możesz zobaczyć w dziale <a href="/api/dane">Dane</a>)</p>

            <div class="well">GET http://sejmometr.pl/{$id_datasetu}</div>


            <p class="separator">Poniższe żądanie zwróci wskaźniki Banku Danych Lokalnych odnoszące się do rozwodów
                w Polsce:</p>

            <div class="well">GET http://sejmometr.pl/bdl_wskazniki?q="rozwody"</div>


            <p class="separator">Możesz też filtrować wyniki przez wszystkie pola, które udostępniają obiekty w
                konkretnym dataset'cie. Poniższe żądanie zwróci listę wszystkich zamówień publicznych na roboty
                budowlane w Polsce:</p>

            <div class="well">GET http://sejmometr.pl/zamowienia_publiczne?f_rodzaj_id[]=1</div>


            <h2 id="obiekty">Pobieranie podstawowych danych obiektu</h2>

            <p>Wszystkie obiekty, posiadają swój unikalny numer ID (jest on unikalny, w obrębie danego dataset'u).
                Jeśli znasz ID dataset'u, oraz ID obiektu, możesz pobrać jego podstawowe dane pod adresem:</p>

            <div class="well">GET http://sejmometr.pl/{$id_datasetu}/{$id_obiektu}</div>

            <p>Poniższy przykład zwróci podstawowe dane na temat miasta Krakowa:</p>

            <div class="well">GET http://sejmometr.pl/gminy/903</div>


            <h2 id="warstwy">Pobieranie dodatkowych warstw danych obiektu</h2>

            <p>Niektóre obiekty udostępniają dodatkowe warstwy danych (ich wykaz znajdziesz <a
                    href="/api/dane">tu</a>). Są one dostpne pod adresami URL:</p>

            <div class="well">GET http://sejmometr.pl/{$id_datasetu}/{$id_obiektu}/{$nazwa_warstwy}</div>


            <p>Poniższy przykład zwróci współrzędne geograficzne granic obszaru miasta Warszawy:</p>

            <div class="well">GET http://sejmometr.pl/gminy/903/spat</div>


        </div>
    </div>
</div>