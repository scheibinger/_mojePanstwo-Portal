<ul class="pagination pagination-sm">
    <?
    echo $this->Paginator->numbers(array(
        'tag' => 'li',
        'currentTag' => 'a',
        'currentClass' => 'active',
        'separator' => false,
        'escape' => false,
    ));
    ?>
</ul>