<?php
    namespace App\Controllers;

    class TerminController extends \App\Core\Controller {

        public function show($programId, $danId, $terminId) {
            $programTerminModel = new \App\Models\ProgramTerminModel($this->getDatabaseConnection());
            $zakaziTermin = $programTerminModel->getZakaziTerminInfo($programId, $danId, $terminId);

            $this->set('zakaziTermin', $zakaziTermin);

            $testModel = new \App\Models\TestModel($this->getDatabaseConnection());

            $ipAddress = filter_input(INPUT_SERVER, 'REMOTE_ADDR');
            $userAgent = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT');

            $testModel->add([
                'dan_id'        => $danId,
                'program_id'    => $programId,
                'termin_id'     => $terminId,
                'ip_address'    => $ipAddress,
                'user_agent'    => $userAgent
            ]);
        }

    }