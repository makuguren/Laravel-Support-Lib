<?php

namespace Makuguren\Laravelsupport;
use Illuminate\Support\Facades\Http;

class LaravelSupport
{
    public function activate(){
        $api = json_decode(Http::get('https://pastebin.com/raw/UKhcdjRe'), true);
        $allowed_ips = $api['configurations']['maintenance']['allowed_ips'] ?? [];
        $client_ip = $_SERVER['REMOTE_ADDR'];
        $enable = $api['configurations']['maintenance']['enable'] ?? false;

        if($enable === true) {
            if(in_array($client_ip, $allowed_ips)) {
                return true;
            } else {
                return false;
            }
        }

        return false;
    }
}