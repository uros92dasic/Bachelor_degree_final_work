<?php
    namespace App\Controllers;

    class DaniController extends \App\Core\Controller {
        
        public function show() {
            $daniModel = new \App\Models\DaniModel($this->getDatabaseConnection());
            $dani = $daniModel->getAll();

            $this->set('dani', $dani);
        }

        public function showProgrami($id) {
            $programTerminModel = new \App\Models\ProgramTerminModel($this->getDatabaseConnection());
            $programi = $programTerminModel->getProgramByDanId($id);

            $this->set('programi', $programi);
        }

        public function showTermini($danId, $programId) {
            $programTerminModel = new \App\Models\ProgramTerminModel($this->getDatabaseConnection());
            $termini = $programTerminModel->getTerminByDanProgramId($danId, $programId);

            $this->set('termini', $termini);
        }

    }