<?php
    namespace App\Models;
    
    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;

    class KorisnikProgramModel extends Model {
        protected function getFields(): array {
            return [
                'verify_id'             => new Field((new NumberValidator())->setIntegerLength(11), false),
                'code'                  => new Field((new NumberValidator())->setIntegerLength(11)),
                'expires'               => new Field((new NumberValidator())->setIntegerLength(11)),
                'email'                 => new Field((new StringValidator())->setMaxLength(255))
            ];
        }
    }