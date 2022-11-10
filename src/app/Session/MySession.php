<?php

namespace LearnPhpMvc\Session;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class MySession
{
    static public function getCurrentSession(): array
    {
        $response = array();
        try {
            $key = "asodkaosdkoaoasdisauduqeiqwmxzmxlasncjnfqwhodqwpdqowkdpqkdckmkjfabfhfwhfojpfqkqowkowqkeopqwke";
            if ($_COOKIE['GO-INTERN-COCKIE']) {
                $jwt = $_COOKIE['GO-INTERN-COCKIE'];
                $payload = JWT::decode($jwt, new Key($key, 'HS256'));
                $username = $payload->username;
                $id = $payload->id;
                $nama_perusahaan = $payload->nama_perusahaan;
                $no_telp = $payload->no_telp;
                $foto = $payload->foto;
                $jenis_usaha = $payload->jenis_usaha;
                $email = $payload->email;
                $token = $payload->token;

                $item = array(
                    "username" => $username,
                    "id" => $id,
                    "nama_perusahaan" => $nama_perusahaan,
                    "no_telp" => $no_telp,
                    "foto" => $foto,
                    "jenis_usaha" => $jenis_usaha,
                    "email" => $email ,
                    "token" => $token
                );

                array_push($response , $item);
                $response['status']  = true;
            } else {
                $response['status'] = false;
                $response['message'] = 'harap login terlebih dahulu';
            }
        } catch (Exception $th) {
            $response['status'] = false;
            $response['message'] = 'harap login terlebih dahulu';
        }
        return $response;
    }
}