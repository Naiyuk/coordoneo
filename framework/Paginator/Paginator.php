<?php

declare(strict_types=1);

/**
 * Paginator class
 */

namespace Framework\Paginator;

/**
 * Paginator
 */
class Paginator
{
    /**
     * Paginate
     * @access public
     * @param string $query
     * @param int $page
     * @param int $limit
     * 
     * @return string
     */
    public function paginate(string $query, int $page, int $limit): string
    {
        $page = ($page - 1);

        if ($page < 0) {
            $page = 0;
        }

        $offset = $page * $limit;

        $limitQuery = ' LIMIT ' . $limit . ' OFFSET ' . $offset;

        $query .= $limitQuery;

        return $query;
    }
}