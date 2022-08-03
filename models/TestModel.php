<?php
    namespace App\Models;
    
    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\DateTimeValidator;
    use App\Validators\StringValidator;
    use App\Validators\IpAddressValidator;

    class TestModel extends Model {
        protected function getFields(): array {
            return [
                'test_id'               => new Field((new NumberValidator())->setIntegerLength(11), false),
                'dan_id'                => new Field((new NumberValidator())->setIntegerLength(11)),
                'program_id'            => new Field((new NumberValidator())->setIntegerLength(11)),
                'termin_id'             => new Field((new NumberValidator())->setIntegerLength(11)),
                'ip_address'            => new Field((new IpAddressValidator())),
                'user_agent'            => new Field((new StringValidator())->setMaxLength(255)),
                'created_at'            => new Field((new DateTimeValidator())->allowDate()
                                                                              ->allowTime(), false)
            ];
        }
    }