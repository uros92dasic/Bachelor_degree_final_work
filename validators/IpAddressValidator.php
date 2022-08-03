<?php
    namespace App\Validators;
    use \App\Core\Validator;

    class IpAddressValidator implements Validator {

        public function __construct() {

        }

        public function isValid(string $value): bool {

            return \boolval(\preg_match('@^[0-9]{1,3}(\.[0-9]{1,3}){3}|(::[0-9]+)$@', $value));
        }
    }