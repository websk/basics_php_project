<?php

class User
{
    protected int $id;
    protected string $username;
    protected string $email;
    protected string $password;
    protected ?string $about_me = null;
    protected ?string $session_id = null;
    protected ?string $user_photo = null;

    public function __construct(string $username, string $email, string $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getAboutMe(): ?string
    {
        return $this->about_me;
    }

    /**
     * @param string|null $about_me
     */
    public function setAboutMe(?string $about_me): void
    {
        $this->about_me = $about_me;
    }

    /**
     * @return string|null
     */
    public function getSessionId(): ?string
    {
        return $this->session_id;
    }

    /**
     * @param string|null $session_id
     */
    public function setSessionId(?string $session_id): void
    {
        $this->session_id = $session_id;
    }

    /**
     * @return string|null
     */
    public function getUserPhoto(): ?string
    {
        return $this->user_photo;
    }

    /**
     * @param string|null $user_photo
     */
    public function setUserPhoto(?string $user_photo): void
    {
        $this->user_photo = $user_photo;
    }

    public static function getPhotoDirPath(): string
    {
        return 'photo';
    }
}