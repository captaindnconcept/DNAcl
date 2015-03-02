<?php

namespace DNAcl;

/**
 * Description of ModuleOptions
 *
 * @author Nicolas Desprez <contact@dnconcept.fr>
 */
class ModuleOptions extends \Zend\Stdlib\AbstractOptions {

   /** @var array    Roles */
   private $roles = array();

   /** @var array    Resources */
   private $resources = array();

   public function setResources($resources) {
      $this->resources = $resources;
      return $this;
   }

   public function getResources() {
      return $this->resources;
   }

   public function getRoles() {
      return $this->roles;
   }

   public function setRoles($roles) {
      $this->roles = $roles;
      return $this;
   }

}
