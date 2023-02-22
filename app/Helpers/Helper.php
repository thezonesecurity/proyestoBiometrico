<?php

namespace App\Helpers;
use Carbon\Carbon;

class Helper {	
	
	/**
     * @var $string
     */
    protected $html;

    /**
     * @method __construct
     */
    public function __construct() {
        $this->html = app(HtmlBuilder::class);
    }

	/**
     * @method show
     * @param  string $route   [string]
     * @param  string $id      [string]
     * @param  string $tooltip [string]
     * @return string|html
     */
    public function show($route, $id, $tooltip) {
        return $this->html->toHtmlString('<a href="'. route($route, hashid_encode($id)).'" class="btn btn-info-outline btn-sm" style="float-left" title="'.$tooltip.'"><i class="fa fa-search-plus"></i></a>');
    }

    public function btn_consulta($route, $hc, $numero) {
        return $this->html->toHtmlString('<a href="'. route($route, array('hc'=>hashid_encode($hc),'numero'=>hashid_encode($numero))).'" class="btn btn-primary" style="float-left" title"REGISTRAR" ><i class="fa fa-search-plus"></i></a>');
    }
    public function show_bank($route, $id, $tooltip) {
        return $this->html->toHtmlString('<a href="'. route($route, hashid_encode($id)).'" target="_blank" class="btn btn-info-outline btn-sm" style="float-left" title="'.$tooltip.'"><i class="fa fa-search-plus"></i></a>');
    }

	/**
     * @method edit
     * @param  string $route   [string]
     * @param  string $id      [string]
     * @param  string $tooltip [string]
     * @return string|html
     */
    public function edit($route, $id, $tooltip) {
        return $this->html->toHtmlString('<a href="'. route($route, hashid_encode($id)).'" class="btn btn-warning-outline btn-sm" title="'.$tooltip.'" style="float:left"><i class="fa fa-pencil"></i></a>');
    }

	/**
     * @method delete
     * @param  string $route   [string]
     * @param  string $id      [string]
     * @param  string $tooltip [string]
     * @return string
     */
    public function delete($route, $id, $tooltip) {
        return $this->html->toHtmlString('<a class="btn btn-danger-outline btn-sm delete" href="#!" data-href="'.route($route, hashid_encode($id)).'" data-id="'.hashid_encode($id).'" data-token="'.csrf_token().'" title="'.$tooltip.'"><i class="fa fa-trash"></i></a>');
    }

    /**
     * @method new
     * @param  string $route   [string]
     * @param  string $tooltip [string]
     * @return string
     */
    public function new($route, $text, $tooltip) {
        return $this->html->toHtmlString('<a class="btn btn-primary-outline" id="new" href="'.route($route).'" title="'.$tooltip.'"><i class="fa fa-plus"></i> '.$text.'</a>');
    }

    /**
     * @method save
     * @param  string $route   [string]
     * @param  string $tooltip [string]
     * @return string
     */
    public function save($txt = 'GUARDAR') {
        return $this->html->toHtmlString('<button type="submit" id="save_btn" class="btn btn-primary-outline col-xs-6 col-lg-3"><i class="fa fa-save"></i> '.$txt.'</button>');
    }

    public function save_medium() {
        return $this->html->toHtmlString('<button type="submit" class="btn btn-sm btn-success-outline"><i class="fa fa-save"></i> GUARDAR</button>');
    }

    /**
     * @method update
     * @param  string $route   [string]
     * @param  string $tooltip [string]
     * @return string
     */
    public function update() {
        return $this->html->toHtmlString('<button type="submit" class="btn btn-primary-outline col-xs-6 col-lg-3"><i class="fa fa-refresh"></i> ACTUALIZAR</button>');
    }

    /**
     * @method cancel
     * @param  string $route   [string]
     * @param  string $tooltip [string]
     * @return string
     */
    public function cancel($route, $text, $tooltip) {
        return $this->html->toHtmlString('<a class="btn btn-danger-outline col-xs-6 col-lg-3" href="'.route($route).'" title="'.$tooltip.'"><i class="fa fa-times"></i> '.$text.'</a>');
    }

    public function cancel_medium($route, $text, $tooltip) {
        return $this->html->toHtmlString('<a class="btn btn-danger-outline btn-sm" href="'.route($route).'" title="'.$tooltip.'"><i class="fa fa-times"></i> '.$text.'</a>');
    }

