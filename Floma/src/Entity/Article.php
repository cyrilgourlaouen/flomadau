<?php

namespace App\Entity;

/**
 * Class Article
 *
 * @package App\Entity
 */
class Article {

    /** @var int|null */
    private ?int $id;

    /** @var string|null */
    private ?string $title;

    /** @var string|null */
    private ?string $description;
    /** @var string|null */
    private ?string $content;

    const TABLE_NAME = 'articles';

    /**
     * @return int|null
     */
    public function getId(): ?int {
		return $this->id;
	}

    /**
     * @return string|null
     */
    public function getTitle(): ?string {
		return $this->title;
	}

    /**
     * @param string|null $title
     * @return void
     */
    public function setTitle(?string $title): void {
		$this->title = $title;
	}

    /**
     * @return string|null
     */
    public function getDescription(): ?string {
		return $this->description;
	}

    /**
     * @param string|null $description
     * @return void
     */
    public function setDescription(?string $description): void {
		$this->description = $description;
	}

    /**
     * @return string|null
     */
    public function getContent(): ?string {
		return $this->content;
	}

    /**
     * @param string|null $content
     * @return void
     */
    public function setContent(?string $content): void {
		$this->content = $content;
	}

}