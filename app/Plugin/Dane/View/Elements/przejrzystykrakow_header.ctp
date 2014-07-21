<div class="objectRender col-md-12 <?php echo $object->getDataset(); ?>" oid="<?php echo $item['data']['id'] ?>">
    <div class="row">

        <div class="data col-md-12">
            <div class="row">

                <div class="attachment col-md-3 text-center">
                    <a class="thumb_cont" href="http://przejrzystykrakow.pl">
                        <img class="thumb" onerror="imgFixer(this)" src="/dane/img/customObject/krakow/logo_pkrk.jpg"
                             alt="<?= strip_tags($object->getTitle()) ?>"/>
                    </a>
                </div>
                <div class="content col-md-9">

                    <<?= $titleTag ?> class="title trimTitle<? if ($bigTitle) { ?> big<? } ?>"
                    title="<?= htmlspecialchars($object->getShortTitle()) ?>"
                    data-trimlength="200">
                    <a href="http://przejrzystykrakow.pl" title="<?= strip_tags($object->getTitle()) ?>">
                        Przejrzysty Kraków
                    </a>
                </<?= $titleTag ?>>

                <p class="header">
                    Program Przejrzysty Kraków, prowadzony przez <a
                        href="http://mojepanstwo.pl/dane/krs_podmioty/325617">Fundację Stańczyka</a>, ma na celu
                    wieloaspektowy monitoring życia publicznego w Krakowie. W ramach programu prowadzony jest obecnie
                    monitoring Rady Miasta i Dzielnic Krakowa.
                </p>

            </div>

        </div>
    </div>
</div>
</div>
