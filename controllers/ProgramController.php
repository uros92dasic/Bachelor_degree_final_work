<?php
    namespace App\Controllers;

    class ProgramController extends \App\Core\Controller {
        
        public function show() {
            $programModel = new \App\Models\ProgramModel($this->getDatabaseConnection());
            $programi = $programModel->getAll();

            $this->set('programi', $programi);
        }

        public function showProgram($id) {
            $programModel = new \App\Models\ProgramModel($this->getDatabaseConnection());
            $programInfo = $programModel->getById($id);

            if (!$programInfo) {
                header('Location: /');
                exit;
            }
            // rucno napravljen mehanizam za 404 page

            $this->set('programInfo', $programInfo);

            $daniModel = new \App\Models\DaniModel($this->getDatabaseConnection());
            $dani = $daniModel->getDanByProgram($id);

            $this->set('dani', $dani);
        }

        public function showTermini($programId, $danId) {
            $programTerminModel = new \App\Models\ProgramTerminModel($this->getDatabaseConnection());
            $termini = $programTerminModel->getTerminByProgramDanId($programId, $danId);

            $this->set('termini', $termini);
        }
        
        public function delete($id){
            die('Nije zavrsena implementacija brisanja.');
        }

        private function normaliseKeywords(string $keywords): string {
            $keywords = trim($keywords);
            $keywords = preg_replace('/ +/', ' ', $keywords);
            # ...
            return $keywords;
        }

        public function postSearch() {
            $programModel = new \App\Models\ProgramModel($this->getDatabaseConnection());
            
            $q = filter_input(INPUT_POST, 'q', FILTER_SANITIZE_STRING);
            $q = $this->normaliseKeywords($q);

            $programSearch = $programModel->getAllBySearch($q);

            $this->set('postSearch', $programSearch);
        }
    }