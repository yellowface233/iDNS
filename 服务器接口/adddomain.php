<?php
exec('dnscmd /recordadd '.$_GET['domain'].' '.$_GET['sub'].' '.$_GET['ttl'].' '.$_GET['type'].' '.$_GET['value']);