    /**
     * @method modal
     * @param  string $target   [string]
     * @param  string $id      [string]
     * @param  string $tooltip [string]
     * @return string | html
     */
    public function modal($target, $id, $class, $icon, $tooltip, $txt) {
        $value = strlen($txt)>0?' '.$txt:'';
        return $this->html->toHtmlString('<button type="button" class="'.$class.'" data-toggle="modal" data-target="#'.$target.'" data-id="'.hashid_encode($id).'" title="'.$tooltip.'"><i class="fa '.$icon.'"></i>'.$value.'</button>');
    }

    /**
     * @method back
     * @param  string $route
     * @return string | html
     */
    public function back($route, $tooltip) {
        return $this->html->toHtmlString('<a href="'.route($route).'" class="btn btn-danger-outline" title="'.$tooltip.'"><i class="fa fa-arrow-left"></i></a>');
    }

    /**
     * @method print
     * @param  string $route
     * @return string | html
     */
    public function print($route, $tooltip) {
        return $this->html->toHtmlString('<a href="'.$route.'" target="_blank" class="btn btn-info-outline" title="'.$tooltip.'"><i class="fa fa-print"></i></a>');
    }

    /**
     * @method dateString
     * @param  \Carbon\Carbon     $d
     * @return string
     */
    public function daterer($date)
    {
        $date = explode('-', explode(' ', $date)[0]);
        /*if($date[1]==1){
            $mes=12;
            $anio=$date[0]-1;
        }else{
            $mes=$date[1]-1;
            $anio=$date[0];
        }*/
        return $this->month($date[1]) .' del '. $date[0];
    }

    public function daterercomplet($date)
    {
        $date = explode('-', explode(' ', $date)[0]);

        return $date[2].' de '.$this->month($date[1]) .' del '. $date[0];
    }

    public function dateString($d) {
        return $d->day.' de '.$this->month($d->month).', '.$d->year;
    }

    /**
     * @method month
     * @param  integer $number
     * @return string
     */
    private function month($number) {
        switch ($number) {
            case '1': return 'Enero';
            case '2': return 'Febrero';
            case '3': return 'Marzo';
            case '4': return 'Abril';
            case '5': return 'Mayo';
            case '6': return 'Junio';
            case '7': return 'Julio';
            case '8': return 'Agosto';
            case '9': return 'Septiembre';
            case '10': return 'Octubre';
            case '11': return 'Noviembre';
            case '12': return 'Diciembre';
            default: return 'Enero';
        }
    }

    /**
     * @method getMonth
     * @param  string   $number
     * @return string
     */
    public function getMonth($number) {
        return strtoupper($this->month($number));
    }

    /**
     * @method filesize
     * @param  integer   $bytes
     * @param  integer  $decimals
     * @return string
     */
    public function humanfilesize($bytes, $decimals = 2) {
        $size = array('B','KB','MB','GB','TB','PB','EB','ZB','YB');
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .' '. @$size[$factor];
    }

    /**
     * ENCRYPT ALGORITHM
     */
    
    function encrypt_3DES($txt) {

        $hex = ceil(strlen($txt) / 8) * 8;
        return substr(openssl_encrypt($txt . str_repeat("\0", $hex - strlen($txt)), 'des-ede3-cbc', config('seguce92.laravel-hashid.alphabet'), OPENSSL_RAW_DATA, "\0\0\0\0\0\0\0\0"), 0, $hex);
    }

    /**
     * AES DES ENCRYPT METHOD
     * ====================
     */
    const METHOD = 'aes-256-cbc';
    private $pbkdfBase = '';
    private $pbkdfExtra = '';
    private $pbkdfExtracount = 0;
    private $pbkdfHashno = 0;
    private $pbkdfState = 0;
    private $iterations = 100;

    /**
     * @method reset
     */
    public function reset()
    {
        $this->pbkdfBase = '';
        $this->pbkdfExtra = '';
        $this->pbkdfExtracount = 0;
        $this->pbkdfHashno = 0;
        $this->pbkdfState = 0;
    }

    /**
     * @method decrypt
     * @param  string  $text
     * @return string
     */
    public function decrypt($text) {   
        $setting = \App\Models\Core\Configuracion::where('clave', 'key-hash')->first();
        $key = $setting!=null?$setting->valor:config('seguce92.laravel-hash.alphabet');
        $this->reset();
        $salt = (string) mb_strlen($key);
        $key = $this->pbkdf1($key, $salt, 32);
        $iv = $this->pbkdf1($key, $salt, 16);
        $decrypted = openssl_decrypt(base64_decode($text), self::METHOD, $key, OPENSSL_RAW_DATA, $iv);
        
        return mb_convert_encoding($decrypted, 'UTF-8', 'UTF-16LE');
    }

