<?php 

if (! function_exists('btn_show')) {
    function btn_show($route, $id, $tooltip = 'MOSTRAR') {
        return app(\App\Helpers\Helper::class)->show($route, $id, $tooltip);
    }
}
if (! function_exists('btn_consulta')) {
    function btn_consulta($route, $hc,$numero) {
        return app(\App\Helpers\Helper::class)->btn_consulta($route, $hc,$numero);
    }
}

if (! function_exists('btn_show_bank')) {
    function btn_show_bank($route, $id, $tooltip = 'MOSTRAR') {
        return app(\App\Helpers\Helper::class)->show_bank($route, $id, $tooltip);
    }
}

if (! function_exists('btn_edit')) {
    function btn_edit($route, $id, $tooltip = 'EDITAR') {
        return app(\App\Helpers\Helper::class)->edit($route, $id, $tooltip);
    }
}

if (! function_exists('btn_delete')) {
    function btn_delete($route, $id, $tooltip = 'ELIMINAR') {
        return app(\App\Helpers\Helper::class)->delete($route, $id, $tooltip);
    }
}

if (! function_exists('btn_new')) {
    function btn_new($route, $text, $tooltip = 'NUEVO') {
        return app(\App\Helpers\Helper::class)->new($route, $text, $tooltip);
    }
}

if (! function_exists('btn_save')) {
    function btn_save($txt = 'GUARDAR') {
        return app(\App\Helpers\Helper::class)->save($txt);
    }
}

if (! function_exists('btn_update')) {
    function btn_update() {
        return app(\App\Helpers\Helper::class)->update();
    }
}

if (! function_exists('btn_cancel')) {
    function btn_cancel($route, $text = 'CANCELAR', $tooltip = 'CANCELAR') {
        return app(\App\Helpers\Helper::class)->cancel($route, $text, $tooltip);
    }
}

if (! function_exists('btn_modal')) {
    function btn_modal($target, $id, $class = 'btn btn-info-outline btn-modal', $icon = 'fa-plus', $tooltip = 'NUEVO', $txt = '') {
        return app(\App\Helpers\Helper::class)->modal($target, $id, $class, $icon, $tooltip, $txt);
    }
}

if (! function_exists('btn_back')) {
    function btn_back($route, $tooltip = 'VOLVER ATRAS') {
        return app(\App\Helpers\Helper::class)->back($route, $tooltip);
    }
}

if (! function_exists('btn_print')) {
    function btn_print($route, $tooltip = 'IMPRIMIR') {
        return app(\App\Helpers\Helper::class)->print($route, $tooltip);
    }
}

if (! function_exists('date_string')) {
    function date_string($date) {
        return app(\App\Helpers\Helper::class)->dateString($date);
    }
}

if (! function_exists('human_filesize')) {
    function human_filesize($bytes, $decimals = 2) {
        return app(\App\Helpers\Helper::class)->humanFilesize($bytes, $decimals);
    }
}

if (! function_exists('aes_crypt')) {
    function aes_crypt($txt) {
        return app(\App\Helpers\Helper::class)->encrypt($txt);
    }
}

if (! function_exists('aes_decrypt')) {
    function aes_decrypt($txt) {
        return app(\App\Helpers\Helper::class)->decrypt($txt);
    }
}

if (! function_exists('btn_cancel_medium')) {
    function btn_cancel_medium($route, $text = 'CANCELAR', $tooltip = 'CANCELAR') {
        return app(\App\Helpers\Helper::class)->cancel_medium($route, $text, $tooltip);
    }
}

if (! function_exists('btn_save_medium')) {
    function btn_save_medium() {
        return app(\App\Helpers\Helper::class)->save_medium();
    }
}
if (! function_exists('number_to_word')) {
    function number_to_word($num) {
        return app(\App\Helpers\Helper::class)->number_to_word($num);
    }
}

if (! function_exists('date_mes_string')) {
    function date_mes_string($num) {
        return app(\App\Helpers\Helper::class)->daterer($num);
    }
}
if (! function_exists('date_complit')) {
    function date_complit($num) {
        return app(\App\Helpers\Helper::class)->daterercomplet($num);
    }
}
if (! function_exists('change_string')) {
    function change_string($string) {
        return app(\App\Helpers\Helper::class)->changeDescription($string);
    }
}
if (! function_exists('prepare_date')) {
    function prepare_date($date, $type = 'add') {
        return app(\App\Helpers\Helper::class)->prepareDate($date, $type);
    }
}

if (! function_exists('month')) {
    function month($month) {
        return app(\App\Helpers\Helper::class)->getMonth($month);
    }
}
if (! function_exists('conexion')) {
    function conexion($db) {
        return app(\App\Helpers\Helper::class)->conexion($db);
    }
}
if (! function_exists('fecha_texto')) {
    function fecha_texto($fecha,$fecha_registro) {
        return app(\App\Helpers\Helper::class)->fecha_texto($fecha,$fecha_registro);
    }
}
if (! function_exists('antiguedad')) {
    function antiguedad($fecha,$fecha_registro) {
        return app(\App\Helpers\Helper::class)->antiguedad($fecha,$fecha_registro);
    }
}
if (! function_exists('anio_mes_dia')) {
    function anio_mes_dia($fecha,$fecha_registro) {
        return app(\App\Helpers\Helper::class)->anio_mes_dia($fecha,$fecha_registro);
    }
}
if (! function_exists('rango')) {
    function rango($fecha,$fecha_registro) {
        return app(\App\Helpers\Helper::class)->rango($fecha,$fecha_registro);
    }
}
if (! function_exists('rango_id')) {
    function rango_id($fecha,$fecha_registro) {
        return app(\App\Helpers\Helper::class)->rango_id($fecha,$fecha_registro);
    }
}
if (! function_exists('count_days')) {
    function count_days($fecha_inicio,$fecha_fin) {
        return app(\App\Helpers\Helper::class)->count_days($fecha_inicio,$fecha_fin);
    }
}