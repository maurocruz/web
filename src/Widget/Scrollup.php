<?php

namespace Plinct\Web\Widget;

/**
 * Scrollup
 *
 * @author Mauro Cruz <maurocruz@pirenopolis.tur.br>
 */
class Scrollup 
{
    public function addButton()
    {
        $content[] = [ "tag" => "script", "content" => <<<EOT
// MOSTRA O BOTÃO AO ROLAR A PÁGINA
window.onscroll = function() {
    scrollFunction()
};
// ESCONDE O BOTÃO AO CHEGAR PRÓXIMO AO TOPO
function scrollFunction() {
    if (document.body.scrollTop > 320 || document.documentElement.scrollTop > 320) {
        document.getElementById("button-scrollup").style.display = "block";
    } else {
        document.getElementById("button-scrollup").style.display = "none";
    }
}
// ROLA A PÁGINA PARA O TOPO
function goTop() {
    document.body.scrollTop = 0; // For Chrome, Safari and Opera 
    document.documentElement.scrollTop = 0; // For IE and Firefox
}
EOT
        ];
        
        $content[] = [ "tag" => "img", "attributes" => [ "id" => "button-scrollup", "src" => "https://pirenopolis.tur.br/fwcSrc/images/scroll-up.png", "onclick" => "goTop();", "title" => "Subir!", "style" => "display: none; position: fixed; bottom: 20px; right: 20px; line-height: 0; cursor: pointer; width: 40px;" ] ];
        
        return [ "tag" => "div", "attributes" => [ "class" => "scrollup" ], "content" => $content ];
    }
}