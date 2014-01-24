<div class="subpage">
    <div class="baner">
        <h1>Dane</h1>

        <p>Oto lista wszystkich zbiorów udostępnianych zbiorów danych. Kliknij nazwę zbioru, aby uzyskać więcej
            informacji o nim.</p>
    </div>
    <div class="page-header">
        <h2>Alias: <?php echo strip_tags($alias); ?></h2>
        <a href="<?php echo $this->Html->url(array('action' => 'dane')); ?>" class="btn btn-primary">&laquo;
            Powrót</a><br/>
    </div>
    <h3>Dostępne pola</h3>
    <table class="table table-striped">
        <tr>
            <th>Nazwa pola</th>
            <th>Tytuł</th>
            <th>Opis</th>
        </tr>
        <?php foreach ($fields as $field) { ?>

            <tr>
                <td>
                    <code><?php echo ($field['Field']['alias'] != $field['Field']['base_alias']) ? $field['Field']['alias'] . '.' . $field['Field']['field'] : $field['Field']['field']; ?></code>
                </td>
                <td><?php echo $field['Field']['tytul']; ?></td>
                <td><?php echo $field['Field']['opis']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <h3>Dostępne warstwy</h3>
    <table class="table table-striped">
        <tr>
            <th>Nazwa warstwy</th>
            <th>Opis</th>
        </tr>
        <?php foreach ($layers as $layer) { ?>
            <tr>
                <td><code><?php echo $layer['Layer']['layer']; ?></code></td>
                <td><?php echo $layer['Layer']['description']; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>