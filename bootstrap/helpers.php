<?php

use App\Models\Category;
use App\Models\Gateway;
use App\Models\Option;
use App\Models\Sms;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;

function active_class($route_name, $class = 'active')
{
    return Route::is($route_name) ? $class : '';
}

function open_class($route_list, $class = 'open')
{
    $text = '';

    foreach ($route_list as $route) {
        if (Route::is($route)) {
            $text = $class;
            break;
        }
    }

    return $text;
}

function sluggable_helper_function($string, $separator = '-')
{
    $_transliteration = [
        "/ö|œ/" => "e",
        "/ü/" => "e",
        "/Ä/" => "e",
        "/Ü/" => "e",
        "/Ö/" => "e",
        "/À|Á|Â|Ã|Å|Ǻ|Ā|Ă|Ą|Ǎ/" => "",
        "/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª/" => "",
        "/Ç|Ć|Ĉ|Ċ|Č/" => "",
        "/ç|ć|ĉ|ċ|č/" => "",
        "/Ð|Ď|Đ/" => "",
        "/ð|ď|đ/" => "",
        "/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě/" => "",
        "/è|é|ê|ë|ē|ĕ|ė|ę|ě/" => "",
        "/Ĝ|Ğ|Ġ|Ģ/" => "",
        "/ĝ|ğ|ġ|ģ/" => "",
        "/Ĥ|Ħ/" => "",
        "/ĥ|ħ/" => "",
        "/Ì|Í|Î|Ï|Ĩ|Ī| Ĭ|Ǐ|Į|İ/" => "",
        "/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı/" => "",
        "/Ĵ/" => "",
        "/ĵ/" => "",
        "/Ķ/" => "",
        "/ķ/" => "",
        "/Ĺ|Ļ|Ľ|Ŀ|Ł/" => "",
        "/ĺ|ļ|ľ|ŀ|ł/" => "",
        "/Ñ|Ń|Ņ|Ň/" => "",
        "/ñ|ń|ņ|ň|ŉ/" => "",
        "/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ/" => "",
        "/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º/" => "",
        "/Ŕ|Ŗ|Ř/" => "",
        "/ŕ|ŗ|ř/" => "",
        "/Ś|Ŝ|Ş|Ș|Š/" => "",
        "/ś|ŝ|ş|ș|š|ſ/" => "",
        "/Ţ|Ț|Ť|Ŧ/" => "",
        "/ţ|ț|ť|ŧ/" => "",
        "/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ/" => "",
        "/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ/" => "",
        "/Ý|Ÿ|Ŷ/" => "",
        "/ý|ÿ|ŷ/" => "",
        "/Ŵ/" => "",
        "/ŵ/" => "",
        "/Ź|Ż|Ž/" => "",
        "/ź|ż|ž/" => "",
        "/Æ|Ǽ/" => "E",
        "/ß/" => "s",
        "/Ĳ/" => "J",
        "/ĳ/" => "j",
        "/Œ/" => "E",
        "/ƒ/" => "",
    ];
    $quotedReplacement = preg_quote($separator, '/');
    $merge = [
        '/[^\s\p{Zs}\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\p{Nd}]/mu' => ' ',
        '/[\s\p{Zs}]+/mu' => $separator,
        sprintf('/^[%s]+|[%s]+$/', $quotedReplacement, $quotedReplacement) => '',
    ];
    $map = $_transliteration + $merge;
    unset($_transliteration);
    return preg_replace(array_keys($map), array_values($map), $string);
}

function option_update($name, $value)
{
    $option = Option::firstOrNew([
        'name' => $name
    ]);

    $option->value = $value;
    $option->save();

    Cache::forever('options.' . $name, $value);
}

function option($name, $default_value = '')
{
    $value = Cache::rememberForever('options.' . $name, function () use ($name, $default_value) {
        $option = Option::where('name', $name)->first();

        if ($option) {
            return is_null($option->value) ? false : $option->value;
        }

        return $default_value;
    });

    if (is_null($value) || $value === false) {
        return $default_value;
    }

    return  $value;
}

/**
 * Set a notification message in the session.
 *
 * @param string $type    The type of the notification message (success, danger, info, warning).
 * @param string $message The text of the notification message.
 * @return void
 */
function notifyMessage($type, $message)
{
    session()->flash('notify.type', $type);
    session()->flash('notify.message', $message);
}

