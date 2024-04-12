<?php
exec('dnscmd /recorddelete '.$_GET['domain'].' '.$_GET['sub'].' '.$_GET['ttl'].' '.$_GET['type'].' '.$_GET['value'].' /f');
