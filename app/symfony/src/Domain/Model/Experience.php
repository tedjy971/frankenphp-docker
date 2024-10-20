<?php

namespace Domain\Model;

use DateTimeInterface;

class Experience extends AbstractModel {

    private ?int $id = null;
    private string $company;
    private string $position;
    private DateTimeInterface $startDate;
    private ?DateTimeInterface $endDate = null;
    private string $description;

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
     * return Experience
     */
    public function setId(?int $id): self {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompany(): string {
        return $this->company;
    }

    /**
     * @param string $company
     * return Experience
     */
    public function setCompany(string $company): self {
        $this->company = $company;
        return $this;
    }

    /**
     * @return string
     */
    public function getPosition(): string {
        return $this->position;
    }

    /**
     * @param string $position
     * return Experience
     */
    public function setPosition(string $position): self {
        $this->position = $position;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getStartDate(): DateTimeInterface {
        return $this->startDate;
    }

    /**
     * @param DateTimeInterface $startDate
     * return Experience
     */
    public function setStartDate(DateTimeInterface $startDate): self {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getEndDate(): ?DateTimeInterface {
        return $this->endDate;
    }

    /**
     * @param DateTimeInterface|null $endDate
     * return Experience
     */
    public function setEndDate(?DateTimeInterface $endDate): self {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string {
        return $this->description;
    }

    /**
     * @param string $description
     * return Experience
     */
    public function setDescription(string $description): self {
        $this->description = $description;
        return $this;
    }


}
