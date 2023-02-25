# About my PHP Validator

## How to install

```bash
composer require raoul/php-validator
```
Or
```git
git clone https://github.com/RaoulvanWijk/Validator.git
```

## How to use it?
To use my validator you can either instantiate the validator class
```php
require_once __DIR__ .'/vendor/autoload.php';

use Raoul\Validator\Validator;

$validator = new Validator();
```
or create a new class that extends the base validator class
```php
require_once __DIR__ .'/vendor/autoload.php';

use Raoul\Validator\Validator;

Class CustomValidator extends Validator
{
    public function rules()
    {
        return [
            // Youre rules go here
        ];
    }

    public function messages()
    {
        return [
            // Youre custom messages go here
        ];
    }
}

$validator = new CustomValidator();
```

And then call the validate method with the needed data
```php
$validator->validate($data);
```

### Specifying the rules
You have 2 options when specifying the rules
when calling the validate method
```php
$validator->validate($data, [
  'name' => ['required', 'min:4'],
  'email' => 'required|email'
  ]);
```
or in the rules() method
```php
public function rules()
    {
        return [
            'name' => ['required', 'min:4'],
            'email' => 'required|email'
        ];
    }
```

### Specifying custom validation messages

### available validation rules
