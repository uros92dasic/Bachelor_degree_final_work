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

        public function getAllByKorisnikId(int $korisnikId): array {
            return $this->getAllByFieldName('korisnik_id', $korisnikId);
        }

        public function getAllByProgramTerminId(int $programTerminId) {
            return $this->getByFieldName('program_termin_id', $programTerminId);
        }
    }

    