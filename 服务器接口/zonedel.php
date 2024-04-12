<?php
exec('dnscmd /zonedelete '.$_GET['domain'].' /f');