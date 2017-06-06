<?php
namespace soss_socy_fashion\V1\Rest\Theme;

class ThemeResourceFactory
{
    public function __invoke($services)
    {
        $mapper = $services->get('soss_socy_fashion\\V1\\Rest\\Theme\\ThemeMapper');
        return new ThemeResource($mapper);
    }
}