    /**
     * @method encrypt
     * @param  string  $txt
     * @return string
     */
    public function encrypt($text) {
        $setting = \App\Models\Core\Configuracion::where('clave', 'key-hash')->first();
        $key = $setting!=null?$setting->valor:config('seguce92.laravel-hash.alphabet');
        $this->reset();
        $salt = (string) mb_strlen($key);
        $key = $this->pbkdf1($key, $salt, 32);
        $iv = $this->pbkdf1($key, $salt, 16);
        $textUTF = mb_convert_encoding($text, 'UTF-16LE');
        $encrypted = openssl_encrypt($textUTF, self::METHOD, $key, OPENSSL_RAW_DATA, $iv);

        return base64_encode($encrypted);
    }
    /**
     * @method pbkdf1
     * @param  string $pass
     * @param  string $salt
     * @param  integer $countBytes
     * @return string
     */
    private function pbkdf1($pass, $salt, $countBytes) {
        if ($this->pbkdfState == 0) {
            $this->pbkdfHashno = 0;
            $this->pbkdfState = 1;
            $key = $pass . $salt;
            $this->pbkdfBase = sha1($key, true);
            for ($i = 2; $i < $this->iterations; $i++) {
                $this->pbkdfBase = sha1($this->pbkdfBase, true);
            }
        }
        $result = '';
        if ($this->pbkdfExtracount > 0) {
            $rlen = strlen($this->pbkdfExtra) - $this->pbkdfExtracount;
            if ($rlen >= $countBytes) {
                $result = substr($this->pbkdfExtra, $this->pbkdfExtracount, $countBytes);
                if ($rlen > $countBytes) {
                    $this->pbkdfExtracount += $countBytes;
                } else {
                    $this->pbkdfExtra = null;
                    $this->pbkdfExtracount = 0;
                }
                return $result;
            }
            $result = substr($this->pbkdfExtra, $rlen, $rlen);
        }
        $current = '';
        $clen = 0;
        $remain = $countBytes - strlen($result);
        while ($remain > $clen) {
            if ($this->pbkdfHashno == 0) {
                $current = sha1($this->pbkdfBase, true);
            } else if ($this->pbkdfHashno < 1000) {
                $num = sprintf('%d', $this->pbkdfHashno);
                $tmp = $num . $this->pbkdfBase;
                $current .= sha1($tmp, true);
            }
            $this->pbkdfHashno++;
            $clen = strlen($current);
        }
        $result .= substr($current, 0, $remain);
        if($clen > $remain) {
            $this->pbkdfExtra = $current;
            $this->pbkdfExtracount = $remain;
        }
        return $result;
    }

    /**
     * @method str_replace_laste
     * @param  string            $search
     * @param  string            $replace
     * @param  string            $str
     * @return string
     */
    public function str_replace_laste($search , $replace , $str) {
        if(($pos = strrpos($str, $search)) !== false) {
            $search_length  = strlen($search);
            $str = substr_replace($str, $replace, $pos, $search_length);
        }
        return $str;
    }

    /**
     * @method trim_alle
     * @param  string    $str
     * @param  string    $what
     * @param  string    $with
     * @return string
     */
    public function trim_alle($str, $what = NULL, $with = ' ') {
        if($what === NULL) {
            $what = "\\x00-\\x20";
        }
        return trim(preg_replace("/[".$what."]+/", $with, $str), $what);
    }

