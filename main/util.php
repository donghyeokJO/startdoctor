<?php
function dbconnect($host, $dbid, $dbpass, $dbname)
{
    $conn = mysqli_connect($host, $dbid, $dbpass, $dbname);
    if ($conn == false) {
        die('Not connected : ' . mysqli_error());
    }
    return $conn;
}
function msg($msg)
{
    echo "
        <script>
             window.alert('$msg');
             history.go(-1);
        </script>";
    exit;
}
function s_msg($msg)
{
    echo "
        <script>
            window.alert('$msg');
        </script>";
}

function Encrypt($str, $secret_key = 'secret key', $secret_iv = 'secret iv')
{
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 32)    ;

    return str_replace(
        '=',
        '',
        base64_encode(
            openssl_encrypt($str, 'AES-256-CBC', $key, 0, $iv)
        )
    );
}

function Decrypt($str, $secret_key = 'secret key', $secret_iv = 'secret iv')
{
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 32);

    return openssl_decrypt(
        base64_decode($str),
        'AES-256-CBC',
        $key,
        0,
        $iv
    );
}

$secret_key = 'medi180615';
$secret_iv = '#@$%^&*()_+=-';
?>  