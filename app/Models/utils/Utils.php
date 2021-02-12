<?php

namespace App\Models\Utils;

use DateTime;

class Utils {

    static $DOC_CATEGORIES = [

    ];

    static $PRESTATAIRES = [
        'MINCOM', 'SSCO',
    ];

    /**
     * Fonction qui permet de formter les dates.
     */
    public static function full_date_format ($date){
        return date_format(new DateTime($date), 'd M Y h:i');
    }

    /**
     * Fonction qui permet de formater la date.
     */
    public static function date_format($date){
        return date_format(new DateTime($date), 'd M Y');
    }

    /**
     * Fonction qui permet de formater une date en heure.
     */
    public static function hour_format($date) {
        return date_format(new DateTime($date), 'H:i');
    }
    
}