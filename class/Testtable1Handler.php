<?php

declare(strict_types=1);


namespace XoopsModules\Wgtestmb;

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgTestMB module for xoops
 *
 * @copyright    2026 XOOPS Project (https://xoops.org)
 * @license      GPL 2.0 or later
 * @package      wgtestmb
 * @author       TDM XOOPS - Email:info@email.com - Website:https://xoops.org
 */

use XoopsModules\Wgtestmb;


/**
 * Class Object Handler Testtable1
 */
class Testtable1Handler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param \XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'wgtestmb_testtable1', Testtable1::class, 'tt1_id', 'tt1_name');
    }

    /**
     * @param bool $isNew
     *
     * @return object
     */
    public function create($isNew = true)
    {
        return parent::create($isNew);
    }

    /**
     * retrieve a field
     *
     * @param int $id field id
     * @param null fields
     * @return \XoopsObject|null reference to the {@link Get} object
     */
    public function get($id = null, $fields = null)
    {
        return parent::get($id, $fields);
    }

    /**
     * get inserted id
     *
     * @param null
     * @return int reference to the {@link Get} object
     */
    public function getInsertId()
    {
        return $this->db->getInsertId();
    }

    /**
     * Get Count Testtable1 in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    public function getCountTesttable1($start = 0, $limit = 0, $sort = 'tt1_id ASC, tt1_name', $order = 'ASC')
    {
        $crCountTesttable1 = new \CriteriaCompo();
        $crCountTesttable1 = $this->getTesttable1Criteria($crCountTesttable1, $start, $limit, $sort, $order);
        return $this->getCount($crCountTesttable1);
    }

    /**
     * Get All Testtable1 in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
    public function getAllTesttable1($start = 0, $limit = 0, $sort = 'tt1_id ASC, tt1_name', $order = 'ASC')
    {
        $crAllTesttable1 = new \CriteriaCompo();
        $crAllTesttable1 = $this->getTesttable1Criteria($crAllTesttable1, $start, $limit, $sort, $order);
        return $this->getAll($crAllTesttable1);
    }

    /**
     * Get Criteria Testtable1
     * @param        $crTesttable1
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    private function getTesttable1Criteria($crTesttable1, $start, $limit, $sort, $order)
    {
        $crTesttable1->setStart($start);
        $crTesttable1->setLimit($limit);
        $crTesttable1->setSort($sort);
        $crTesttable1->setOrder($order);
        return $crTesttable1;
    }

    /**
     * Returns the Testtable1 from id
     *
     * @return string
     */
    public function getTesttable1FromId($testtable1Id)
    {
        $testtable1Id = (int)( $testtable1Id );
        $testtable1 = '';
        if ($testtable1Id > 0) {
            $testtable1Handler = $helper->getHandler('Testtable1');
            $testtable1Obj = $testtable1Handler->get($testtable1Id);
            if (\is_object( $testtable1Obj )) {
                $testtable1 = $testtable1Obj->getVar('tt1_name');
            }
        }
        return $testtable1;
    }
}
