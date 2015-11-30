<?php
set_include_path(dirname(__FILE__).'/../src/'.PATH_SEPARATOR.get_include_path());

spl_autoload_extensions('.php');
spl_autoload_register('spl_autoload');
