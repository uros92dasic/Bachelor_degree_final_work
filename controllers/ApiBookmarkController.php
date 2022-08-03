<?php
    namespace App\Controllers;

    class ApiBookmarkController extends \App\Core\ApiController {
        public function getBookmarks() {
            $bookmarks = $this->getSession()->get('bookmarks', []);
            $this->set('bookmarks', $bookmarks);
        }

        public function addBookmark($programId) {
            $programModel = new \App\Models\ProgramModel($this->getDatabaseConnection());
            $program = $programModel->getById($programId);

            if (!$program) {
                $this->set('error', -1); //-1: ne postoji
                return;
            }

            $bookmarks = $this->getSession()->get('bookmarks', []);

            foreach ($bookmarks as $bookmark) {
                if ($bookmark->program_id == $programId) {
                    $this->set('error', -2); //-2: vec postoji
                    return;
                }
            }

            $bookmarks[] = $program;
            $this->getSession()->put('bookmarks', $bookmarks);

            $this->set('error', 0); //0: proslo
        }

        public function clearBookmarks() {
            $this->getSession()->put('bookmarks', []);

            $this->set('error', 0);
        }
    }