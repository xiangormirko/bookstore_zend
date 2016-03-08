<?php

class Application_Model_MemberMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception("Invalid table data gateway provided");
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Members');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Member $member)
    {
        $data = array(
            'member_login' => $member->getMemberLogin(),
            'member_password' => $member->getMemberPassword(),
            'first_name' => $member->getFirstName(),
            'last_name' => $member->getLastName(),
            'email' => $member->getEmail(),
            'birthday' => $member->getBirthday(),
        );

        if (null === ($id = $member->getId())) {
            unset($data['member_id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('member_id = ?' => $id));
        }
    }

    public function find($id, Application_Model_Member $member)
    {
        $result = $this->getDbTable()->find($id);

        if (0 == count($result)) {
            return;
        }
        $row = $result->current();

        $member->setId($row->member_id)
                ->setMemberLogin($row->member_login)
                ->setMemberPassword($row->member_password)
                ->setFirstName($row->first_name)
                ->setLastName($row->last_name)
                ->setEmail($row->email)
                ->setBirthday($row->birthday);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Member();
            $entry->setId($row->member_id)
                ->setMemberLogin($row->member_login)
                ->setMemberPassword($row->member_password)
                ->setFirstName($row->first_name)
                ->setLastName($row->last_name)
                ->setEmail($row->email)
                ->setBirthday($row->birthday);

            $entries[] = $entry;
        }
        return $entries;
    }

}

