# spionic

PHP library for converting SPIonic-encoded ASCII strings to Unicode

SPIonic is a public domain font that represents [ASCII][ascii] characters as
Greek letters and diacritics. It uses a scheme based on
[Beta Code][betacode] with a few variations, the most significant of which is that
uppercase letters are represented by uppercase letters and lowercase by
lowercase (whereas Beta Code uses `*A` for uppercase alpha and `A` for
lowercase alpha). This package will convert Greek written using this scheme
into Unicode Greek characters.

Hosted version is available at
<https://noahfrederick.com/spionic-unicode-converter/>.

[ascii]: http://en.wikipedia.org/wiki/ASCII "ASCII - Wikipedia"
[betacode]: http://en.wikipedia.org/wiki/Beta_code "Beta Code - Wikipedia"

## Installation

```
composer require noahfrederick/spionic
```

## Usage

```php
use SPIonic\SPIonicString;

$string = new SPIonicString('e)n tw~| a!gei+ e)ne/xesqai');
echo $string->toUnicode(); // -> 'ἐν τῷ ἄγεϊ ἐνέχεσθαι'
```

## License

Copyright (C) 2010-2019  Noah Frederick

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
