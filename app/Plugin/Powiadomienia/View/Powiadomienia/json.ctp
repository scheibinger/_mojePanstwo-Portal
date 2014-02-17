<?php foreach ($objects as $object) {
    echo $this->Dataobject->render($object, 'default', array(
        'forceLabel' => true,
    ));
} ?>