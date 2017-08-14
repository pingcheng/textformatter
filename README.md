# textformatter
A very simple string template for text rendering.

Provide a ability to let you use a reusable text template for multiple purpose like bulk Emails.

## Example
```
Dear {{ customer }},
Thank you for your purchase of {{ good_name }} on {{ date }} via {{ shop_name }}.
```
After you provide a dataset for the template, it will auto replace the placeholder. 

## Result
```
Dear Allan,
Thank you for your purchase of Apple TV on 12 Mar 2017 via OurShop.com
```

# Installation

Via Composer
```bash
composer require pingcheng/textformatter
```

Via requires
```php
require_once 'src/textformatter.php'
```

# Usage
Setup template text
```php
$text = "hello {{ name }}, How are you. Today is {{ day }},\nYou have these tasks: {{ tasks }}\n"
```
Or you can get text from a file
```php
$text = file_get_contents($path);
```
Then we need to set up the dataset to replace the placehoder
```php
$data = [];
$data['name'] = "Ping Cheng";
$data['day'] = date('l', time());
$data['tasks'] = ['Writing', 'Speaking'];
```
After text and dataset has been setup, we can convert them
```php
echo PingCheng\TextFomatter::text($text)->with($data)->process();
```
Result
```
hello Ping Cheng, How are you. Today is Monday,
You have these tasks: Writing, Speaking
```

# Supported variable type
* string
* number (integer, float ...)
* array (concat by comma)

# Next
Will support to output result in:
* HTML rendering
* List for Array
* Customised glue character for array
