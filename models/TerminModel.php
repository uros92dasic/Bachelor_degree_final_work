<?php
    namespace App\Models;
    
    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\DateTimeValidator;
    use App\Validators\StringValidator;

    class TerminModel extends Model {
        protected function getFields(): array {
            return [
                'termin_id'     => new Field((new NumberValidator())->setIntegerLength(11), false),
                'vreme_od'      => new Field((new DateTimeValidator())->allowTime(), false),
                'vreme_do'      => new Field((new DateTimeValidator())->allowTime(), false),
                'opis'          => new Field((new StringValidator())->setMaxLength(64*1024))
            ];
        }
    }