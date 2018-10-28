<?php
/**
 * Summary File ITreeMenu
 *
 * Description File ITreeMenu
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/26/2018
 * Time: 11:34 AM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Lib\TreeMenus;


interface ITreeMenu
{
    public function initialize();
    public function create();
    public function setKey($key);
    public function getKey();
    public function toArray();
}