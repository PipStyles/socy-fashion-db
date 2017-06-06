<?php
namespace soss_socy_fashion\V1\Rest\Me;

class MeResourceFactory
{
    public function __invoke($services)
    {
        return new MeResource();
    }
}
