<?php
/**
 * Summary File Title
 *
 * Description File Title
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 11/5/2018
 * Time: 9:34 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\Forms;


use Phalcon\Mvc\User\Component;

class Validate extends Component
{
    /** @var Form $form */
    private $form;
    /** @var string $ok */
    private $ok = null;
    /** @var string $error */
    private $error = null;

    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    /**
     * @return bool
     */
    public function isOk(): bool
    {
        if($this->request->isPost() && $this->request->getPost('action') !== null)
        {
            if($this->security->checkHash(get_class($this->form), $this->request->getPost('action')))
            {
                if($this->form->isValid($this->request->getPost()))
                {
                    return true;
                }
            }
        }
//        if($this->ok !== null)
//            return true;

        return false;
    }

    /**
     * @param string $message
     */
    public function setOkMsg( string $message ): void
    {
        $this->error = null;
        $this->ok = $message;
    }

    public function getOkMsg()
    {
        if($this->isOk())
        {
            return $this->ok;
        }
        return null;
    }

    /**
     * @return bool
     */
    public function hasError(): bool
    {
        if(!is_null($this->error))
            return true;

        return false;
    }

    /**
     * @param string $message
     */
    public function setErrorMsg( string $message ): void
    {
        $this->ok = null;
        $this->error = $message;
    }

    public function getErrorMsg()
    {
        if($this->hasError())
        {
            return $this->error;
        }
        return null;
    }
}