<?php
    namespace App\Models;
    
    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;

    class KorisnikUlogaModel extends Model {
        protected function getFields(): array {
            return [
                'korisnik_uloga_id'     => new Field((new NumberValidator())->setIntegerLength(11), false),
                'korisnik_id'           => new Field((new NumberValidator())->setIntegerLength(11)),
                'uloga_id'              => new Field((new NumberValidator())->setIntegerLength(11))
            ];
        }
    }

    