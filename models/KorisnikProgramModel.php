<?php
    namespace App\Models;
    
    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;

    class KorisnikProgramModel extends Model {
        protected function getFields(): array {
            return [
                'korisnik_program_id'   => new Field((new NumberValidator())->setIntegerLength(11), false),
                'korisnik_id'           => new Field((new NumberValidator())->setIntegerLength(11)),
                'program_id'            => new Field((new NumberValidator())->setIntegerLength(11))
            ];
        }
    }