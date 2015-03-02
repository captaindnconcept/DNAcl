<?php

namespace DNAcl;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Description of ModuleOptionsFactory
 *
 * @author Nicolas Desprez <contact@dnconcept.fr>
 */
class ModuleOptionsFactory implements FactoryInterface {

   public function createService(ServiceLocatorInterface $serviceLocator) {
      $config = $serviceLocator->get("Config");
      return new ModuleOptions(isset($config["dn-acl"]) ? $config["dn-acl"] : []);
   }

}
