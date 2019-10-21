# Encoder

Encodes and decodes string values

## Documentation

### Usage

```php
use Sfadless\Encoder\Encryptor\Base64Encryptor;
use Sfadless\Encoder\Encoder;

$key = "someSecretString";
$encryptor = new Base64Encryptor();
$encoder = new Encoder($encryptor, $key);

$dataToEncode = "Some value that should be encoded";

$encoded = $encoder->encode($dataToEncode);
$decoded = $encoder->decode($encoded);

var_dump($dataToEncode, $decoded); //true
```
