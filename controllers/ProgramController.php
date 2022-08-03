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

            /*
            var_dump($programInfo);
            exit; //provera da li dobijamo NULL ili FALSE prilikom pogresnog upisa, if ($programInfo === false) { }
            */
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
        
        public function delete($id){
            die('Nije zavrsena implementacija brisanja.');
        }

    }