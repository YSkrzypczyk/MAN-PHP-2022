<?php

//Controller/Security.class.php
namespace App\Controller;
class Security
{

}
---------------------------------------------

//Utils/Security.class.php
namespace App\Utils;
class Security
{

}

---------------------------------------------

use App\Utils\Security;
use App\Controller\Security as Secu;

new Security();
new Secu();
---------------------------------------------
