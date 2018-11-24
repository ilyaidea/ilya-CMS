<?php
/**
 * Summary File TraitSecurity
 *
 * Description File TraitSecurity
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 11/4/2018
 * Time: 9:18 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Common;
use Phalcon\Security;

/**
 * Trait TraitSecurity
 * @property Security $security
 */
trait TraitSecurity
{
    public function getToken(): string
    {
        if(!$this->security->getSessionToken())
            return $this->security->getToken();
        else
            return $this->security->getSessionToken();
    }
}