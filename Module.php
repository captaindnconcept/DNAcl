<?php

namespace DNAcl;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

/**
 * Description of DNAclModule
 * 
 * Création d'une liste d'authorisation à partir d'un fichier de configuration
 * 
 */
class Module implements AutoloaderProviderInterface {

   public function getAutoloaderConfig() {
      return [
          'Zend\Loader\StandardAutoloader' => [
              'namespaces' => [
                  __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
              ],
          ],
      ];
   }

   public function getServiceConfig() {
      return [
          'factories' => [
              'DNAcl\Acl' => 'DNAcl\AclFactory',
              'DNAcl\Options' => 'DNAcl\ModuleOptionsFactory',
          ],
      ];
   }

}
