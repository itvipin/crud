<?php
class Validation
{

    public $errors = [];

    private $labelMap = ['firstname' => 'First Name', 'lastname' => 'Last Name', 'address' => 'Address', 'gender' => 'Gender', 'city' => 'City', 'email' => 'Email', 'dob' => 'Age', 'contact' => 'Contact Number', 'photo' => 'Photo'];

    private function validateEmpty($allValues)
    {	
        foreach ($allValues as $key => $value)
        {
			
            if (empty($value))
            {
                $this->errors[$key] = $this->labelMap[$key] . " is required";
            }
        }
		return $this->errors;
    }

    private function validateEmail($inputEmail)
    {
        $isEmail = preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $inputEmail);
        if (!$isEmail)
        {
            $this->errors['email'] = $this->labelMap['email'] . " is invalid";
        }
        return $this->errors;
    }

    private function validateDob($inputDob)
    {
        $calAge = (date('Y') - date('Y', strtotime($inputDob)));
        if ($calAge < 18)
        {
            $this->errors['dob'] = "Your age is $calAge and You are not Elligble";
        }
		echo "<pre>";
		
		
        return $this->errors;
    }

    function check($postValues)
    {
        $validationErrors = $this->validateEmpty($postValues);
        //  When Email is not empty, check for email format
        if (empty($validationErrors['email']))
        {
            $this->validateEmail($postValues['email']);
        }
		if (empty($validationErrors['dob']))
		{
            $this->validateDob($postValues['dob']);
		}
        return $this->errors;
    }
}

?>
