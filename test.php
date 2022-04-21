<?php
declare(strict_types=1);

enum Status
{
    case DRAFT;
    case PUBLISHED;
    case ARCHIVED;
}


class BlogPost
{
    public function __construct(
        public Status $status, 
    ) {}
}
