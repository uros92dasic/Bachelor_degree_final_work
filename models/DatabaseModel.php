<?php
    namespace App\Models;

    use App\Core\Model;
    use App\Core\Field;

    class DatabaseModel extends Model{
        
        public function getAll(): array {
            $sql = "SELECT TABLE_NAME 
                    FROM INFORMATION_SCHEMA.TABLES 
                    WHERE TABLE_TYPE = 'BASE TABLE' 
                        AND TABLE_SCHEMA = 'db_gvozdjar'
                        AND TABLE_NAME IN ('korisnik', 'program', 'termin', 'dani');";
            $prep = $this->getConnection()->prepare($sql);
            $res = $prep->execute();
            $tabele = [];
            if ($res) {
                $tabele = $prep->fetchAll(\PDO::FETCH_OBJ);
            }
            return $tabele;
        }
    }
