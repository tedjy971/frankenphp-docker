<?php


namespace Application\DTO\Cv;

use Application\DTO\AbstractDTO;
use Domain\Model\User;

class CvCreateDTO extends AbstractDTO {

    public User $user;
    public array $educations = [];
    public array $experiences = [];
    public array $skills = [];


    /**
     * @return int
     */
    public function getUserId(): int {
        return $this->userId;
    }

    /**
     * @param int $userId
     * return CvCreateDTO
     */
    public function setUserId(int $userId): self {
        $this->userId = $userId;
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
     * return CvCreateDTO
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
     * return CvCreateDTO
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
     * return CvCreateDTO
     */
    public function setSkills(array $skills): self {
        $this->skills = $skills;
        return $this;
    }

}
