<?php

function password_encryption($input, $rounds = 7) {
    $salt = "";
    $salt_chars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
    for ($i = 0; $i < 22; $i++) {
        $salt .= $salt_chars[array_rand($salt_chars)];
    }
    return crypt($input, sprintf('$2a$%02d$', $rounds) . $salt);
}

$con = mysqli_connect('10.10.10.60','cms','551100*13','citysys');
$old = '13286';
$new = password_encryption($old);
$sqlpassword = "Update tblstudent set StudPasswordCrypt='$new' where StudentId in (21391) ";
$querypassword = mysqli_query($con,$sqlpassword);




?>