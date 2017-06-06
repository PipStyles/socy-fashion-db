<?php
namespace soss_socy_fashion\V1\Rest\Image;

class ImageResourceFactory
{
    public function __invoke($services)
    {
        $mapper = $services->get('soss_socy_fashion\\V1\\Rest\\Image\\ImageMapper');
        return new ImageResource($mapper);
    }
}
