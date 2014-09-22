<div class="api-page bdl">
Bank danych lokalnych jest skomplikowaną strukturą danych, jednak dostęp do niej można podzielić na cztery proste kroki:
<dl>
    <dt>Wybór wskaźnika [metric_id]</dt>
    <dd>Skorzystaj z wyszukiwarki <em>/search</em>, aby znaleźć interesujący cię wskaźnik. Wskaźniki pogrupowane są w grupy oraz kategorie.</dd>
    <dt>Wybór szczegółowości danych wg. rejonu [wojewodztwo_id,powiat_id,gmina_id]</dt>
    <dd>Podaj <em>id</em> konkretnego regionu lub <em>*</em>, aby otrzymać dane ze wszystkich regionów na danym poziomie. Pomiń parametry, aby zwrócić dane na poziomie kraju.</dd>
    <dt>Wybór przekroju [slice]</dt>
    <dd>Każdy wskaźnik składa się z n-wymiarowego hipersześcianu opisanego przez warstwę <em>dimensions</em> (<a href="http://api-server.dev/dane/bdl_wskazniki/39645?layers=dimennsions">przykład</a>).
        Konkretny przekrój to zbiór n-identyfikatorów z każdego wymiaru</dd>
    <dt>Wybór okresu czasu [time_range]</dt>
    <dd>Na razie udostępniamy wyłącznie dane roczne</dd>
</dl>

Użyj powyższych parametrów na endpoint <em>/series</em>, aby zwrócić dane.
</div>