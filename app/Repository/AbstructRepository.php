<?php

namespace App\Repository;

/**
 * class AbstractRepository
 * @package App\Repository
 */
abstract class AbstractRepository
{
    /**
     * 1件取得
     *
     * @param int $id
     */
    abstract public function get(int $id);

    /**
     * 検索
     *
     * @param array $param
     */
    abstract public function find(array $param);

    /**
     * 全件取得
     */
    abstract public function all();
}
