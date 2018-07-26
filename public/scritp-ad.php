<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Listagem de Usuários - AD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>

<?php

/*
* Criado em 20/07/2018.
* João Vitor Veronese Vieira - @joao-vieira
*/



/**
 * Pega a lista de usuários vinda do Active Directory.
 */
echo " <center><h3>-- Estamos iniciando a importação --</h3></center> <br/><br/>";


// Conecta com o banco PostGres, onde os usuários serão armazenados posteriormente
$connStr = 'host=localhost port=5432 dbname=dpworld_qualidade user=postgres password=a2kldOq';
$conn = pg_connect($connStr);


/*
* embraport.net
*/
$ldap_password = "51i1dkzh1Qv8byWIrAq4";
$ldap_username = 'administrador@breja.local';
$ldap_connection = ldap_connect("192.168.10.42");
if (FALSE === $ldap_connection){
    echo "Tivemos algum problema ao conectar! <br/>";
}

$dn = 'OU=Users,OU=Embraport,DC=embraport,DC=net';

$filter = sprintf('(memberof:1.2.840.113556.1.4.1941:=%s)', $dn);
print_r($filter);
exit();

$message = "";
$ad_users = 0;
echo "<center>1. Conectados no server </center><br/>";
// We have to set this option for the version of Active Directory we are using.
ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3) or die('Unable to set LDAP protocol version');
ldap_set_option($ldap_connection, LDAP_OPT_REFERRALS, 0); // We need this for doing an LDAP search.

if (TRUE === ldap_bind($ldap_connection, $ldap_username, $ldap_password)){
    echo "<center>2. Bind funcionou corretamente </center><br/>";
    $ldap_base_dn = 'DC=breja,DC=local';

    $attributes = array();
    $attributes[] = 'givenname';
    $attributes[] = 'mail';
    $attributes[] = 'samaccountname';
    $attributes[] = 'sn';
    $attributes[] = 'name';
    
    // $filter = '(objectCategory=group)';
    $filter = '(&(objectCategory=person)(samaccountname=*))';
?>    

    <table>
        <tr>
            <th>Nome Completo</th>
            <th>Primeiro Nome</th>
            <th>Complemento do Nome</th>
            <th>Nome de Usuário</th>
            <th>E-mail</th>
            <th>DN</th>
        </tr>

<?php
    $pageSize = 100;

    $cookie = '';
    $i=1;
    do {

        ldap_control_paged_result($ldap_connection, $pageSize, true, $cookie);
        $result  = ldap_search($ldap_connection, $ldap_base_dn, $filter, $attributes); // , $attributes
        // echo "<center>3. A procura foi realizada com sucesso </center><br/>";
        $entries = ldap_get_entries($ldap_connection, $result);
        // echo "<center>4. Realizado a busca das entradas e usuários serão listados abaixo: </center><br/>";

        // array_shift($entries);
        foreach ($entries as $e) {
            ?>
                <tr>
                    <td><?php echo $e['name'][0] ?></td>
                    <td><?php echo $e['givenname'][0] ?></td>
                    <td><?php echo $e['sn'][0] ?></td>
                    <td><?php echo $e['samaccountname'][0] ?></td>
                    <td><?php echo $e['mail'][0] ?></td>
                    <td><?php echo $e['dn'] ?></td>
                </tr>    
            <?php
            $i++;
            $ad_users++;
        }

        ldap_control_paged_result_response($ldap_connection, $result, $cookie);

    } while($cookie !== null && $cookie != '');

    ldap_unbind($ldap_connection); // Clean up after ourselves.
}

echo "<br/><br/> Total de Usuários Listados: <b> $ad_users</b> <br/><br/>";

?>



</body>
</html>