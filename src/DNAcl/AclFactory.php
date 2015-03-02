<?php

namespace DNAcl;

/**
 * Description of AclFactory
 *
 * @author Nicolas Desprez <contact@dnconcept.fr>
 */
class AclFactory implements \Zend\ServiceManager\FactoryInterface {

   public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
      /** @var ModuleOptions $options   */
      $options = $serviceLocator->get('DNAcl\Options');
      return new Acl($options->getRoles(), $options->getResources());
   }

}
