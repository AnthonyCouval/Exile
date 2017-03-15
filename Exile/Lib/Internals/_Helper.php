<?php

/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 01/01/2015
 * Time: 12:13
 */
class _Helper
{

    /**
     * Méthode qui traite la date et l'heure
     * @param $date
     * @return array
     */
    static function traitementDateHeure($date)
    {
        $dateArray = explode(' ', $date);
        $date      = $dateArray[0];
        $heure     = $dateArray[1];
        $heure     = str_replace(':', 'h', $heure);
        return array($date, $heure);
    }

    /**
     * Méthode qui récupére les catégories checkée
     * @param $categorieChecked
     * @return array|string
     */
    static function traitementCategorie($categorieChecked)
    {
        if (count($categorieChecked) > 0) {
            foreach ($categorieChecked as $key => $value) $categorie[] = $value;
        }
        $categorie = implode('-', $categorie);
        return $categorie;
    }

    /**
     * Méthode qui traite du texte
     * @param $string
     * @return mixed|string
     */
    static function traitementTexte($string)
    {
        $string = strtr($string,
            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        $string = preg_replace('/([^.a-z0-9]+)/i', '-', $string);
        return $string;
    }

    /**
     * Retourne le prix si payant a été choisi
     * @param $prix
     * @param $combien
     * @return string
     */
    static function traitementPrix($prix, $combien)
    {
        if ($prix == 'payant') $prix = htmlspecialchars($combien);
        return $prix;
    }

    /**
     * Pour garder les champs dans les formulaires
     * @param $input
     * @return string
     */
    static function form($input)
    {
        return isset($_POST[$input]) ? $_POST[$input] : '';
    }

    /**
     * Boucle sur les événements et les affiche
     * @param $events
     */
    static function loopOnEventsForMarketing($events)
    {
        foreach ($events as $event) {
            echo '<tr><td>' . $event->ID . '</td><td>' . $event->titre . '</td><td>' . $event->description . '</td><td>' . $event->display . '</td><td>';
            if ($event->sponsor) echo '<img src="/www/img/events/' . $event->sponsor . ' class="event_thumbnail"></td></tr>';
            else echo '</td></tr>';
        }
    }

    static function loopOnEventsForModeration($events)
    {
        $image = '';
        foreach ($events as $event) {
            if ($event->image) {
                if ($event->import == 'tourinsoft') {
                    $image = 'http://cdt33.media.tourinsoft.eu/upload/' . $event->image;
                } else if($event->import == 'agendaculturel'){
                    $image = $event->image;
                }else{
                    $image = '/www/img/events/' . $event->image;
                }
            }

            echo '<tr><td>' . $event->ID . '</td><td>'. $event->titre . '</td>
                  <td>' . $event->description . '</td><td>' . $event->categorie . '</td>
                  <td>' . $event->date . '</td><td>' . $event->horaires . '</td>
                  <td>' . $event->prix . '</td><td>' . $event->adresse . '</td>
                  <td><img src="' . $image . '" class="event_thumbnail"></td><td>
                  <span class="glyphicon glyphicon-repeat recompil" id="' . $event->ID . '"></span>
                  <span class="glyphicon glyphicon-search voir" id="' . $event->ID . '"></span>
                  </td><td><span class="glyphicon glyphicon-remove delete" id="' . $event->ID . '"></span>
                  </td></tr>';
        }
    }

    /**
     * Définie si SG est gagnant ou pas
     *
     * @param $scoreSG
     * @param $scoreAdversaire
     *
     * @return bool
     */
    static function isSGWinner($scoreSG, $scoreAdversaire)
    {
        if($scoreSG != $scoreAdversaire){
            if($scoreSG > $scoreAdversaire || $scoreSG == 16){
                echo 'win';
            }else{
                return 'lose';
            }
        }else{
            echo 'draw';
        }
    }

    /**
     * Définie si l'adversaire est gagnant ou pas
     *
     * @param $scoreSG
     * @param $scoreAdversaire
     *
     * @return bool
     */
    static function isAdvWinner($scoreSG, $scoreAdversaire)
    {
        if($scoreSG != $scoreAdversaire){
            if($scoreSG > $scoreAdversaire || $scoreSG == 16){
                echo 'lose';
            }else{
                echo 'win';
            }
        }else{
            echo 'draw';
        }

    }
}