<?php
namespace Lib\Bootstrap;


interface IBootstrap
{
    public function run();
    public function registerAutoLoaders();
}