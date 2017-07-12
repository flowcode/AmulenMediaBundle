<?php

namespace Flowcode\MediaBundle\Twig;


use Flowcode\MediaBundle\Services\YoutubeService;

class AppExtension extends \Twig_Extension
{

    /* @var YoutubeService */
    private $youtubeService;

    /**
     * AppExtension constructor.
     * @param $youtubeService
     */
    public function __construct($youtubeService)
    {
        $this->youtubeService = $youtubeService;
    }


    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('youtubeId', array($this, 'getYoutubeId')),
        );
    }

    public function getYoutubeId($youtubeUrl)
    {
        return $this->getYoutubeService()->getIdFromUrl($youtubeUrl);
    }

    /**
     * @return YoutubeService
     */
    public function getYoutubeService()
    {
        return $this->youtubeService;
    }

    /**
     * @param mixed $youtubeService
     */
    public function setYoutubeService($youtubeService)
    {
        $this->youtubeService = $youtubeService;
    }


}