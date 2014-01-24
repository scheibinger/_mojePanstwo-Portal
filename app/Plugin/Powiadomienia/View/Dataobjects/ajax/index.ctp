<?php
$out = array();
foreach ($objects['dataobjects'] as $object) {
    $this->Dataobject->setObject($this, $object);
    array_push($out, $this->Dataobject->render());
}

echo json_encode($out);
?>