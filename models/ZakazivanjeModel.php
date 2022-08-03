<?php
    namespace App\Models;
    
    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;

    class ZakazivanjeModel extends Model {
        protected function getFields(): array {
            return [
                'zakazivanje_id'        => new Field((new NumberValidator())->setIntegerLength(11), false),
                'program_termin_id'     => new Field((new NumberValidator())->setIntegerLength(11)),
                'korisnik_id'           => new Field((new NumberValidator())->setIntegerLength(11))
            ];
        }
    }