<div class="subpage">
    <div class="baner">
        <h1>Dane</h1>

        <p>Oto lista wszystkich zbiorów udostępnianych zbiorów danych. Kliknij nazwę zbioru, aby uzyskać więcej
            informacji o nim.</p>
    </div>
    <div class="row-fluid">
        <table class="table table-striped">
            <tr>
                <th>Nazwa datasetu</th>
                <th>base_alias</th>
                <th>Opis</th>
                <th>Ilość rekordów</th>
            </tr>
            <?php foreach ($datasets as $dataset) { ?>

                <tr>
                    <td>
                        <a href="<?php echo $this->Html->url(array('action' => 'dane', $dataset['Dataset']['alias'])); ?>"><?php echo $dataset['Dataset']['name']; ?></a>
                    </td>
                    <td><code><?php echo $dataset['Dataset']['alias']; ?></code></td>
                    <td><?php echo $dataset['Dataset']['opis']; ?></td>
                    <td><?php echo $dataset['Dataset']['count']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>