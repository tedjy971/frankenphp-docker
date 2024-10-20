<?php

namespace Domain\Model;

use DateTime;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class Education extends AbstractModel {

    private ?int $id = null;
    private string $institution;
    private string $degree;
    private int $yearStart;
    private ?int $yearEnd = null;

    public function __construct($array = []) {
        parent::__construct($array);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int|null $id
     * return Education
     */
    public function setId(?int $id): self {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getInstitution(): string {
        return $this->institution;
    }

    /**
     * @param string $institution
     * return Education
     */
    public function setInstitution(string $institution): self {
        $this->institution = $institution;
        return $this;
    }

    /**
     * @return string
     */
    public function getDegree(): string {
        return $this->degree;
    }

    /**
     * @param string $degree
     * return Education
     */
    public function setDegree(string $degree): self {
        $this->degree = $degree;
        return $this;
    }

    /**
     * @return int
     */
    public function getYearStart(): int {
        return $this->yearStart;
    }

    /**
     * @param int $yearStart
     * return Education
     */
    public function setYearStart(int $yearStart): self {
        $this->yearStart = $yearStart;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getYearEnd(): ?int {
        return $this->yearEnd;
    }

    /**
     * @param int|null $yearEnd
     * return Education
     */
    public function setYearEnd(?int $yearEnd): self {
        $this->yearEnd = $yearEnd;
        return $this;
    }

}
