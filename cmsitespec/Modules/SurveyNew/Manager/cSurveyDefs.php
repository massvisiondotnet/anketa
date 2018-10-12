<?php

namespace cMASS\Modules\SurveyNew\Manager;

use cMASS\Modules\SurveyNew\Manager\Questions\cTextual;

require_once PATH_SURVEY_NEW . '/Manager/iSurveyDefs.php';

/**
 * Class cSurveyDefs
 *
 * @package cMASS\Modules\SurveyNew\Manager
 */
class cSurveyDefs implements iSurveyDefs {

    /**
     * Get defined surveys
     *
     * @return array
     */
    public function getSurveys() {
        return array(
            array(
                'id' => 1,
                'json' => realpath(__DIR__ . '/Surveys/survey_1.json'),
            ),
        );
    }

    /**
     * Get active survey
     *
     * @return int
     */
    public function getActiveSurvey() {
        return 1;
    }

    /**
     * Perform post-processing
     *
     * @param  cSurvey $survey
     * @return void
     */
    public function postProcess(cSurvey $survey) {
        $mail = '';
        foreach ($survey->getTextualQuestions() as $q) {
            /** @var cTextual $q */
            if (!$q->isEmpty()) {
                if ($q->getTitle() == 'Omiljeni brend') {
                    mail(
                        DM_ANKETA_MAIL_BREND,
                        'dm anketa - omiljeni brend',
                        $q->getTitle().":<br>".$q->getTextForMail(),
                        'From: '. DM_ANKETA_MAIL_SENDER . "\r\n" .
                        'Reply-To: ' . DM_ANKETA_MAIL_SENDER . "\r\n" .
                        'Content-type: text/html; charset=UTF-8' . "\r\n"
                    );

                } else if ($q->getTitle() == 'Komentar') {
                    mail(
                        DM_ANKETA_MAIL_KOMENTAR,
                        'dm anketa - komentar',
                        $q->getTitle().":<br>".$q->getTextForMail(),
                        'From: '. DM_ANKETA_MAIL_SENDER . "\r\n" .
                        'Reply-To: ' . DM_ANKETA_MAIL_SENDER . "\r\n" .
                        'Content-type: text/html; charset=UTF-8' . "\r\n"
                    );
                }                
            }
        }
    }
}