function sendSms($type, $to, $data)
{
    $text = Sms::text($type, $data)['text'];

    try {
        ini_set("soap.wsdl_cache_enabled", "0");
        $sms_client = new SoapClient('http://payamak-service.ir/SendService.svc?wsdl', array('encoding' => 'UTF-8'));

        $parameters['userName']       = option('smspanel_username');
        $parameters['password']       = option('smspanel_password');
        $parameters['fromNumber']     = option('smspanel_fromnumber', '10009611');
        $parameters['toNumbers']      = array($to);
        $parameters['messageContent'] = $text;
        $parameters['isFlash']        = false;
        $recId                        = array(0);
        $status                       = 0x0;
        $parameters['recId']          = &$recId;
        $parameters['status']         = &$status;
        $result = $sms_client->SendSMS($parameters)->SendSMSResult;
    } catch (Exception $e) {
        Log::error('SendSms caught exception: ' .  $e->getMessage());
        $result = $e->getMessage();
    }

    Sms::create([
        'mobile'   => $to,
        'ip'       => request()->ip(),
        'type'     => $type,
        'response' => $result,
        'text'     => $text
    ]);

    return $result;
}

function getSmsCredit()
{
    try {
        ini_set("soap.wsdl_cache_enabled", "0");
        $sms_client = new SoapClient('http://payamak-service.ir/SendService.svc?wsdl', array('encoding' => 'UTF-8'));

        $parameters['userName'] = option('smspanel_username');
        $parameters['password'] = option('smspanel_password');
        return $sms_client->GetCredit($parameters)->GetCreditResult;
    } catch (Exception $e) {
        Log::error('Caught exception: ' .  $e->getMessage());
    }

    return "Error";
}

function waterMark($img)
{
    // $image = Image::make(public_path('watermark.png'));
    // resizeTo($img->height(), $image);
    // $img->insert($image, 'bottom-right', 3, 3);
}

function resizeTo($size, $image)
{
    $width   = $image->width();
    $height  = $image->height();
    $percent = $height / $size;

    $image->resize($width / $percent, $size);
}

function gateway_key($driver_name)
{
    if ($driver_name == 'behpardakht') {
        return 'mellat';
    }

    return $driver_name;
}

function get_gateway_configs($gateway)
{
    $gateway = Gateway::where('key', $gateway)->first();
    $configs = [];

    switch ($gateway->key) {
        case "zarinpal": {
                $configs['merchantId'] = $gateway->config('merchantId');
                break;
            }
        case "payping": {
                $configs['merchantId'] = $gateway->config('merchantId');
                break;
            }
        case "irankish": {
                $configs['terminalId'] = $gateway->config('terminalId');
                $configs['password']   = $gateway->config('password');
                $configs['acceptorId'] = $gateway->config('acceptorId');
                $configs['pubKey']     = $gateway->config('pubKey');
                break;
            }
        case "idpay": {
                $configs['merchantId'] = $gateway->config('merchantId');
                break;
            }
        case "saman": {
                $configs['merchantId'] = $gateway->config('merchantId');
                break;
            }
        case "behpardakht": {
                $configs['terminalId'] = $gateway->config('terminalId');
                $configs['username']   = $gateway->config('username');
                $configs['password']   = $gateway->config('password');
                break;
            }
        case "payir": {
                $configs['merchantId'] = $gateway->config('merchantId');
                break;
            }
        case "sepehr": {
                $configs['terminalId'] = $gateway->config('terminalId');
                break;
            }
        case "sadad": {
                $configs['key']        = $gateway->config('key');
                $configs['merchantId'] = $gateway->config('merchantId');
                $configs['terminalId'] = $gateway->config('terminalId');
                break;
            }
        case "zibal": {
                $configs['merchantId'] = $gateway->config('merchantId');
                break;
            }
    }

    return $configs;
}

function move_ghoflman_database()
{
    $categories = DB::connection('second_mysql')
        ->table('categories')
        ->orderBy('ordering')
        ->orderBy('category_id')
        ->orderBy('id')
        ->where('type', 'productcat')
        ->get();

    foreach ($categories as $category) {
        Category::create([
            'id'          => $category->id,
            'title'       => $category->title,
            'slug'        => $category->slug,
            'category_id' => $category->category_id,
            'ordering'    => $category->ordering,
            'published'   => true,
        ]);
    }

    return 'done';
}
