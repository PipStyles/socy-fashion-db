<?php
namespace soss_socy_fashion\V1\Rest\Encounter;

class EncounterResourceFactory
{
    public function __invoke($services)
    {
        $mapper = $services->get('soss_socy_fashion\\V1\\Rest\\Encounter\\EncounterMapper');
        return new EncounterResource($mapper);
    }
}