    /**
     * @method number_to_word
     * @param  integer         $num
     * @return string
     */
    public function number_to_word($num) {
        if(ctype_digit($num)) {
            $words  = array( );
            $num    = str_replace(array(',' ,' ' ), '', trim($num));
            $list1  = array('','un','dos','tres','cuatro','cinco','seis','siete','ocho','nueve','diez','once','doce','trece','catorce','quince','dieciseis','diecisiete','dieciocho','diecinueve','veinte', 'veintiun', 'veintidos','veintitres', 'veinticuatro', 'veinticinco', 'veintiseis','veintisiete', 'veintiocho', 'veintinueve');
            $list2  = array('','diez','veinte','treinta','cuarenta','cincuenta','sesenta','setenta','ochenta','noventa','cien');
            $list3  = array('','mil','millón','mil','billón','mil','trillón','mil','cuatrillón','mil','quintillion','mil','sextillion','mil','septillion','mil','octillion','mil','nonillion','mil','decillion','mil','undecillion','mil','duodecillion','mil','tredecillion','mil','quattuordecillion','mil','quindecillion','mil', 'sexdecillion','mil', 'septendecillion','mil','octodecillion','mil', 'novemdecillion','mil', 'vigintillion');
            $list4  = array('', 'ciento', 'doscientos', 'trescientos', 'cuatrocientos','quinientos', 'seicientos', 'setecientos', 'ochocientos','novecientos');
            $list5  = array('','mil','millónes','mil','billónes','mil','trillónes','mil','cuatrillónes','mil','quintilliones','mil','sextilliones','mil','septilliones','mil','octilliones','mil','nonilliones','mil','decilliones','mil','undecilliones','mil','duodecilliones','mil','tredecilliones','mil','quattuordecilliones','mil','quindecilliones','mil', 'sexdecilliones','mil', 'septendecilliones','mil','octodecilliones','mil', 'novemdecilliones','mil', 'vigintilliones');
            $num_length = strlen($num);
            $levels = (int) (($num_length + 2) / 3);
            $max_length = $levels * 3;
            $num = substr('00'.$num, -$max_length);
            $num_levels = str_split($num, 3);
            $contadorcont = 0;
            foreach($num_levels as $num_part) {
                $levels--;
                $contadorcont++;
                $hundreds = (int) ($num_part / 100);
                $hundreds = ($hundreds ? ' ' . ((int)$num_part == 100 ? 'Cien' : $list4[$hundreds]).' ' : '');
                $tens     = (int) ($num_part % 100);
                $singles  = '';
                if($tens < 30) { $tens = ($tens ? ' ' . ((($tens==1) && ($levels==1 || $levels==3))? '' : $list1[$tens]) . ' ' : '');
                } else {
                    $tens = (int) ($tens / 10);
                    $tens = ' ' . $list2[$tens] . ' ';
                    $singles = (int) ($num_part % 10);
                    if($singles > 0) $singles = ', ' . $list1[$singles] . ' ';
                    else $singles ='';
                }
                if(($levels>2) && (!((int)($num_levels[$contadorcont]))) && (!((int)($num_part))))
                    $words[] = $hundreds . $tens . $singles . (($levels && (int)($num_part)) ? ' '.((((int)($num_part))>1)? $list5[$levels] : $list3[$levels]).' '.$list5[$levels-1].' ' : '' );
                else $words[] = $hundreds . $tens . $singles . (($levels && (int)($num_part)) ? ' '.((((int)($num_part)) > 1)? $list5[$levels] : $list3[$levels]).' ' : '');  
            }
            $commas = count($words);
            if($commas > 1) { $commas = $commas - 1; }
            $words  = implode(' ' , $words);
            $words  = trim( str_replace(' ,', ',', $this->trim_alle($words)), ', ');
            if($commas) { $words = str_replace(',', ' y', $words); }
            return $words;
        }
        else if(!((int)$num)) { return 'Cero'; }
        return '';
    }

    /**
     * @method changeDescription
     * @param  string            $string
     * @return string
     */
    public function changeDescription($string) {
        if(str_contains($string, 'Listar')) return 'Listar';
        else if(str_contains($string, 'Crear')) return 'Crear';
        else if(str_contains($string, 'Agregar')) return 'Agregar';
        else if(str_contains($string, 'Editar')) return 'Editar';
        else if(str_contains($string, 'Eliminar')) return 'Eliminar';
        else if(str_contains($string, 'Import')) return 'Importar';
        else return $string;
    }

