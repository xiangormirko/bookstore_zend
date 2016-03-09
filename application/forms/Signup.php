<?php

class Application_Form_Signup extends Zend_Form

{
    public function init()
    {
        $this->setMethod('post');

        // Validates alphanumeric, min length 5 char, and no existing matching record
        $this->addElement(
            'text', 'member_login', array(
            'label' => 'Login ID:',
            'required' => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('Alnum', false, true),
                array('stringLength', false, array(5, 20)),
                array('Db_NoRecordExists', false, array('table' => 'members',
                    'field' => 'member_login'))
            )
        ));

        $this->addElement('password', 'member_password', array(
            'label' => 'Password:',
            'required' => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('stringLength', false, array(5, 20))
            )
        ));

        // Validates matching passwords and min length
        $this->addElement('password', 'password_confirm', array(
            'label' => 'Confirm Password:',
            'required' => true,
            'validators' => array(
                array('stringLength', false, array(5, 20)),
                array('identical', false, array('token' => 'member_password'))
            )
        ));

        // Add an category id element
        $this->addElement('text', 'first_name', array(
            'label'      => 'First Name:',
            'required'   => true,
            'validators' => array(
                array('stringLength', false, array(3, 20))
            )
        ));

        $this->addElement('text', 'last_name', array(
            'label'      => 'Last Name:',
            'required'   => true,
            'validators' => array(
                array('stringLength', false, array(3, 20))
            )
        ));

        //Validates valid email format
        $this->addElement('text', 'email', array(
            'label'      => 'Email:',
            'required'   => true,
            'validators' => array(
                array('EmailAddress', false)
            )
        ));

        //Validates valid date format
        $this->addElement('text', 'birthday', array(
            'label'      => 'Birthday:',
            'required'   => false,
            'validators' => array(
                array('Date', false, array('format' => 'YYYY-MM-DD')
                )
            )
        ));


        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Signup',
        ));

    }
}
