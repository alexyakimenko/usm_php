<?php

namespace App\Core;

class Template
{
   /**
    * Renders a template with the provided data.
    *
    * @param string $template The name of the template to render.
    * @param array $data The data to be extracted and used in the template.
    * @return void
    */
   public static function render(string $template, array $data = []): void {
       ob_start();
       extract($data);
       require sprintf("%s/pages/$template.php", Config::templateDir);
       $content = ob_get_clean();

       require sprintf("%s/layouts/default.layout.php", Config::templateDir);
   }
}