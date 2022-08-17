<?php
    namespace App\Controllers;

    class UserDashboardController extends \App\Core\Role\UserRoleController {
        public function index() {
            $korisnikId = $this->getSession()->get('korisnik_id');
            $korisnikModel = new \App\Models\KorisnikModel($this->getDatabaseConnection());
            $korisnik = $korisnikModel->getById($korisnikId);
            $this->set('korisnik', $korisnik);
        }

        public function getEdit() {
            $korisnikId = $this->getSession()->get('korisnik_id');
            $korisnikModel = new \App\Models\KorisnikModel($this->getDatabaseConnection());
            $korisnik = $korisnikModel->getById($korisnikId);
            $this->set('korisnik', $korisnik);
        }

        public function postEdit() {
            $korisnikId = $this->getSession()->get('korisnik_id');
            $editData = [
                'ime' => \filter_input(INPUT_POST, 'ime', FILTER_SANITIZE_STRING),
                'prezime' => \filter_input(INPUT_POST, 'prezime', FILTER_SANITIZE_STRING),
                'br_tel' => \filter_input(INPUT_POST, 'br_tel', FILTER_SANITIZE_STRING),
                'email' => \filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)
            ];
            $korisnikModel = new \App\Models\KorisnikModel($this->getDatabaseConnection());
            $res = $korisnikModel->editById($korisnikId, $editData);
            if(!$res){
                $this->set('message', 'Nije bilo moguce izmeniti podatke.');
            }
            $this->redirect(\Configuration::BASE.'user/profile');
        }
    }