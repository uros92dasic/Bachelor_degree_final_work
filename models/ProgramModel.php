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

        public function getAllActive(int $aktivan): array {
            return $this->getAllByFieldName('aktivan', $aktivan);
        }

        public function getAllBySearch(string $keywords) {
            $sql = 'SELECT * FROM program WHERE `ime` LIKE ? OR `opis` LIKE ?;';
            $keywords = '%'.$keywords.'%';
            $prep = $this->getConnection()->prepare($sql);
            if (!$prep) {
                return [];
            }
            $res = $prep->execute([$keywords, $keywords]);
            if (!$res) {
                return [];
            }

            return $prep->fetchAll(\PDO::FETCH_OBJ);
        }
    }