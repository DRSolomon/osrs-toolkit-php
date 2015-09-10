<?php

use OpenSRS\domains\provisioning\ProvisioningCancelPending;
/**
 * @group provisioning
 * @group ProvisioningCancelPending
 */
class ProvisioningCancelPendingTest extends PHPUnit_Framework_TestCase
{
    protected $func = 'provCancelPending';

    protected $validSubmission = array(
        "data" => array(
            /**
             * Required
             *
             * to_date: specify the date, in UNIX
             *   (epoch) time before which to
             *   cancel orders. orders put in pending
             *   or declined state on this date and
             *   earlier are cancelled
             */
            "to_date" => "",

            /**
             * Optional
             *
             * status: lists the status for which to
             *   cancel orders, valid values:
             *     - pending
             *     - declined
             *   default: pending
             */
            "status" => "",
            )
        );

    /**
     * Valid submission should complete with no
     * exception thrown
     *
     * @return void
     *
     * @group validsubmission
     */
    public function testValidSubmission() {
        $data = json_decode( json_encode($this->validSubmission) );



        // sending request with order_id only
        $data->data->to_date = time();
        $ns = new ProvisioningCancelPending( 'array', $data );

        $this->assertTrue( $ns instanceof ProvisioningCancelPending );


        // // sending request with domain only -- CLASS NOT SET UP TO ACCEPT THIS AS VALID
        // $data->data->domain = "phptest" . time() . ".com";
        // $ns = new ProvisioningCancelPending( 'array', $data );
    }

    /**
     * Data Provider for Invalid Submission test
     */
    function submissionFields() {
        return array(
            'missing to_date' => array('to_date'),
            );
    }

    /**
     * Invalid submission should throw an exception
     *
     * @return void
     *
     * @dataProvider submissionFields
     * @group invalidsubmission
     */
    public function testInvalidSubmissionFieldsMissing( $field, $parent = 'data' ) {
        $data = json_decode( json_encode($this->validSubmission) );

        $data->data->to_date = time();

        $this->setExpectedExceptionRegExp(
            'OpenSRS\Exception',
            "/$field.*not defined/"
            );



        // clear field being tested
        if(is_null($parent)){
            unset( $data->$field );
        }
        else{
            unset( $data->$parent->$field );
        }

        $ns = new ProvisioningCancelPending( 'array', $data );
     }
}