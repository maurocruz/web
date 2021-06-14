<?php
namespace Plinct\Web\Widget;

class FormAuthentication {

    public static function formLogin($action, $attributes = null): array {
        $attributesForm['action'] = $action;
        $attributesForm['method'] = "post";
        if ($attributes) {
            $attributesForm = array_merge($attributesForm, $attributes);
        }
        return [ "tag" => "form", "attributes" => $attributesForm, "content" => [
            [ "tag" => "h3", "content" => _("Log in") ],
            [ "tag" => "fieldset", "attributes" => [ "style" => "width: 100%;" ], "content" => [
                [ "tag" => "legend", "content" => _("Email") ],
                [ "tag" => "input", "attributes" => [ "name" => "email", "type" => "text" ] ]
            ]],
            [ "tag" => "fieldset", "attributes" => [ "style" => "width: 100%;" ], "content" => [
                [ "tag" => "legend", "content" => _("Password") ],
                [ "tag" => "input", "attributes" => [ "name" => "password", "type" => "password" ] ]
            ]],
            [ "tag" => "input", "attributes" => [ "name" => "submit", "type" => "submit", "value" => _("Send") ] ]
        ] ];
    }
}