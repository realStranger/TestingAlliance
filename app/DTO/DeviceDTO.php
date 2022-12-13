<?php

namespace App\DTO;

final class DeviceDTO
{
    private string $login;
    private string $password;
    private string $name;

    public function __construct(string $login, string $password, string $name)
    {
        $this->login = $login;
        $this->password = $password;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}
