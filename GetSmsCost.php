<?php
/**
 * Function checks cost of given sms
 * number and returns it, by default
 * returned price is without tax rate
 * but you can pass your tax rate as 
 * second parameter to include it in
 * returning price, when given number
 * is invalid then boolean false will
 * be returned
 * 
 * <pre>
 * // Will print 10.00 (tax excluded)
 * echo getSmsCost(910553);
 * 
 * // Will print 12.30 (tax included)
 * echo getSmsCost(910553, 0.23);
 * </pre>
 * 
 * @author  Maciej Strączkowski <m.straczkowski@gmail.com>
 * @param   integer  $number  SMS number (i.e 910553)
 * @param   float    $tax     Tax rate (i.e 0.23)
 * @return  float|boolean     Cost of SMS or false
 */
function getSmsCost($number, $tax = null)
{
    // Convert number to plain string
    $number = (string)$number;
   
    // Get number length
    $length = strlen($number);
    
    // Return false when number is invalid
    if (!is_numeric($number) || !intval($number) || $length > 6 || $length < 4) {
        return false;
    }
    
    // Check that number has 5 characters and starts from
    // "8" or "5" it is the cheapest type of SMS and it 
    // cannot be more expensive than 1.00
    if ($length == 5 && ($number[0] == '5' || $number[0] == '8')) {
        $cost = '0.'.substr($number, 1, 2);
    }
    
    // Check that number has 4 or 5 characters and starts
    // from "7" - this number price starts from 1.00 to 9.00
    if (($length == 4 || $length == 5) && $number[0] == '7') {
        $cost = substr($number, 1, 1);
    }
    
    // Check that number has 4 or 5 characters and starts
    // from "70" - number price is 0.50
    if (($length == 4 || $length == 5) && $number[0] == '7' && $number[1] == '0') {
        $cost = 0.50;
    }
    
    // Check that number has 5 or 6 characters and starts
    // from "9" or 6 - these numbers can be the most expensive
    if (($length == 5 || $length == 6) && ($number[0] == '9' || $number[0] == '6')) {
        $cost = substr($number, 1, 2);
    }

    // Return real cost + tax or ignore tax when it is null
    return (float)($tax !== null ? $cost + ($cost * $tax) : $cost);
}//end of getSmsCost() function
