<?php

namespace Domain\Model;

use DateTime;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class CV extends AbstractModel {

    private ?int $id = null;
    private array $educations = [];
    private array $experiences = [];
    private array $skills = [];
    private $phone = null;


    public function __construct($array = []) {
        parent::__construct($array);
    }

    /**
     * @return null
     */
    public function getPhone(): null {
        return $this->phone;
    }

    /**
     * @param null $phone
     * return CV
     */
    public function setPhone(null $phone): self {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int|null $id
     * return CV
     */
    public function setId(?int $id): self {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFullName(): string {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     * return CV
     */
    public function setFullName(string $fullName): self {
        $this->fullName = $fullName;
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
     * return CV
     */
    public function setEmail(string $email): self {
        $this->email = $email;
        return $this;
    }

    /**
     * @return array
     */
    public function getEducations(): array {
        return $this->educations;
    }

    /**
     * @param array $educations
     * return CV
     */
    public function setEducations(array $educations): self {
        $this->educations = $educations;
        return $this;
    }

    /**
     * @return array
     */
    public function getExperiences(): array {
        return $this->experiences;
    }

    /**
     * @param array $experiences
     * return CV
     */
    public function setExperiences(array $experiences): self {
        $this->experiences = $experiences;
        return $this;
    }

    /**
     * @return array
     */
    public function getSkills(): array {
        return $this->skills;
    }

    /**
     * @param array $skills
     * return CV
     */
    public function setSkills(array $skills): self {
        $this->skills = $skills;
        return $this;
    }

    public function addEducation(Education $education): self {
        $this->educations[] = $education;
        return $this;
    }

    public function addExperience(Experience $experience): self {
        $this->experiences[] = $experience;
        return $this;
    }

    public function addSkill(Skill $skill): self {
        $this->skills[] = $skill;
        return $this;
    }

    public function removeEducation(Education $education): self {
        $key = array_search($education, $this->educations);
        if ($key !== false) {
            unset($this->educations[$key]);
        }
        return $this;
    }

    public function removeExperience(Experience $experience): self {
        $key = array_search($experience, $this->experiences);
        if ($key !== false) {
            unset($this->experiences[$key]);
        }
        return $this;
    }

    public function removeSkill(Skill $skill): self {
        $key = array_search($skill, $this->skills);
        if ($key !== false) {
            unset($this->skills[$key]);
        }
        return $this;
    }


}
