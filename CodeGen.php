<?php

class CodeGen
{
    public function userInput($input) : string{
        //return with error when empty
        if($input == "") {
            return printf("Invalid Input: Empty string provided!");
        }
        $username = $input;

        //this will not passed an empty string
        return $this->generateCode($username);
    }

    public function generateCode(string $username) : string {
        $alpha_out = "";

        //trim the before and after whitespace
        $trimmed_name = trim($username);

        //get the first character
        $alpha_out .= $trimmed_name[0];

        //loop all characters
        for($i = 1; $i < strlen($trimmed_name); $i++){
            //add the first character from every new word
            if($trimmed_name[$i] == " " && $trimmed_name[$i+1] != " "){
                //only add up-to 3 characters to alpha_out
                if(strlen($alpha_out) <= 2){
                    $alpha_out .= $trimmed_name[$i+1];
                }
            }
        }

        //manipulate alpha_out to fit code gen specifications
        if(strlen($trimmed_name) >= 3){
            if(strlen($alpha_out) == 2){
                $alpha_out .= substr($trimmed_name, -1);
            }
            elseif (strlen($alpha_out) == 1){
                $alpha_out .= $trimmed_name[1] . $trimmed_name[2];
            }
        }
        if(strlen($trimmed_name) == 2){
            //this concatenation can be dynamic
            $alpha_out .= $trimmed_name[1] . "A";
        }
        elseif (strlen($trimmed_name) == 1){
            //this concatenation can be dynamic
            $alpha_out .= "BC";
        }

        //return alpha_out as CAPITALS
        return strtoupper($alpha_out);
    }
}

//create the object
$alpha_gen = new CodeGen();
//this can be made to increase dynamically based on a reference value, maybe a stored value ;)  
$numeric = "001";

/*
 * Test Cases:
 *
 * "T"
 * "Te"
 * "Tes"
 * "Test"
 * "Test Case"
 * "Test Case One"
 * "Test Case One Extra"
 *
*/

//generate the alpha from user's name
$alpha = $alpha_gen->userInput("Test Case One");

//output the alphanumeric string
echo $alpha . $numeric;
