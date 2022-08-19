<?php
    namespace App\Controllers;

    class MainController extends \App\Core\Controller {
        
        public function home() {
            
        }

        public function getRegister() {
            # ...
        }

        public function postRegister() {
            $ime = \filter_input(INPUT_POST, 'reg_ime', FILTER_SANITIZE_STRING);
            $prezime = \filter_input(INPUT_POST, 'reg_prezime', FILTER_SANITIZE_STRING);
            $br_tel = \filter_input(INPUT_POST, 'reg_br_tel', FILTER_SANITIZE_STRING);
            $email = \filter_input(INPUT_POST, 'reg_email', FILTER_SANITIZE_EMAIL);
            $password1 = \filter_input(INPUT_POST, 'reg_password_1', FILTER_SANITIZE_STRING);
            $password2 = \filter_input(INPUT_POST, 'reg_password_2', FILTER_SANITIZE_STRING);
            
            if ($password1 !== $password2) {
                $this->set('message', 'Doslo je do greske: Niste uneli dva puta istu lozinku.');
                return;
            }

            if (! (new \App\Validators\StringValidator())
                                ->setMinLength(8)
                                ->setMaxLength(120)
                                ->isValid($password1)) {
                $this->set('message', 'Doslo je do greske: Lozinka nije ispravnog formata.');
                return;
            }

            $korisnikModel = new \App\Models\KorisnikModel($this->getDatabaseConnection());
            $korisnik = $korisnikModel->getByFieldName('email', $email);
            if ($korisnik) {
                $this->set('message', 'Doslo je do greske: Korisnik sa tim emailom vec postoji.');
                return;
            }
            //$username = $korisnikModel->getByFieldName('username', $username); ... if ($username) ... ako user/email postoji

            $passwordHash = \password_hash($password1, PASSWORD_DEFAULT);

            $korisnikId = $korisnikModel->add([
                'ime'           => $ime,
                'prezime'       => $prezime,
                'br_tel'        => $br_tel,
                'email'         => $email,
                'password_hash' => $passwordHash,
            ]);

            if (!$korisnikId) {
                $this->set('message', 'Doslo je do greske: Registracija nije uspesna.');
                return;
            }
            
            $this->set('message', 'Uspesno zavrsena registracija.');
        }

        public function getLogin() {
            # ...
        }

        public function postLogin() {
            $email    = \filter_input(INPUT_POST, 'login_email', FILTER_SANITIZE_EMAIL);
            $password = \filter_input(INPUT_POST, 'login_password', FILTER_SANITIZE_STRING);

            if (! (new \App\Validators\StringValidator())
                                ->setMinLength(3)
                                ->setMaxLength(120)
                                ->isValid($password)) {
                $this->set('message', 'Doslo je do greske: Lozinka nije ispravnog formata.');
                return;
            }

            $korisnikModel = new \App\Models\KorisnikModel($this->getDatabaseConnection());
            $korisnik = $korisnikModel->getByFieldName('email', $email);
            if (!$korisnik) {
                $this->set('message', 'Doslo je do greske: Korisnik sa tim emailom ne postoji.');
                return;
            }

            if (!password_verify($password, $korisnik->password_hash)) {
                sleep(1); //brut fors napad sa jednog izvora
                $this->set('message', 'Doslo je do greske: Lozinka nije ispravna.');
                return;
            }
            
            $this->getSession()->put('korisnik_id', $korisnik->korisnik_id);
            $this->getSession()->save();

            $this->redirect(\Configuration::BASE.'user/profile');
        }

        public function getLogout() {
            $this->getSession()->remove('korisnik_id');
            $this->getSession()->save();

            $this->redirect(\Configuration::BASE);
        }
    }