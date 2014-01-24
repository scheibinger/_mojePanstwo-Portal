<?php echo $scripts_for_layout; ?>
<script type="text/javascript"><?php echo $this->fetch('content'); ?></script>
echo base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5('asdf'), 'test', MCRYPT_MODE_CBC, md5(md5('asdf'))));