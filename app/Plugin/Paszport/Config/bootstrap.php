<?php

$config = array(
    'salt' => PASSPORT_salt,
    'checksum' => PASSPORT_client,
);

Configure::write('Passport', $config);