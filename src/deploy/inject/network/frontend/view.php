<?php
use App\Helpers\FileHelper;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;

$view = new View();
$view->setViewsDir(SRC_PATH .'/templates/frontend/views/');
$view->setLayoutsDir('../layouts/');
$view->setPartialsDir('../partials/');
$view->setTemplateAfter('after/main');

$view->registerEngines(array(
    ".volt" => function($view, $di){

        $compiledPath = RUNTIME_PATH . "/volt/frontend";
        $fileHelper = FileHelper::getInstance();
        $fileHelper->createDir($compiledPath);

        $volt = new Volt($view, $di);
        $volt->setOptions(array(
            'compiledPath'  => $compiledPath,
            'compileAlways' => false
        ));
        return $volt;
    }
));
$view->disable();
return $view;