<?php

$algorithm = 'whirlpool';
$saltLength = 12;

function encryptPassword($password) {
        
        // Generate a random salt of the given length
	$salt = substr(hash($algorithm, uniqid(rand(), true)), 0, $saltLength);

        // Combine the salt and the password and hash them
	$hash = hash($algorithm, $salt . $password);

        // Calculate where the salt should be inserted into the new hash
	$saltPos = (strlen($password) >= strlen($hash) ? strlen($hash) : strlen($password));

        // Insert the salt into the hash at the password length's location
	return substr($hash, 0, $saltPos) . $salt . substr($hash, $saltPos);
}

function checkPassword($password, $storedPassword) {

        // Calculate where the salt should have been inserted into the stored hash
        $saltPos = (strlen($password) >= strlen($storedPassword) ? strlen($storedPassword) : strlen($password));

        // Extract the salt from the stored hash
        $salt = substr($storedPassword, $saltPos, $saltLength);

        // Combine the salt and the password being checked and hash them
        $hash = hash($algorithm, $salt . $password);

        // See if the stored hash is identical to the new hash with the salt inserted into it
        return $storedPassword == substr($hash, 0, $saltPos) . $salt . substr($hash, $saltPos);
}
