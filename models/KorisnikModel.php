<?php
    namespace App\Models;

    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\DateTimeValidator;
    use App\Validators\StringValidator;
    use App\Validators\BitValidator;

    class KorisnikModel extends Model{
        protected function getFields(): array {
            return [
                'korisnik_id'           => new Field((new NumberValidator())->setIntegerLength(11), false),
                'ime'                   => new Field((new StringValidator())->setMaxLength(255)),
                'prezime'               => new Field((new StringValidator())->setMaxLength(255)),
                'br_tel'                => new Field((new StringValidator())->setMaxLength(255)),
                'email'                 => new Field((new StringValidator())->setMaxLength(255)),
                'conf_email'            => new Field((new BitValidator())),
                'password_hash'         => new Field((new StringValidator())->setMaxLength(255)),
                'verified'              => new Field((new BitValidator())),
                'komentar'              => new Field((new StringValidator())->setMaxLength(64*1024)),
                'date_added'            => new Field((new DateTimeValidator())->allowDate()
                                                                              ->allowTime(), false)
            ];
        }


        public function getByIme(string $korisnikIme) {
            return $this->getByFieldName('ime', $korisnikIme);
        }

        public function getByPrezime(string $korisnikPrezime) {
            return $this->getByFieldName('prezime', $korisnikPrezime);
        }

        public function getByBrTel(string $korisnikBrTel) {
            return $this->getByFieldName('br_tel', $korisnikBrTel);
        }

        public function getByEmail(string $korisnikEmail) {
            return $this->getByFieldName('email', $korisnikEmail);
        }

        /*
        public function getByUsername(string $username) {
            return $this->getByFieldName('username', $username);
        }
        */

        /*
        public function getAllByCategoryId(int $categoryId): array {
            return $this->getByFieldName('category_id', $categoryId);
        }
        */

        /*
        public function getAllByAuctionId(int $auctionId): array {
            $items = $this->getAllByFieldName('auctioni_id', $auctionId);

            usort($items, function($a, $b) {
                return strcmp($a->created_at, $b->created_at);
            });

            return $items;
        }
        */

        /*
        public function getAllByIpAddress(string $ipAddress): array {
            return $this->getAllByFieldName('ip_address', $ipAddress);
        }
        */
    }