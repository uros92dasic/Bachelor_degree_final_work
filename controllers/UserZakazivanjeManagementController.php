<?php
    namespace App\Controllers;

    class UserZakazivanjeManagementController extends \App\Core\Role\UserRoleController {
        public function zakazi(){
            $korisnikId = $this->getSession()->get('korisnik_id');

            $zakazivanjeModel = new \App\Models\ZakazivanjeModel($this->getDatabaseConnection());
            $zakazivanje = $zakazivanjeModel->getAllByKorisnikId($korisnikId);

            $this->set('zakazivanje', $zakazivanje);
        }

        public function programi() {
            $programModel = new \App\Models\ProgramModel($this->getDatabaseConnection());
            $programi = $programModel->getAllActive(1);

            $this->set('programi', $programi);
        }

        public function dani($id) {
            $programModel = new \App\Models\ProgramModel($this->getDatabaseConnection());
            $programi = $programModel->getById($id);

            $this->set('programi', $programi);

            $daniModel = new \App\Models\DaniModel($this->getDatabaseConnection());
            $dani = $daniModel->getDanByProgram($id);

            $this->set('dani', $dani);
        }

        public function termini($programId, $danId) {
            $programTerminModel = new \App\Models\ProgramTerminModel($this->getDatabaseConnection());
            $termini = $programTerminModel->getTerminByProgramDanId($programId, $danId);

            $this->set('termini', $termini);
        }

        public function getAdd($programId, $danId, $terminId) {
            $korisnikId = $this->getSession()->get('korisnik_id');

            $programTerminModel = new \App\Models\ProgramTerminModel($this->getDatabaseConnection());
            $zakaziTermin = $programTerminModel->getZakaziTerminInfo($programId, $danId, $terminId);

            $this->set('zakaziTermin', $zakaziTermin);
        }

        public function postAdd($programId, $danId, $terminId) {
            $addData = [
                'program_termin_id' => \filter_input(INPUT_POST, 'programTerminId', FILTER_SANITIZE_NUMBER_INT),
                'korisnik_id'       => $this->getSession()->get('korisnik_id')
            ];
            $programTerminModel = new \App\Models\ProgramTerminModel($this->getDatabaseConnection());
            $zakaziTermin = $programTerminModel->getZakaziTerminInfo($programId, $danId, $terminId);
            
            if ($zakaziTermin->program_termin_id != \filter_input(INPUT_POST, 'programTerminId', FILTER_SANITIZE_NUMBER_INT)) {
                $this->redirect(\Configuration::BASE.'user/zakazi/');
                return;
            }

            $zakaziModel = new \App\Models\ZakazivanjeModel($this->getDatabaseConnection());

            $programTerminId = $zakaziModel->add($addData);

            if (!$programTerminId) {
                $this->set('message', 'Neuspesno zakazivanje termina.');
                return;
            }

            $this->redirect(\Configuration::BASE.'user/zakazi/');
        }

        public function getEdit($programTerminId) {
            $programTerminModel = new \App\Models\ProgramTerminModel($this->getDatabaseConnection());
            $termin = $programTerminModel->getById($programTerminId);

            if (!$termin) {  
                $this->redirect(\Configuration::BASE.'user/zakazi/');
                return;
            }

            $zakazivanjeModel = new \App\Models\ZakazivanjeModel($this->getDatabaseConnection());
            $korisnik = $zakazivanjeModel->getAllByProgramTerminId($programTerminId);

            if ($korisnik->korisnik_id != $this->getSession()->get('korisnik_id')) {
                $this->redirect(\Configuration::BASE.'user/zakazi/');
                return;
            }

            $this->set('termin', $termin);
        }

        public function postEdit($programTerminId) {
            $this->getEdit($programTerminId);
            
            $zakaziModel = new \App\Models\ZakazivanjeModel($this->getDatabaseConnection());
            $zakaziTermin = $zakaziModel->getAllByProgramTerminId($programTerminId);

            if ($zakaziTermin->program_termin_id != \filter_input(INPUT_POST, 'idTermina', FILTER_SANITIZE_NUMBER_INT)) {
                $this->redirect(\Configuration::BASE.'user/zakazi/');
                return;
            }

            $res = $zakaziModel->deleteById($zakaziTermin->zakazivanje_id);

            if (!$res) {
                $this->set('message', 'Nije bilo moguce izmeniti podatke.');
                return;
            }

            $this->redirect(\Configuration::BASE.'user/zakazi/');
        }
        
    }