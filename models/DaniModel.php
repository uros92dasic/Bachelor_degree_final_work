<?php
    namespace App\Models;

    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;

    class DaniModel extends Model {
        protected function getFields(): array {
            return [
                'dani_id'               => new Field((new NumberValidator())->setIntegerLength(11), false),
                'dan'                   => new Field((new StringValidator())->setMaxLength(255))
            ];
        }

        public function getDanByProgram(int $programId): array {
            $sql = 'SELECT DISTINCT dani.dan, dani.dani_id
                    FROM dani
                    INNER JOIN program_termin ON program_termin.dan_id=dani.dani_id
                    WHERE program_termin.program_id IN (?)';
            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute([$programId]);
            $programi = [];
            if ($res) {
                $programi = $prep->fetchAll(\PDO::FETCH_OBJ);
            }
            return $programi;
        }
    }