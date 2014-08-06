<p>
    Aplikacja Pisma - Strona główna
</p>

<p><a href="<?= Router::url(array('action' => 'create', '[method]' => 'GET')); ?>">Stwórz nowe pismo</a></p>

<? if(isset($pisma)) { ?>

<?      if(empty($pisma)) { ?>

        <p>Brak pism</p>

<?      } else { ?>

        <p>Twoje pisma:</p>
        <ul>
            <? foreach($pisma as $pismo) { ?>
            <li><a href="<?= Router::url(array('action' => 'edit', 'id' => $pismo['id'] )) ?>"><?= $pismo['to_dataset'] . ': ' . $pismo['subject'] ?></a>
                <span style="margin-left: 30px; font-size: 70%">(<a href="<?= Router::url(array('action' => 'delete', 'id' => $pismo['id'])) ?>">skasuj</a>)</span></li>
            <? } ?>
        </ul>

<?      } ?>

<? } else { ?>

<p>Zaloguj się, aby obejrzeć swoje pisma</p>

<? } ?>
