<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

ini_set('display_errors', 0);
if(isset($_POST['gIDNumber'])) {
    #
    # Atribut a modificar --> Número d'idenficador d'usuari
    #
    $atribut="gidNumber"; #
    $nou_contingut=$_POST['gIDNumber'];
    #
    # Entrada a modificar
    #
    $uid = "webdev";
    $unorg = "desenvolupadors";
    $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
    #
    #Opcions de la connexió al servidor i base de dades LDAP
    $opcions = [
        'host' => 'zend-gucoga.fjeclot.net',
        'username' => 'cn=admin,dc=fjeclot,dc=net',
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    #
    # Modificant l'entrada
    #
    $ldap = new Ldap($opcions);
    $ldap->bind();
    $entrada = $ldap->getEntry($dn);
    if ($entrada){
        Attribute::setAttribute($entrada,$atribut,$nou_contingut);
        $ldap->update($dn, $entrada);
        echo "Atribut modificat";
    } else echo "<b>Aquesta entrada no existeix</b><br><br>";
}
?>
<html>
<head>
<title>
MODIFICAR GID DE WEBDEV
</title>
</head>
<body>
<h2>Formulari de modificació del gID usuari webdev </h2>
<form action="./modificaGIDwebdev.php" method="POST">
<label>Nou gID Number</label><br>
<input type="number" id="gIDNumber" name="gIDNumber" value="gIDNumber">
<input type="submit"/>
<input type="reset"/>
</form>
<a href="menu.php">Tornar al menú </a>
</body>
</html>