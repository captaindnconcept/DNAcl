<?php

use DNAcl\Acl;

/**
 * Description of AclTest
 *
 * @author Nicolas Desprez <contact@dnconcept.fr>
 */
class AclTest extends PHPUnit_Framework_TestCase {

   /** @var Acl */
   private $acl;

   protected function setUp() {
      $this->acl = new Acl(
              [
          "guest" => null,
          "member" => "guest",
          "admin" => "member",
              ]
              , [
          'allow' => [
              "ControllerGuest" => ["all" => "guest"],
              "ControllerAdmin" => ["all" => "admin"],
              "ControllerMember" => ["all" => "member", "login" => "guest"],
              "ControllerOnlyGuest" => ["all" => "guest"],
          ],
          "deny" => [
              "ControllerOnlyGuest" => ["all" => "member"],
          ]
              ]
      );
   }

   public function testAclList() {
      $acl = $this->acl;
      $this->assertTrue($acl->hasRole("admin"));
      $this->assertTrue($acl->hasRole("guest"));
      $this->assertTrue($acl->hasRole("member"));

      $this->assertTrue($acl->hasResource("ControllerGuest"));

      $this->assertTrue($acl->isAllowed("admin", "ControllerGuest", "index"));
      $this->assertTrue($acl->isAllowed("member", "ControllerGuest"));
      $this->assertTrue($acl->isAllowed("guest", "ControllerGuest"));

      $this->assertTrue($acl->isAllowed("guest", "ControllerOnlyGuest"));
      $this->assertFalse($acl->isAllowed("admin", "ControllerOnlyGuest"));
      $this->assertFalse($acl->isAllowed("member", "ControllerOnlyGuest"));

      $this->assertFalse($acl->isAllowed("guest", "ControllerMember"));
      $this->assertFalse($acl->isAllowed("guest", "ControllerMember", "index"));
      $this->assertTrue($acl->isAllowed("guest", "ControllerMember", "login"));
      $this->assertTrue($acl->isAllowed("admin", "ControllerMember"));
      $this->assertTrue($acl->isAllowed("member", "ControllerMember"));
   }

}
