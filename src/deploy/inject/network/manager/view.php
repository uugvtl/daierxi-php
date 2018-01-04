<?php
use App\Helpers\FileHelper;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;
$view = new View();
$view->setViewsDir(SRC_PATH .'/templates/manager/views/');
$view->setLayoutsDir('../layouts/');
$view->setPartialsDir('../partials/');
$view->setTemplateAfter('after/main');

$view->registerEngines(array(
    ".volt" => function($view, $di){

        $compiledDir = RUNTIME_PATH . "/volt/manager/";

        $fileHelper = FileHelper::getInstance();
        $fileHelper->createDir($compiledDir);

        $volt = new Volt($view, $di);
        $volt->setOptions(array(
            'compiledPath'  => $compiledDir,
            'compileAlways' => false
        ));
        return $volt;
    }
));
$view->disable();
return $view;