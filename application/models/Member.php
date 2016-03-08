<?php

class Application_Model_Member
{
    protected $_id;
    protected $_member_login;
    protected $_member_password;
    protected $_first_name;
    protected $_last_name;
    protected $_email;
    protected $_birthday;

    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($member_login, $value)
    {
        $method = 'set' . $member_login;
        if (('mapper' == $member_login) || !method_exists($this, $method)) {
            throw new Exception('Invalid book property');
        }
        $this->$method($value);
    }

    public function __get($member_login)
    {
        $method = 'get' . $member_login;
        if (('mapper' == $member_login) || !method_exists($this, $method)) {
            throw new Exception('Invalid book property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setMemberLogin($text)
    {
        $this->_member_login = (string) $text;
        return $this;
    }

    public function getMemberLogin()
    {
        return $this->_member_login;
    }

    public function setMemberPassword($text)
    {
        $this->_member_password = (string) $text;
        return $this;
    }

    public function getMemberPassword()
    {
        return $this->_member_password;
    }

    public function setFirstName($text)
    {
        $this->_first_name = (string) $text;
    }

    public function getFirstName()
    {
        return $this->_first_name;
    }

    public function setLastName($text)
    {
        $this->_last_name = (string) $text;
    }

    public function getLastName()
    {
        return $this->_last_name;
    }

    public function setEmail($text)
    {
        $this->_email = (string) $text;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function setBirthday($text)
    {
        $this->_birthday = (string) $text;
    }

    public function getBirthday()
    {
        return $this->_birthday;
    }


}
