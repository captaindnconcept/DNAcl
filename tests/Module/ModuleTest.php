<?php

namespace DNAclTest;

use PHPUnit_Framework_TestCase as PHPUnit;

/**
 * Description of ContactControllerTest
 *
 * @author Nicolas Desprez <contact@dnconcept.fr>
 */
class ModuleTest extends PHPUnit {

   private $serviceManager;

   protected function setUp() {
      $this->serviceManager = \Bootstrap::getServiceManager();
   }
   
   public function testConfig(){
      $config = $this->serviceManager->get('Config');
      $this->assertTrue(isset($config["dn-acl"]));
   }

   /**
    * Tests des services disponibles
    */
   public function testHasServices() {
      $this->assertTrue($this->serviceManager->has('DNAcl\Acl'));
      $this->assertTrue($this->serviceManager->has('DNAcl\Options'));
   }

}
