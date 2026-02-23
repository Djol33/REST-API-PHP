<?php
namespace  App\Validator;
use App\Exception\CustomException;

class Validator
{
    private $field;
    private $fieldName;
    protected $errors = [];
    private $currentMessage;
    public function __construct($field)
    {
        $this->fieldName=array_key_first($field);
        $this->field = $field[$this->fieldName];
    }
    private function setError($msg){
        $this->errors[$this->fieldName][] = $msg;
    }
    private function getMessage(string $default): string
    {
        $msg = $this->currentMessage ?: $default;
        $this->currentMessage = null;
        return $msg;
    }

    public function minLenght(int $i) : self{

        if(strlen($this->field) <$i) {
            $this->setError($this->getMessage("Minimum length is  $i"));

        }
        return $this;

    }
    public function inRange(array $range):self{

        if(!in_array($this->field, $range, true)) { $this->setError($this->getMessage("Value is not in range"));}
        return $this;
    }
    public function pattern(string $pattern):self
    {
        if(!preg_match($pattern, $this->field)){
            $this->setError($this->getMessage("Pattern is not matched"));
        }
    return $this;
    }
    public function required(): self
    {
        if (empty($this->field) && $this->field !== '0') {
            $this->setError($this->getMessage("This field is required"));

        }
        return $this;
    }


    public function minLength(int $i): self
    {
        if (strlen((string)$this->field) < $i) {
            $this->setError($this->getMessage("Minimum length is $i characters."));

        }
        return $this;
    }


    public function maxLength(int $i): self
    {
        if (strlen((string)$this->field) > $i) {
            $this->setError($this->getMessage("Maximum length is $i characters."));
        }
        return $this;
    }


    public function email(): self
    {
        if (!filter_var($this->field, FILTER_VALIDATE_EMAIL)) {
            $this->setError($this->getMessage("Invalid Email Format"));
        }
        return $this;
    }
    public function message($msg):self{

        $this->currentMessage = $msg;
            return $this;

    }
    public function fails()
    {

        return !empty($this->errors) ? $this->errors : false;
    }


}