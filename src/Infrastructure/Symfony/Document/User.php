<?php

namespace Infrastructure\Symfony\Document;

use DateTimeInterface;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;


#[Document(collection: 'users')]
class User {

    #[MongoDB\Id()]
    private $id;

    #[MongoDB\Field(type: "string")]
    private string $lastName;
    #[MongoDB\Field(type: "string")]
    private string $firstName;
    #[MongoDB\Field(type: "string")]
    private string $email;
    /** @var string[] */
    #[MongoDB\Field]
    private array $roles = [];
    #[MongoDB\Field(type: "string")]
    private ?string $password = null;
    #[MongoDB\Field(type: "date")]
    private DateTimeInterface $createdAt;
    #[MongoDB\Field(type: "date")]
    private DateTimeInterface $updatedAt;
    #[MongoDB\Field(type: "bool")]
    private bool $isVerified = false;

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     * return User
     */
    public function setId($id): self {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * return User
     */
    public function setLastName(string $lastName): self {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * return User
     */
    public function setFirstName(string $firstName): self {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @param string $email
     * return User
     */
    public function setEmail(string $email): self {
        $this->email = $email;
        return $this;
    }

    /**
     * @return array
     */
    public function getRoles(): array {
        return $this->roles;
    }

    /**
     * @param array $roles
     * return User
     */
    public function setRoles(array $roles): self {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string {
        return $this->password;
    }

    /**
     * @param string|null $password
     * return User
     */
    public function setPassword(?string $password): self {
        $this->password = $password;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface {
        return $this->createdAt;
    }

    /**
     * @param DateTimeInterface $createdAt
     * return User
     */
    public function setCreatedAt(DateTimeInterface $createdAt): self {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getUpdatedAt(): DateTimeInterface {
        return $this->updatedAt;
    }

    /**
     * @param DateTimeInterface $updatedAt
     * return User
     */
    public function setUpdatedAt(DateTimeInterface $updatedAt): self {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return bool
     */
    public function isVerified(): bool {
        return $this->isVerified;
    }

    /**
     * @param bool $isVerified
     * return User
     */
    public function setIsVerified(bool $isVerified): self {
        $this->isVerified = $isVerified;
        return $this;
    }

}
