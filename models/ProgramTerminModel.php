<?php
    namespace App\Models;
    
    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;

    class ProgramTerminModel extends Model {
        protected function getFields(): array {
            return [
                'program_termin_id'     => new Field((new NumberValidator())->setIntegerLength(11), false),
                'program_id'            => new Field((new NumberValidator())->setIntegerLength(11)),
                'termin_id'             => new Field((new NumberValidator())->setIntegerLength(11)),
                'dan_id'                => new Field((new NumberValidator())->setIntegerLength(11))
            ];
        }

        public function getProgramByDanId(int $danId): array {
            $sql = 'SELECT DISTINCT program.ime, program.aktivan, program.program_id, program_termin.dan_id
                    FROM program_termin
                    INNER JOIN program ON program_termin.program_id=program.program_id
                    WHERE program_termin.dan_id = ?;';
            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute([$danId]);
            $termini = [];
            if ($res) {
                $termini = $prep->fetchAll(\PDO::FETCH_OBJ);
            }
            return $termini;
        }

        public function getTerminByDanProgramId(int $danId, int $programId): array {
            $sql = 'SELECT * FROM program_termin WHERE dan_id = ? AND program_id = ?;';
            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute([$danId, $programId]);
            $termini = [];
            if ($res) {
                $termini = $prep->fetchAll(\PDO::FETCH_OBJ);
            }
            return $termini;
        }

        public function getZakaziTermin(int $danId, int $programId, int $terminId): array {
            $sql = 'SELECT program_termin.*, dani.dan, program.ime, termin.vreme_od, termin.vreme_do
                    FROM program_termin
                    INNER JOIN dani ON program_termin.dan_id=dani.dani_id
                    INNER JOIN program ON program_termin.program_id=program.program_id
                    INNER JOIN termin ON program_termin.termin_id=termin.termin_id
                    WHERE program_termin.dan_id = ?
                    AND program_termin.program_id = ?
                    AND program_termin.termin_id = ?;';
            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute([$danId, $programId, $terminId]);
            $termini = [];
            if ($res) {
                $termini = $prep->fetchAll(\PDO::FETCH_OBJ);
            }
            return $termini;
        }
    }