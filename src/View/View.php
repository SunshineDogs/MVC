<?php

namespace View;

class View
{
    private $templatesPath;

    public function __construct(string $templatesPath)
    {
        $this->templatesPath = $templatesPath;
    }


    public function renderHtml(string $templateName, array $vars = [], array $lay = [], array $lay2 = [])
    {
        http_response_code($code);
        extract($vars);
        extract($lay);
        extract($lay2);
        echo ($code);
        ob_start();

       include $this->templatesPath . DIRECTORY_SEPARATOR . $templateName;
        $buffer = ob_get_contents();
        ob_end_clean();

        echo $buffer;

    }

}
