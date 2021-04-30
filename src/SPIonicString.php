<?php namespace SPIonic;

/**
 * Convert SPIonic input to proper Unicode Greek characters.
 *
 * Usage:
 *
 *     $string = new SPIonicString('e)n tw~| a!gei+ e)ne/xesqai');
 *     echo $string->toUnicode(); // -> 'ἐν τῷ ἄγεϊ ἐνέχεσθαι'
 */
class SPIonicString
{
    /**
     * @var string
     */
    protected $orginalStr;

    /**
     * Translations of characters to Unicode equivalents.
     *
     *  1. Lowercase vowels with spiritus lenis
     *  2. Lowercase vowels with spiritus asper
     *  3. Lowercase vowels with acute
     *  4. Lowercase vowels with acute and spiritus lenis
     *  5. Lowercase vowels with acute and spiritus asper
     *  6. Lowercase vowels with grave
     *  7. Lowercase vowels with grave and spiritus lenis
     *  8. Lowercase vowels with grave and spiritus asper
     *  9. Lowercase vowels with circumflex
     *  10. Lowercase vowels with circumflex and spiritus lenis
     *  11. Lowercase vowels with circumflex and spiritus asper
     *  12. Uppercase vowels with spiritus lenis
     *  13. Uppercase vowels with spiritus asper
     *  14. Uppercase vowels with acute
     *  15. Uppercase vowels with acute and spiritus lenis
     *  16. Uppercase vowels with acute and spiritus asper
     *  17. Uppercase vowels with grave
     *  18. Uppercase vowels with grave and spiritus lenis
     *  19. Uppercase vowels with grave and spiritus asper
     *  20. Uppercase vowels with circumflex and spiritus lenis
     *  21. Uppercase vowels with circumflex and spiritus asper
     *  22. Lowercase vowels with iota subscriptum and spiritus lenis
     *  23. Lowercase vowels with iota subscriptum and spiritus asper
     *  24. Lowercase vowels with iota subscriptum and acute
     *  25. Lowercase vowels with iota subscriptum, acute, and spiritus lenis
     *  26. Lowercase vowels with iota subscriptum, acute, and spiritus asper
     *  27. Lowercase vowels with iota subscriptum and grave
     *  28. Lowercase vowels with iota subscriptum, grave, and spiritus lenis
     *  29. Lowercase vowels with iota subscriptum, grave, and spiritus asper
     *  30. Lowercase vowels with iota subscriptum and circumflex
     *  31. Lowercase vowels with iota subscriptum, circumflex, and spiritus lenis
     *  32. Lowercase vowels with iota subscriptum, circumflex, and spiritus asper
     *  33. Lowercase vowels with iota subscriptum
     *  34. Rho with spiritus asper
     *  35. Unaugmented lowercase letters
     *  36. Unaugmented uppercase letters
     *  37. Special letters
     *  38. Punctuation
     *
     *  @var array
     */
    private static $conversions = [
        /*22*/      'a|0' => 'ᾀ',   'h|0' => 'ᾐ',   'w|0' => 'ᾠ',
        /*23*/      'a|9' => 'ᾁ',   'h|9' => 'ᾑ',   'w|9' => 'ᾡ',
        /*24*/      'a|/' => 'ᾴ',   'h|/' => 'ῄ',   'w|/' => 'ῴ',
        /*25*/      'a|1' => 'ᾄ',   'h|1' => 'ᾔ',   'w|1' => 'ᾤ',
        /*26*/      'a|3' => 'ᾅ',   'h|3' => 'ᾕ',   'w|3' => 'ᾥ',
        /*27*/      'a|\\' => 'ᾲ',  'h|\\' => 'ῂ',  'w|\\' => 'ῲ',
        /*28*/      'a|2' => 'ᾂ',   'h|2' => 'ᾒ',   'w|2' => 'ᾢ',
        /*29*/      'a|4' => 'ᾃ',   'h|4' => 'ᾓ',   'w|4' => 'ᾣ',
        /*30*/      'a|=' => 'ᾷ',   'h|=' => 'ῇ',   'w|=' => 'ῷ',
        /*31*/      'a|]' => 'ᾆ',   'h|]' => 'ᾖ',   'w|]' => 'ᾦ',
        /*32*/      'a|[' => 'ᾇ',   'h|[' => 'ᾗ',   'w|[' => 'ᾧ',

        /*22*/      'a0|' => 'ᾀ',   'h0|' => 'ᾐ',   'w0|' => 'ᾠ',
        /*23*/      'a9|' => 'ᾁ',   'h9|' => 'ᾑ',   'w9|' => 'ᾡ',
        /*24*/      'a/|' => 'ᾴ',   'h/|' => 'ῄ',   'w/|' => 'ῴ',
        /*25*/      'a1|' => 'ᾄ',   'h1|' => 'ᾔ',   'w1|' => 'ᾤ',
        /*26*/      'a3|' => 'ᾅ',   'h3|' => 'ᾕ',   'w3|' => 'ᾥ',
        /*27*/      'a\\|' => 'ᾲ',  'h\\|' => 'ῂ',  'w\\|' => 'ῲ',
        /*28*/      'a2|' => 'ᾂ',   'h2|' => 'ᾒ',   'w2|' => 'ᾢ',
        /*29*/      'a4|' => 'ᾃ',   'h4|' => 'ᾓ',   'w4|' => 'ᾣ',
        /*30*/      'a=|' => 'ᾷ',   'h=|' => 'ῇ',   'w=|' => 'ῷ',
        /*31*/      'a]|' => 'ᾆ',   'h]|' => 'ᾖ',   'w]|' => 'ᾦ',
        /*32*/      'a[|' => 'ᾇ',   'h[|' => 'ᾗ',   'w[|' => 'ᾧ',

        /*33*/      'a|' => 'ᾳ',    'h|' => 'ῃ',    'w|' => 'ῳ',

        /* */       'i+' => 'ϊ',    'u+' => 'ϋ',
        /* */       'i5' => 'ΐ',
        /* */       'i6' => 'ῒ',

        /*1*/       'a0' => 'ἀ',    'e0' => 'ἐ',    'h0' => 'ἠ',    'i0' => 'ἰ',   'o0' => 'ὀ',   'u0' => 'ὐ',   'w0' => 'ὠ',
        /*2*/       'a9' => 'ἁ',    'e9' => 'ἑ',    'h9' => 'ἡ',    'i9' => 'ἱ',   'o9' => 'ὁ',   'u9' => 'ὑ',   'w9' => 'ὡ',
        /*3*/       'a/' => 'ά',    'e/' => 'έ',    'h/' => 'ή',    'i/' => 'ί',   'o/' => 'ό',   'u/' => 'ύ',   'w/' => 'ώ',
        /*4*/       'a1' => 'ἄ',    'e1' => 'ἔ',    'h1' => 'ἤ',    'i1' => 'ἴ',   'o1' => 'ὄ',   'u1' => 'ὔ',   'w1' => 'ὤ',
        /*5*/       'a3' => 'ἅ',    'e3' => 'ἕ',    'h3' => 'ἥ',    'i3' => 'ἵ',   'o3' => 'ὅ',   'u3' => 'ὕ',   'w3' => 'ὥ',
        /*6*/       'a\\' => 'ὰ',   'e\\' => 'ὲ',   'h\\' => 'ὴ',   'i\\' => 'ὶ',  'o\\' => 'ὸ',  'u\\' => 'ὺ',  'w\\' => 'ὼ',
        /*7*/       'a2' => 'ἂ',    'e2' => 'ἒ',    'h2' => 'ἢ',    'i2' => 'ἲ',   'o2' => 'ὂ',   'u2' => 'ὒ',   'w2' => 'ὢ',
        /*8*/       'a4' => 'ἃ',    'e4' => 'ἓ',    'h4' => 'ἣ',    'i4' => 'ἳ',   'o4' => 'ὃ',   'u4' => 'ὓ',   'w4' => 'ὣ',
        /*9*/       'a=' => 'ᾶ',    'h=' => 'ῆ',    'i=' => 'ῖ',    'u=' => 'ῦ',   'w=' => 'ῶ',
        /*10*/      'a]' => 'ἆ',    'h]' => 'ἦ',    'i]' => 'ἶ',    'u]' => 'ὖ',   'w]' => 'ὦ',
        /*11*/      'a[' => 'ἇ',    'h[' => 'ἧ',    'i[' => 'ἷ',    'u[' => 'ὗ',   'w[' => 'ὧ',
        /*12*/      '0A' => 'Ἀ',    '0E' => 'Ἐ',    '0H' => 'Ἠ',    '0I' => 'Ἰ',   '0O' => 'Ὀ',   '0W' => 'Ὠ',
        /*13*/      '9A' => 'Ἁ',    '9E' => 'Ἑ',    '9H' => 'Ἡ',    '9I' => 'Ἱ',   '9O' => 'Ὁ',   '9U' => 'Ὑ',   '9W' => 'Ὡ',
        /*14*/      '/A' => 'Ά',    '/E' => 'Έ',    '/H' => 'Ή',    '/I' => 'Ί',   '/O' => 'Ό',   '/U' => 'Ύ',   '/W' => 'Ώ',
        /*15*/      '1A' => 'Ἄ',    '1E' => 'Ἔ',    '1H' => 'Ἤ',    '1I' => 'Ἴ',   '1O' => 'Ὄ',   '1W' => 'Ὤ',
        /*16*/      '3A' => 'Ἅ',    '3E' => 'Ἕ',    '3H' => 'Ἥ',    '3I' => 'Ἵ',   '3O' => 'Ὅ',   '3U' => 'Ὕ',   '3W' => 'Ὥ',
        /*17*/      '\\A' => 'Ὰ',   '\\E' => 'Ὲ',   '\\H' => 'Ὴ',   '\\I' => 'Ὶ',  '\\O' => 'Ὸ',  '\\U' => 'Ὺ',  '\\W' => 'Ὼ',
        /*18*/      '2A' => 'Ἂ',    '2E' => 'Ἒ',    '2H' => 'Ἢ',    '2I' => 'Ἲ',   '2O' => 'Ὂ',   '2W' => 'Ὤ',
        /*19*/      '4A' => 'Ἃ',    '4E' => 'Ἓ',    '4H' => 'Ἣ',    '4I' => 'Ἳ',   '4O' => 'Ὃ',   '4U' => 'Ὓ',   '4W' => 'Ὣ',
        /*20*/      ']A' => 'Ἆ',    ']H' => 'Ἦ',    ']I' => 'Ἶ',    ']W' => 'Ὦ',
        /*21*/      '[A' => 'Ἇ',    '[H' => 'Ἧ',    '[I' => 'Ἷ',    '[U' => 'Ὗ',   '[W' => 'Ὧ',
        /*34*/      'r9' => 'ῥ',    '9R' => '῾Ρ',
        /*35*/      'a' => 'α',     'b' => 'β',     'g' => 'γ',     'd' => 'δ',    'e' => 'ε',    'z' => 'ζ',    'h' => 'η',    'q' => 'θ',
                    'i' => 'ι',     'k' => 'κ',     'l' => 'λ',     'm' => 'μ',    'n' => 'ν',    'c' => 'ξ',    'o' => 'ο',    'p' => 'π',
                    'w' => 'ω',     'r' => 'ρ',     's' => 'σ',     'j' => 'ς',    't' => 'τ',    'u' => 'υ',    'f' => 'φ',    'x' => 'χ',
                    'y' => 'ψ',
        /*36*/      'A' => 'Α',     'B' => 'Β',     'G' => 'Γ',     'D' => 'Δ',    'E' => 'Ε',    'Z' => 'Ζ',    'H' => 'Η',    'Q' => 'Θ',
                    'I' => 'Ι',     'K' => 'Κ',     'L' => 'Λ',     'M' => 'Μ',    'N' => 'Ν',    'C' => 'Ξ',    'O' => 'Ο',    'P' => 'Π',
                    'R' => 'Ρ',     'S' => 'Σ',     'T' => 'Τ',     'U' => 'Υ',    'F' => 'Φ',    'X' => 'Χ',    'Y' => 'Ψ',    'W' => 'Ω',
        /*37*/      'v' => 'ϛ',     'V' => 'Ϝ',     'J' => 'ϙ',     '`' => 'ϡ',
        /*38*/      ':' => '·',     ';' => ';',     '-' => '–',     '\'' => '’',   '7' => ' ',
    ];

