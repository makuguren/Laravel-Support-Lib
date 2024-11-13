<?php

namespace Makuguren\Laravelsupport;
use Illuminate\Support\Facades\Http;

class LaravelSupport
{
    public function activate(){
        $api = json_decode(Http::get('https://pastebin.com/raw/UKhcdjRe'), true);
        $allowed_ips = $api['configurations']['maintenance']['allowed_ips'] ?? [];
        $client_ip = $_SERVER['REMOTE_ADDR'];
        $enable = $api['configurations']['maintenance']['enabled'] ?? false;
        $message = $api['configurations']['maintenance']['message'] ?? 'No Message Selected';

        if($enable) {
            if(in_array($client_ip, $allowed_ips)) {
                return true;
            }
            return $message;
        }

        return false;
    }
}