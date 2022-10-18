<?php

namespace LearnPhpMvc\repository;

use DateTime;
use LearnPhpMvc\Domain\PencariMagang;
use LearnPhpMvc\Domain\Sekolah;

class PencariMagangRepository
{
    public \PDO $connection ;

    /**
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAll() : array{
        $query = "select * from pencari_magang";
        $PDOStatement = $this->connection->query($query);
        $response = array();
        $response['data'] = array();
        var_dump($PDOStatement->rowCount());
        if ($PDOStatement->rowCount()>0) {
            http_response_code(200);
            $response['status'] = "oke";
            while ($result = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
                extract($result);
                $item = array(
                    "id" => $id,
                    "username" => $username,
                    "password" => $password,
                    "email" => $email,
                    "id_sekolah" => $id_sekolah,
                    "no_telp" => $no_telp,
                    "agama" => $agama,
                    "tanggal_lahir" => $tanggal_lahir,
                    "token" => $token,
                    "cv" => $cv,
                    "resume" => $resume,
                    "status" => $status,
                    "status_magang" => $status_magang,
                    "role" => $role,
                    "crate_add" => $crate_add,
                    "update_add" => $update_add
                );
                array_push($response, $item);
            }

        }else{
            http_response_code(404);
            $response['status'] = "data tidak ditemukan";
        }
        return $response;
    }

    public function deleteAll(){
        $this->connection->exec("delete from pencari_magang");
    }

    public function save(PencariMagang $pencariMagang , Sekolah $sekolah) : ?PencariMagang{
        $date = new DateTime();
        $timestamp = $date->getTimestamp();
        $dtNow = gmdate("Y-m-d\TH:i:s" , $timestamp);
        try {
            $query = "INSERT INTO `pencari_magang`( `username`, `password`, `email`, `id_sekolah`, `no_telp`, `agama`, `tanggal_lahir`, `token`, `cv`, `resume`, `status`, `status_magang`, `role`, `crate_add`, `update_add`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute(
                [
                    $pencariMagang->getUsername() ,
                    $pencariMagang->getPassword() ,
                    $pencariMagang -> getEmail() ,
                    $sekolah->id,
                    $pencariMagang->getNo_telp() ,
                    $pencariMagang ->getAgama() ,
                    $pencariMagang -> getTanggalLahir() ,
                    $pencariMagang->getToken() ,
                    $pencariMagang -> getCv() ,
                    $pencariMagang -> getResume() ,
                    $pencariMagang -> getStatus() ,
                    $pencariMagang -> isStatusMagang(),
                    $pencariMagang -> getRole() ,
                    $dtNow,
                    $dtNow
                ]
            );
            return $pencariMagang;
        }catch (\PDOException $exception){
            return null;
        }
    }

    public function findById($id) : ?PencariMagang{
        $pencariMagang = new PencariMagang();
        $query = "select * from pencari_magang where id = ?";
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$id]);
        if($PDOStatement->rowCount()>0){
            while ($row = $PDOStatement->fetch(\PDO::FETCH_ASSOC)){
                $pencariMagang->setId($row['id']);
                $pencariMagang->setUsername($row['username']);
                $pencariMagang->setPassword($row['password']);
                $pencariMagang->setEmail($row['email']);
                $pencariMagang->setIdSekolah($row['id_sekolah']);
                $pencariMagang->setNo_telp($row['no_telp']);
                $pencariMagang->setAgama($row['agama']);
                $pencariMagang->setTanggalLahir($row['tanggal_lahir']);
                $pencariMagang->setToken($row['token']);
                $pencariMagang->setCv($row['cv']);
                $pencariMagang->setResume($row['resume']);
                $pencariMagang->setStatus($row['status']);
                $pencariMagang->setStatusMagang($row['status_magang']);
                $pencariMagang->setRole($row['role']);
                $pencariMagang->setCreate_at($row['crate_add']);
                $pencariMagang->setUpdate_at($row['update_add']);
            }
            return $pencariMagang;
        }else{
            return null;
        }
    }

}