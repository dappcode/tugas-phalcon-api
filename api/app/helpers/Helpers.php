<?php 

class Helpers
{
    public function Curl()
    {
        $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url
            ));
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }
}