<?php
    namespace App\Controllers;

    class ApiProgramController extends \App\Core\ApiController {
        public function showProgram($id) {
            $programModel = new \App\Models\ProgramModel($this->getDatabaseConnection());
            $program = $programModel->getById($id);

            $this->set('program', $program);
        }
    }