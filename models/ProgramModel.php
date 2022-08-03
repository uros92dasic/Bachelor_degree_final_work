<?php
    namespace App\Models;
    
    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;
    use App\Validators\BitValidator;

    class ProgramModel extends Model {
        protected function getFields(): array {
            return [
                'program_id'            => new Field((new NumberValidator())->setIntegerLength(11), false),
                'ime'                   => new Field((new StringValidator())->setMaxLength(255)),
                'aktivan'               => new Field((new BitValidator())),
                'opis'                  => new Field((new StringValidator())->setMaxLength(64*1024))
            ];
        }

    }