<?php
    namespace App\Controllers;

    class UserProgramManagementController extends \App\Core\Role\UserRoleController {
        public function programi() {
            $programModel = new \App\Models\ProgramModel($this->getDatabaseConnection());
            $programi = $programModel->getAll();

            $this->set('programi', $programi);
        }

        public function getEdit($programId) {
            $programModel = new \App\Models\ProgramModel($this->getDatabaseConnection());
            $program = $programModel->getById($programId);

            if (!$program) {
                $this->redirect(\Configuration::BASE.'user/program');
            }

            $this->set('program', $program);

            return $programModel;
        }

        public function postEdit($programId) {
            $programModel = $this->getEdit($programId);

            $ime = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

            $programModel->editById($programId, [
                'ime' => $ime
            ]);

            $this->redirect(\Configuration::BASE.'user/program');
        }

        public function getAdd() {

        }

        public function postAdd() {
            $ime = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $programModel = new \App\Models\ProgramModel($this->getDatabaseConnection());
            $programId = $programModel->add([
                'ime'     => $ime,
                'aktivan' => 0
            ]);

            if ($programId) {
                $this->redirect(\Configuration::BASE.'user/program');
            }

            $this->set('message', 'Doslo je do kreske: Nije moguce dodati ovaj program...');
        }
    }