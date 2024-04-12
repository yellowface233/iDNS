<?php
session_start();

unset($_SESSION['user']);
unset($_SESSION['islogin']);

header('location: /index.cmd');