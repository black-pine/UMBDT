<?php
namespace NovumWare\Zend\Authentication;

class Adapter extends \Zend\Authentication\Adapter\DbTable
{
	/**
     * $tableName - the table name to check
     *
     * @var string
     */
    protected $tableName = 'members';

    /**
     * $identityColumn - the column to use as the identity
     *
     * @var string
     */
    protected $identityColumn = 'member_email';

    /**
     * $credentialColumns - columns to be used as the credentials
     *
     * @var string
     */
    protected $credentialColumn = 'member_password';

    /**
     * $credentialTreatment - Treatment applied to the credential, such as MD5() or PASSWORD()
     *
     * @var string
     */
//    protected $credentialTreatment = 'SHA1(CONCAT(?, member_salt))';
}