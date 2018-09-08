<?php
/**
 * Summary File Form
 *
 * Description File Form
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 8/12/2018
 * Time: 1:50 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Lib\Forms;

class Form extends \Phalcon\Forms\Form
{
    public function __construct ( $entity = null, array $userOptions = null )
    {
        parent::__construct( $entity, $userOptions );
    }


}