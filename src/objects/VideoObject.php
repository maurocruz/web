<?php

namespace Plinct\Web\Object;

class VideoObject 
{
    public function __invoke($array)
    {
        $array['attributes']['src'] = $array['src'];
        $array['attributes']['autoplay'] = true;
        $array['attributes']['controls'] = true;
        return [ "tag" => "video", "attributes" => $array['attributes'] ];
    }
}
