<?php
$this->Combinator->add_libs('css', $this->Less->css('new-look'));
$this->Combinator->add_libs('css', $this->Less->css('administracja', array('plugin' => 'Administracja')));
$this->Combinator->add_libs('js', 'Administracja.administracja.js');
?>
<div id="administracja">
    <div class="appHeader">
        <div class="container innerContent">
            <h1>Władze centralne</h1>
            <p class="desc">Kilknij kartę instytucji poniżej, aby dowiedzieć się więcej.</p>
        </div>
    </div>

    <div class="container">
        <? if ($items = $data['files']) ;
        {
            ?>
            <div class="content">
                <div class="row items">
                    <? foreach ($items as $item) { ?>
                        <div class="block col-md-<?= $item['width'] ?>">
                            <div class="item" data-id="<?= $item['id'] ?>">
                                
                                <a href="/dane/administracja_publiczna/<?= $item['id'] ?>" class="inner"
                                   data-title="<?= $item['nazwa'] ?>"
                                   data-info='{
                                        "adres": ["Skwer kard. Wyszyńskiego 9 01-015 Warszawa"],
                                        "www": ["http://www.pg.gov.pl/bip/"],
                                        "email":["BPG@pg.gov.pl"],
                                        "telefon": ["22 125-14-91"],
                                        "fax": ["22 125-18-82"],
                                        "instytucje": ["Prokuratura Apelacyjna w Krakowie", "Prokuratura Okręgowa w Kielcach","Prokuratura Okręgowa w Krakowie","Prokuratura Okręgowa w Tarnowie","Prokuratura Okręgowa w Nowym Sączu"]
                                    }'>
										
									<div class="logo">
										<img src="/Administracja/img/instytucje/<?= $item['id'] ?>.png" title="<?= $item['nazwa'] ?>"/>
									</div>
                                                                        
									<div class="details">
										<? if( $item['budzet_plan'] ) {?><span class="detail">Budżet: <?= number_format_h($item['budzet_plan']*1000) ?></span><?}?>
										<? if( $item['budzet_plan'] && $item['childsCount'] ) {?><span class="separator">|</span><?}?>
										<? if( $item['childsCount'] ) {?><span class="detail">Instytucje podległe: <?= $item['childsCount'] ?></span><?}?>
									</div>

                                    
									<div class="title">
                                        <div class="nazwa"><?= $item['nazwa'] ?></div>
									</div>
									
									<div class="text">
										<?= $item['opis_html'] ?>
									</div>
									
                                </a>
                            
                            </div>
                        </div>
                    <? } ?>
                </div>
            </div>
        <? } ?>
    </div>
</div>