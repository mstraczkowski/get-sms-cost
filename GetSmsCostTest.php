<?php
/**
 * Including function file
 */
require_once('GetSmsCost.php');

/**
 * PHPUnit Test Class for getSmsCost() function
 * 
 * @author      Maciej Strączkowski <m.straczkowski@gmail.com>
 * @category    Tests
 * @copyright   Maciej Strączkowski
 * @version     1.0.0 <07.06.2013>
 */
class GetSmsCostTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Method checks that function is
     * returning false when invalid
     * number was given as parameter
     * 
     * @access  public
     * @param   mixed  $number  An invalid number
     * @return  void
     * @dataProvider getInvalidNumbers
     */
    public function testFalseWhenInvalidNumber($number)
    {
        $this->assertFalse(getSmsCost($number));
    }//end of testFalseWhenInvalidNumber() method
    
    /**
     * Method is checking that tax rate
     * is ignored when null was given
     * as second parameter, and also it
     * checks that tax is including
     * properly when it was specified
     * 
     * @access  public
     * @return  void
     */
    public function testIgnoringTaxRateWhenNull()
    {
        // Number cost is 25.00 (without tax)
        static $number = '925333';
        static $tax    = 0.23;
        
        // Expected total value
        $expectedTaxValue = 25.00 + (25.00 * $tax);
        
        // Bot hof these values should be equal
        $resultWithoutTax  = getSmsCost($number);
        $resultWithoutTax2 = getSmsCost($number, null);
        
        // This value should not be equal
        $resultWithTax  = getSmsCost($number, $tax);
        
        $this->assertEquals($resultWithoutTax, $resultWithoutTax2);
        $this->assertNotEquals($resultWithoutTax, $resultWithTax);
        $this->assertEquals($expectedTaxValue, $resultWithTax);
    }//end of testIgnoringTaxRateWhenNull() method
    
    /**
     * Method checks that sms cost is 
     * recognized in a right way, it
     * is using data provider to know
     * what cost is right
     * 
     * @access  public
     * @param   string  $number SMS number
     * @param   float   $tax    Tax rate
     * @param   float   $expectedNetto  Expected netto price
     * @param   float   $expectedBrutto Expected brutto price
     * @return  void
     * @dataProvider getValidNumbers
     */
    public function testRecognizingNumbers($number, $tax, $expectedNetto, $expectedBrutto)
    {
        $actualNetto  = getSmsCost($number, null);
        $actualBrutto = getSmsCost($number, $tax);
        
        $this->assertEquals($expectedNetto, $actualNetto);
        $this->assertEquals($expectedBrutto, $actualBrutto);
    }//end of testRecognizingNumbers() method
    
    /**
     * Data provider which is returning
     * valid sms numbers and some more
     * informations like, tax rate and
     * expected netto and brutto values
     * 
     * @access  public
     * @return  array  An array of valid numbers
     */
    public function getValidNumbers()
    {
        return array(
            array('925123', null, 25.00, 25.00),
            array('92512',  0.23, 25.00, 30.75),

            array('916123', null, 16.00, 16.00),
            array('91612',  0.23, 16.00, 19.68),
            
            array('79123', null, 9.00, 9.00),
            array('7812',  0.23, 8.00, 9.84),
            
            array('70500', null, 0.50, 0.50),
            array('7050',  0.23, 0.50, 0.615),
            
            array('84500', null, 0.45, 0.45),
            array('85099', 0.23, 0.50, 0.615),
            
            array('60399', null, 3.00, 3.00),
            array('60399', 0.23, 3.00, 3.69),
            array('60400', 0.23, 4.00, 4.92),
            
            array('56000', null, 0.60, 0.60),
            array('59099', 0.23, 0.90, 1.107),
        );
    }//end of getValidNumbers() method
    
    /**
     * Data provider which is returning
     * invalid sms numbers
     * 
     * @access  public
     * @return  array  An array of invalid numbers
     */
    public function getInvalidNumbers()
    {
        return array(
            array(''),       array("\t"),      array(' '),
            array('string'), array('1000000'), array(null),
            array(false),    array('123str'),  array('123')
        );
    }//end of getInvalidNumbers() method
    
}//end of GetSmsCostTest Class
