<?php

namespace mf\utils;
class ClassLoader extends AbstractClassLoader{

    public function __construct($file_root)
    {
        parent::__construct($file_root);
    }

    public function loadClass(string $classname){
        $filename = $this->getFilename($classname);
        $path = $this->makePath($filename);
        if(file_exists($path)){
            require_once $path;
        }
    }

    public function makePath(string $filename): string{
        return $this->prefix.DIRECTORY_SEPARATOR.$filename;
    }

    public function getFilename(string $classname): string{
        $chem = str_replace("\\", DIRECTORY_SEPARATOR, $classname);
        $chemtot = $chem.".php";
        return $chemtot;
    }
}