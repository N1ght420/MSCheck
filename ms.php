<?php

error_reporting(0);
$blue="\033[1;34";
$cyan="\033[1;36m";
$green="\033[1;34m";
$okegreen="\033[92m";
$lightgreen="\033[1;32m";
$white="\033[1;37m";
$purple="\033[1;35m";
$red="\033[1;31m";
$yellow="\033[1;33m";

$token = Array('VElnZExQUDV4ZnVLWmJnN3NpVzJoSGVjREZqYWdZallEZHNKN1dJMVIwVT0',
                'UnRVa01DNCtOV0M4d1pORjJ4U3h5Ny9FMUlXQjBpV0JldmhIdnY1c0FlMD0',
                'L3B2NkhuZUlTVnVoc2VTdVMyYXRIeDJpRzA4Sk9NVTdPU0hjMGYrR2Z6QT0',
                'UnJ0ZHRhWUxRaGRsR2FoRzlsdGh4R0dYV21OSXo1dzJPdldUMlFYVjVMQT0',
                'MWQ5b0VJVHhLTHR4bUI2emx6cEVrcUJkZ0ZHZmxxcW9vUVIzZXJPd0hpaz0',
                'd0JZNGVkOGNRRnlrUEVFUlNyUGhEcnRCRGlBdGFURWdmSkhVS3MvSXJJMD0',
                'd1RaMHB0cHhrbnZGMW0yTmQyWGFlRFFuYWdUTXRKNmlLdGFsSUZPSWtZUT0',
                'TzVGazI3T3NkcXloS1NVUWJVRXRZTnpMNDFoeUMyV28zY1BiNXU5OGpQYz0',
                'eTVKM0tXS2pYNk1QNU05WC9rUzRsWWtlcWU0ekFJZXdaOUZGLy8xc3hyQT0');
$token = $token[array_rand($token)];

@system(clear);
print "   __  __ ____   ____ _               _     \n";
print "  |  \/  / ___| / ___| |__   ___  ___| | __ \n";
print "  | |\/| \___ \| |   | '_ \ / _ \/ __| |/ / \n";
print "  | |  | |___) | |___| | | |  __/ (__|   <  \n";
print "  |_|  |_|____/ \____|_| |_|\___|\___|_|\_\ \n";
print "                                            \n\n";

if ($argv[1] == "-l"){
    if ($argv[2] == ""){
        print "$okegreen [?]$white List : ";
        $list = trim(fgets(STDIN));
    } else {
        $list = $argv[2];
    }
    $buka = fopen("$list","r");
    $ukuran = filesize("$list");
    $baca = fread($buka,$ukuran);
    $lists = explode("\n",$baca);
    foreach ($lists as $key){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,"https://kichhoat24h.com/public-api/check-key?key=$key&token=$token");
        $result=curl_exec($ch);
        curl_close($ch);
        if ($result == "Invalid syntax or token!" OR $result == ""){
            print "$red [*]$white $key$red [INVALID]\n";
        } else {
            $result = explode(': ',$result);
            $result = str_replace('Key','',$result);
            $result = str_replace('Description','',$result);
            $result = str_replace('Sub Type','',$result);
            $result = str_replace('Error Code','',$result);
            $result = str_replace('Time','',$result);
            $result = str_replace(PHP_EOL,'',$result);
            $winoff = explode(' ',$result[2]);
            $type = $result[2];
            if ($result[4] == "0xC004C060"){
                $status = "Die";
                $info = $red;
            } elseif ($result[4] == "0xC004C008"){
                if ($winoff[0] == "Windows" OR $winoff[0] == "Win"){
                    $status = "Die";
                    $info = $red;
                } else {
                    $status = "Activated by Phone";
                    $info = $yellow;
                }
            } elseif ($result[4] == "Online "){
                $status = "Retail";
                $info = $okegreen;
            } else {
                $status = $result[4];
                $info = $cyan;
            }
            $handle = fopen("valid.txt", "a+");
            fwrite($handle, "$key -> $type | $status\n");
            print "$info [*]$white $key$okegreen [$type]$white -> $status\n";
        }
    }
} else {
    print "$okegreen [?]$white License Key : ";
    $key = trim(fgets(STDIN));
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL,"https://kichhoat24h.com/public-api/check-key?key=$key&token=$token");
    $result=curl_exec($ch);
    curl_close($ch);
    if ($result == "Invalid syntax or token!" OR $result == ""){
        print "$red [!]$white Invalid License Key, please check your Key again\n\n";
    } else {
        $result = explode(': ',$result);
        $result = str_replace('Key','',$result);
        $result = str_replace('Description','',$result);
        $result = str_replace('Sub Type','',$result);
        $result = str_replace('Error Code','',$result);
        $result = str_replace('Time','',$result);
        $result = str_replace(PHP_EOL,'',$result);
        if ($result[4] == "0xC004C060"){
            $status = "Die";
        } elseif ($result[4] == "0xC004C008"){
            if ($winoff[0] == "Windows" OR $winoff[0] == "Win"){
                $status = "Die";
            } else {
                $status = "Activated by Phone";
            }
        } elseif ($result[4] == "Online "){
            $status = "Retail";
        } else {
            $status = $result[4];
        }
        print "$okegreen [*]$white Type : ".$result[2]."\n";
        print "$okegreen [*]$white SubType : ".$result[3]."\n";
        print "$okegreen [*]$white Status : ".$status."\n";
    }
}

?>
