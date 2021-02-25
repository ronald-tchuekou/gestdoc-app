<?php

namespace App\Models;

use DateTime;

class Utils {

    static $DOC_CATEGORIES = [

    ];

    static $PRESTATAIRES = [
        'PREFECTURE',
        'MINDDEVEL',
        'MINMAP',
        'FEICOM',
        'PNDP',
        'MINTP',
        'CONTRIBUABLE',
        'COMITE DEVELOPPEMENT',
        'PROJETS',
        'AUTRES',
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
     * Fonction qui permet de formater la date.
     */
    public static function simple_date_format($date){
        return date_format(new DateTime($date), 'd-m-Y');
    }

    /**
     * Fonction qui permet de formater une date en heure.
     */
    public static function hour_format($date) {
        return date_format(new DateTime($date), 'H:i');
    }

    /**
     * Fonction qui peremt d'avoir une estimation du temps passé.
     */
    public static function get_time_ago( $time ) {
        $time_difference = time() - $time;

        if( $time_difference < 1 ) { return 'il y\'a une seconde'; }
        $condition = array( 12 * 30 * 24 * 60 * 60 =>  'an',
                    30 * 24 * 60 * 60       =>  'moi',
                    24 * 60 * 60            =>  'jour',
                    60 * 60                 =>  'heure',
                    60                      =>  'minute',
                    1                       =>  'seconde'
        );

        foreach( $condition as $secs => $str )
        {
            $d = $time_difference / $secs;

            if( $d >= 1 )
            {
                $t = round( $d );
                return 'Il y\'a ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' );
            }
        }
    }

}
