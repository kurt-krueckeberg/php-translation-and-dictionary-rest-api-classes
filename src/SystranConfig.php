<?php
declare(strict_types=1);
namespace LanguageTools;

class SystranConfig {
 /*
   Client ID: HJ4lFfM7gBmTbYJj0BNO5
   Client Secret: mGsJki6GLCJfPS7c1U861cC_hrLJVGoSW-EPHrnb_sQpJfY9n4wjo_jQjY_Jk3_8dxCJcPemHx_NF4Syzf77-w
  */
  public function __construct(public readonly string $endpoint = "", 
      public readonly array $header = array('HJ4lFfM7gBmTbYJj0BNO5' => 'mGsJki6GLCJfPS7c1U861cC_hrLJVGoSW-EPHrnb_sQpJfY9n4wjo_jQjY_Jk3_8dxCJcPemHx_NF4Syzf77-w')) {}
}
