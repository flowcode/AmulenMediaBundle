<?php

namespace Flowcode\MediaBundle\Services;

class YoutubeService
{

    public function getIdFromUrl($url)
    {
        $ytarray = explode("/", $url);
        $ytendstring = end($ytarray);
        $ytendarray = explode("?v=", $ytendstring);
        $ytendstring = end($ytendarray);
        $ytendarray = explode("&", $ytendstring);
        $ytcode = isset($ytendarray[0]) ? $ytendarray[0] : false;

        return $ytcode;
    }
}