<?php
namespace soss_socy_fashion\V1\Rest\Imageupload;

class ImageuploadResourceFactory
{
    public function __invoke($services)
    {
        $mapper = $services->get('soss_socy_fashion\\V1\\Rest\\Imageupload\\ImageuploadMapper');
        return new ImageuploadResource($mapper);
    }
    
}
