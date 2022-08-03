<?php
    namespace App\Models;
    
    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;

    class KorisnikProgramModel extends Model {
        protected function getFields(): array {
            return [
                'uloga_id'              => new Field((new NumberValidator())->setIntegerLength(11), false),
                'uloga'                 => new Field((new StringValidator())->setMaxLength(255))
            ];
        }
    }