    /**
     * Translations of wide character diacritics to narrow.
     *
     * @var array
     */
    private static $conversionsNormalizeWidth = [
        ')' => '0',  '(' => '9',  '&' => '/',  '_' => '\\',  '~' => '=',  '!' => '1',  '@' => '2',  '}' => ']',
        '#' => '3',  '$' => '4',  '{' => '[',
    ];

    /**
     * Translations of adjacent diacritics to combined.
     *
     * @var array
     */
    private static $conversionsNormalizeCombined = [
        '0/' => '1', '/0' => '1',
        '0\\' => '2', '\\0' => '2',
        '9/' => '3', '/9' => '3',
        '9\\' => '4', '\\9' => '4',
        '+/' => '5', '/+' => '5',
        '+\\' => '6', '\\+' => '6',
        '0=' => ']', '=0' => ']',
        '9=' => '[', '=9' => '[',
    ];

    /**
     * Instantiate string.
     *
     * @param string $str
     */
    public function __construct(string $str)
    {
        $this->originalStr = $str;
    }

    /**
     * Translate wide characters to narrow form.
     *
     * @return string
     */
    public function normalized(): string
    {
        $str = strtr($this->originalStr, static::$conversionsNormalizeWidth);
        return strtr($str, static::$conversionsNormalizeCombined);
    }

    /**
     * Get string as Unicode Greek.
     *
     * @return string
     */
    public function toUnicode(): string
    {
        return strtr($this->normalized(), static::$conversions);
    }
}
