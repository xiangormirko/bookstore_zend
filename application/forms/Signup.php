<?php

class Application_Form_Signup extends Zend_Form

{
    public function init()
    {
        $this->setMethod('post');

        $this->addElement(
            'text', 'member_login', array(
            'label' => 'Login ID:',
            'required' => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('Alnum', false, true),
                array('stringLength', false, array(5, 20))
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

        $this->addElement('password', 'password_confirm', array(
            'label' => 'Confirm Password:',
            'required' => true,
            'validators' => array(
                array('stringLength', false, array(3, 20),
                    array(
                        'name' => 'Identical',
                            'options' => array(
                                'token' => 'password',
                            ),
                    )
                )
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

        $this->addElement('text', 'email', array(
            'label'      => 'Email:',
            'required'   => true,
            'validators' => array(
                array('EmailAddress', false)
            )
        ));

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
