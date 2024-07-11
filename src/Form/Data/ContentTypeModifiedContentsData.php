<?php

namespace App\Form\Data;

use Ibexa\Core\Repository\Values\ContentType\ContentType;

class ContentTypeModifiedContentsData
{
    private ?ContentType $content_type;
    private int $page;
    private ?\DateTime $date_from;

    /**
     * ContentTypeModifiedContentsData constructor.
     */
    public function __construct(
        ?ContentType $content_type = null,
        ?\DateTime $date_from = null,
        int $page = 1
    ) {
        $this->content_type = $content_type;
        $this->date_from = $date_from;
        $this->page = $page;
    }

    /**
     * @return ContentTypeModifiedContentsData
     */
    public function setContentType(?ContentType $content_type): self
    {
        $this->content_type = $content_type;

        return $this;
    }

    public function getContentType(): ?ContentType
    {
        return $this->content_type;
    }

    public function getDateFrom(): ?\DateTime
    {
        return $this->date_from;
    }

    /**
     * @return ContentTypeModifiedContentsData
     */
    public function setDateFrom(?\DateTime $date_from): self
    {
        $this->date_from = $date_from;

        return $this;
    }

    /**
     * @return ContentTypeModifiedContentsData
     */
    public function setPage(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getPage(): int
    {
        return $this->page;
    }
}