    /**
     * @method prepareDate
     * @param  string      $str ['YYYY-mm-dd']
     * @param  string      $type
     * @return string
     */
    public function prepareDate($str, $type = 'add') {
        $str = explode('-', $str);
        if($type === 'add')
            return \Carbon\Carbon::createFromDate($str[0], $str[1], $str[2])->addDay(1)->toDateString();
        return \Carbon\Carbon::createFromDate($str[0], $str[1], $str[2])->subDay(1)->toDateString();
    }
    public function conexion($bd){
        return sqlsrv_connect( "193.168.0.4", $connectionInfo = array( "UID"=>"sa","PWD"=>"S1af2023","Database"=>$bd));
    }
    public function fecha_texto($fecha, $fecha_registro){
        $fechaEmision = Carbon::parse($fecha);
        $fechaExpiracion = Carbon::parse($fecha_registro);
        $datetime1=date_create($fechaEmision);
        $datetime2=date_create($fechaExpiracion);
        $interval=date_diff($datetime1,$datetime2);
        $tiempo=array();
        foreach ($interval as $valor) {
            $tiempo[]=$valor;
        }
        $textoFecha=$tiempo[0].' años, '.$tiempo[1].' meses, '.$tiempo[2].' dias';
        
        return $textoFecha;
    }
    public function antiguedad($fecha, $fecha_registro){
        $fechaEmision = Carbon::parse($fecha);
        $fechaExpiracion = Carbon::parse($fecha_registro);
        $datetime1=date_create($fechaEmision);
        $datetime2=date_create($fechaExpiracion);
        $interval=date_diff($datetime1,$datetime2);
        $tiempo=array();
        foreach ($interval as $valor) {
            $tiempo[]=$valor;
        }
        $textoFecha=$tiempo[0].' años';
        
        return $textoFecha;
    }
    public function anio_mes_dia($fecha, $fecha_registro){
        $fechaEmision = Carbon::parse($fecha);
        $fechaExpiracion = Carbon::parse($fecha_registro);
        $datetime1=date_create($fechaEmision);
        $datetime2=date_create($fechaExpiracion);
        $interval=date_diff($datetime1,$datetime2);
        $tiempo=array();
        foreach ($interval as $valor) {
            $tiempo[]=$valor;
        }
        return $tiempo;
    }
    public function rango($fecha, $fecha_registro){
        $fechaEmision = Carbon::parse($fecha);
        $fechaExpiracion = Carbon::parse($fecha_registro);
        $datetime1=date_create($fechaEmision);
        $datetime2=date_create($fechaExpiracion);
        
        $interval=date_diff($datetime1,$datetime2);
        $tiempo=array();
        foreach ($interval as $valor) {
            $tiempo[]=$valor;
        }
        $textoFecha=$tiempo[0].' años, '.$tiempo[1].' meses, '.$tiempo[2].' dias';
        $dias = $fechaExpiracion->diffInDays($fechaEmision);
        switch($dias) {
            case $dias>0&&$dias<=28:
            $textoRango= 'NEUNATO';
            break;
            case $dias>=28&&$dias<365:
            $textoRango= '< 1 año';
            break;
            case $dias>=365&&$dias<1826:
            $textoRango= '1 - 4 años';
            break;
            case $dias>=1826&&$dias<3652:
            $textoRango= '5 - 9 años';
            break;
            case $dias>=3652&&$dias<7305:
            $textoRango= '10 - 19 años';
            break;
            case $dias>=7305&&$dias<12784:
            $textoRango= '20 - 34';
            break;
            case $dias>=12784&&$dias<18262:
            $textoRango= '35 - 49 años';
            break;
            case $dias>=18262&&$dias<23741:
            $textoRango= '50 - 64 años';
            break;
            case $dias>=23741:
            $textoRango= '> 64';
            break;
            default:
            $textoRango= 'Espere....';
        }
        return $textoRango;
    }
    public function rango_id($fecha, $fecha_registro){
        $fechaEmision = Carbon::parse($fecha);
        $fechaExpiracion = Carbon::parse($fecha_registro);
        $datetime1=date_create($fechaEmision);
        $datetime2=date_create($fechaExpiracion);
        
        $interval=date_diff($datetime1,$datetime2);
        $tiempo=array();
        foreach ($interval as $valor) {
            $tiempo[]=$valor;
        }
        $dias = $fechaExpiracion->diffInDays($fechaEmision);
        switch($dias) {
            case $dias>0&&$dias<=28:
            $id_rango= 1;
            break;
            case $dias>=28&&$dias<365:
            $id_rango= 2;
            break;
            case $dias>=365&&$dias<1826:
            $id_rango= 3;
            break;
            case $dias>=1826&&$dias<3652:
            $id_rango= 4;
            break;
            case $dias>=3652&&$dias<7305:
            $id_rango= 5;
            break;
            case $dias>=7305&&$dias<12784:
            $id_rango= 6;
            break;
            case $dias>=12784&&$dias<18262:
            $id_rango= 7;
            break;
            case $dias>=18262&&$dias<23741:
            $id_rango= 8;
            break;
            case $dias>=23741:
            $id_rango= 9;
            break;
            default:
            $id_rango= 'Espere....';
        }
        return $id_rango;
    }

    public function count_days($fecha_inicio,$fecha_fin){
            $start =Carbon::parse($fecha_inicio);
            $end =Carbon::parse($fecha_fin)->addDay(1)->format('Y-m-d');

            $days=$start->diffInDays($end);
            if ($days<100) {
                for ($i=1; $i < $days+1; $i++) { 
                    $start=\Carbon\Carbon::parse($start)->addDay(1)->format('Y-m-d');
                    if (date("w", strtotime($start))==0) {//si domingo
                        $days--;
                    }
                    if (date("w", strtotime($start))==6) {// si es sabado
                        $days--;
                    }
                }
            }
            else{
                $days='error fechas';
            }
            return $days;
    }
}