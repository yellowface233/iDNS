<?php
exec('dnscmd /zoneadd '.$_GET['domain'].' /primary /file '.$_GET['domain']);