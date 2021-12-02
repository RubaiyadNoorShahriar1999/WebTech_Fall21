<?php

/**
 * Can't access directly by URL
 */

defined("_DIRECT_ACCESS") or exit("<h1>Your are not allowed</h1>");


class User
{
    private int $id;
    private string $name;
    private string $username;
    private string $email;
    private string $password;
    private string $gender;
    private string $dob;
    private string $pp_path;

    public function __construct()
    {
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setGender(string $gender)
    {
        $this->gender = $gender;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setDob(string $dob)
    {
        $this->dob = $dob;
    }

    public function getDob(): string
    {
        return $this->dob;
    }

    public function setPp_path(string $pp_path)
    {
        $this->pp_path = $pp_path;
    }

    public function getPp_path(): string
    {
        return $this->pp_path;
    }
}
