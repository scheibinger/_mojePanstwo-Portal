<?php

App::uses('DataobjectsController', 'Dane.Controller');

class ZamowieniaPubliczneController extends DataobjectsController
{
    public $menu = array();
    public $objectOptions = array(
        'hlFields' => array('status_id', 'tryb_id', 'rodzaj_id'),
    );

    public $initLayers = array('details', 'sources', 'czesci');

    public function view()
    {

        parent::view();
        $_details = $this->object->getLayer('details');
        $details = array();
        $text_details = array();


        if (!empty($_details)) {

            // 'siwz_www', 'siwz_adres', 'oferty_miejsce'

            $text_details_keys = array('uprawnienie', 'wiedza', 'potencjal', 'osoby_zdolne', 'sytuacja_ekonomiczna', 'zal_pprawna', 'zal_uzasadnienie', 'zamowienie_uzupelniajace', 'wadium', 'wybor_wykonawcow', 'zmieniona_umowa', 'aukcja_www', 'dk_potrzeby', 'dk_nagrody', 'umowa_zabezpieczenia', 'umowa_istotne_postanowienia', 'info', 'inne_dokumenty', 'inne_dok_potw', 'zal_pprawna_hid', 'zamowienie_pprawna', 'zamowienie_pprawna_hid', 'zamowienie_uzasadnienie', 'le_wymagania', 'le_postapien');


            foreach ($_details as $key => $value) {

                if (!$value)
                    continue;

                if (in_array($key, $text_details_keys))
                    $text_details[$key] = $value;
                else
                    $details[$key] = $value;

            }


            if (
                isset($details['siwz_www']) &&
                ($details['siwz_www'] = str_ireplace('nie dotyczy', '', $details['siwz_www'])) &&
                (stripos($details['siwz_www'], 'http') !== 0)
            )
                $details['siwz_www'] = 'http://' . $details['siwz_www'];

        }

        $this->set('details', $details);
        $this->set('text_details', $text_details);

    }
} 