<?php

namespace Flowcode\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of SliderController
 *
 * @author Juan Manuel Agüero <jaguero@flowcode.com.ar>
 */
class MediaController extends Controller {

    public function youtubeListAction($template = 'FlowcodeMediaBundle:Media:youtube_videos.html.twig') {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AmulenMediaBundle:Media')->findBy(array("mediaType" => "type_video_youtube"));

        $videos = array();
        foreach ($entities as $video) {
            $ytarray=explode("/", $video->getPath());
            $ytendstring=end($ytarray);
            $ytendarray=explode("?v=", $ytendstring);
            $ytendstring=end($ytendarray);
            $ytendarray=explode("&", $ytendstring);
            $ytcode=$ytendarray[0];

            $videos[] = array(
                "name" => $video->getName(),
                "code" => $ytcode,
            );
        }
        return $this->render(
            $template, array('videos' => $videos)
        );
    }

}
