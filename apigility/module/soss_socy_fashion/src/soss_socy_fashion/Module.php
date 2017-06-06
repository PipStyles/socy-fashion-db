<?php
namespace soss_socy_fashion;

use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements ApigilityProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'ZF\Apigility\Autoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
      return array(
        'factories' => array(
          'soss_socy_fashion\\V1\\Rest\\Encounter\\EncounterMapper' =>  function ($sm) {
            $adapter = $sm->get('Zend\Db\Adapter\Adapter');
            return new \soss_socy_fashion\V1\Rest\Encounter\EncounterMapper($adapter);
          },

          'soss_socy_fashion\\V1\\Rest\\Theme\\ThemeMapper' =>  function ($sm) {
            $adapter = $sm->get('Zend\Db\Adapter\Adapter');
            return new \soss_socy_fashion\V1\Rest\Theme\ThemeMapper($adapter);
          },

         'soss_socy_fashion\\V1\\Rest\\Imageupload\\ImageuploadMapper' =>  function ($sm) {
            $adapter = $sm->get('Zend\Db\Adapter\Adapter');
            return new \soss_socy_fashion\V1\Rest\Imageupload\ImageuploadMapper($adapter);
          },

        'soss_socy_fashion\\V1\\Rest\\Image\\ImageMapper' =>  function ($sm) {
            $adapter = $sm->get('Zend\Db\Adapter\Adapter');
            return new \soss_socy_fashion\V1\Rest\Image\ImageMapper($adapter);
          },

        ),
      );
    }


}
