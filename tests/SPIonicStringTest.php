<?php namespace SPIonic\Tests;

use PHPUnit\Framework\TestCase;
use SPIonic\SPIonicString;

/**
 * Tests covering SPIonic\SPIonicString.
 */
class SPIonicStringTest extends TestCase
{
    /**
     * Basic letters
     *
     * @dataProvider lettersProvider
     */
    public function testLetters($spionic, $unicode)
    {
        $this->assertEquals($unicode, (new SPIonicString($spionic))->toUnicode());
    }

    /**
     * Special letters and punctuation
     *
     * @dataProvider symbolsProvider
     */
    public function testSymbols($spionic, $unicode)
    {
        $this->assertEquals($unicode, (new SPIonicString($spionic))->toUnicode());
    }

    /**
     * Letters combined with diacritics
     *
     * @dataProvider diacriticsProvider
     */
    public function testDiacritics($spionic, $unicode)
    {
        $this->assertEquals($unicode, (new SPIonicString($spionic))->toUnicode());
    }

    /**
     * Letters combined with iota subscriptum (and diacritics)
     *
     * @dataProvider subscriptumProvider
     */
    public function testSubscriptum($spionic, $unicode)
    {
        $this->assertEquals($unicode, (new SPIonicString($spionic))->toUnicode());
    }

    /**
     * Wide variants of diacritical marks
     *
     * @dataProvider wideProvider
     */
    public function testWide($spionic, $unicode)
    {
        $this->assertEquals($unicode, (new SPIonicString($spionic))->toUnicode());
    }

    /**
     * Adjacent uncombined diacritical marks
     *
     * @dataProvider uncombinedProvider
     */
    public function testUncombined($spionic, $unicode)
    {
        $this->assertEquals($unicode, (new SPIonicString($spionic))->toUnicode());
    }

    /**
     * A continuous run of text
     */
    public function testCombined()
    {
        $this->assertEquals('ἐν τῷ ἄγεϊ ἐνέχεσθαι', (new SPIonicString('e)n tw~| a!gei+ e)ne/xesqai'))->toUnicode());
    }

    /**
     * Switching the order of combining diacritics
     */
    public function testCombiningOrderIota()
    {
        $this->assertEquals('τῷ', (new SPIonicString('tw~|'))->toUnicode());
        $this->assertEquals('τῷ', (new SPIonicString('tw|~'))->toUnicode());
    }

    public function lettersProvider()
    {
        return [
            ['a', 'α'],
            ['b', 'β'],
            ['g', 'γ'],
            ['d', 'δ'],
            ['e', 'ε'],
            ['z', 'ζ'],
            ['h', 'η'],
            ['q', 'θ'],
            ['i', 'ι'],
            ['k', 'κ'],
            ['l', 'λ'],
            ['m', 'μ'],
            ['n', 'ν'],
            ['c', 'ξ'],
            ['o', 'ο'],
            ['p', 'π'],
            ['w', 'ω'],
            ['r', 'ρ'],
            ['s', 'σ'],
            ['j', 'ς'],
            ['t', 'τ'],
            ['u', 'υ'],
            ['f', 'φ'],
            ['x', 'χ'],
            ['y', 'ψ'],
            ['A', 'Α'],
            ['B', 'Β'],
            ['G', 'Γ'],
            ['D', 'Δ'],
            ['E', 'Ε'],
            ['Z', 'Ζ'],
            ['H', 'Η'],
            ['Q', 'Θ'],
            ['I', 'Ι'],
            ['K', 'Κ'],
            ['L', 'Λ'],
            ['M', 'Μ'],
            ['N', 'Ν'],
            ['C', 'Ξ'],
            ['O', 'Ο'],
            ['P', 'Π'],
            ['R', 'Ρ'],
            ['S', 'Σ'],
            ['T', 'Τ'],
            ['U', 'Υ'],
            ['F', 'Φ'],
            ['X', 'Χ'],
            ['Y', 'Ψ'],
            ['W', 'Ω'],
        ];
    }

    public function symbolsProvider()
    {
        return [
            ['v', 'ϛ'],
            ['V', 'Ϝ'],
            ['J', 'ϙ'],
            ['`', 'ϡ'],
            [':', '·'],
            [';', ';'],
            ['-', '–'],
            ['\'', '’'],
            ['7', ' '],
        ];
    }

    public function diacriticsProvider()
    {
        return [
            ['a0', 'ἀ'],
            ['e0', 'ἐ'],
            ['h0', 'ἠ'],
            ['i0', 'ἰ'],
            ['o0', 'ὀ'],
            ['u0', 'ὐ'],
            ['w0', 'ὠ'],
            ['a9', 'ἁ'],
            ['e9', 'ἑ'],
            ['h9', 'ἡ'],
            ['i9', 'ἱ'],
            ['o9', 'ὁ'],
            ['u9', 'ὑ'],
            ['w9', 'ὡ'],
            ['a/', 'ά'],
            ['e/', 'έ'],
            ['h/', 'ή'],
            ['i/', 'ί'],
            ['o/', 'ό'],
            ['u/', 'ύ'],
            ['w/', 'ώ'],
            ['a1', 'ἄ'],
            ['e1', 'ἔ'],
            ['h1', 'ἤ'],
            ['i1', 'ἴ'],
            ['o1', 'ὄ'],
            ['u1', 'ὔ'],
            ['w1', 'ὤ'],
            ['a3', 'ἅ'],
            ['e3', 'ἕ'],
            ['h3', 'ἥ'],
            ['i3', 'ἵ'],
            ['o3', 'ὅ'],
            ['u3', 'ὕ'],
            ['w3', 'ὥ'],
            ['a\\', 'ὰ'],
            ['e\\', 'ὲ'],
            ['h\\', 'ὴ'],
            ['i\\', 'ὶ'],
            ['o\\', 'ὸ'],
            ['u\\', 'ὺ'],
            ['w\\', 'ὼ'],
            ['a2', 'ἂ'],
            ['e2', 'ἒ'],
            ['h2', 'ἢ'],
            ['i2', 'ἲ'],
            ['o2', 'ὂ'],
            ['u2', 'ὒ'],
            ['w2', 'ὢ'],
            ['a4', 'ἃ'],
            ['e4', 'ἓ'],
            ['h4', 'ἣ'],
            ['i4', 'ἳ'],
            ['o4', 'ὃ'],
            ['u4', 'ὓ'],
            ['w4', 'ὣ'],
            ['i5', 'ΐ'],
            ['i6', 'ῒ'],
            ['a=', 'ᾶ'],
            ['h=', 'ῆ'],
            ['i=', 'ῖ'],
            ['u=', 'ῦ'],
            ['w=', 'ῶ'],
            ['a]', 'ἆ'],
            ['h]', 'ἦ'],
            ['i]', 'ἶ'],
            ['u]', 'ὖ'],
            ['w]', 'ὦ'],
            ['a[', 'ἇ'],
            ['h[', 'ἧ'],
            ['i[', 'ἷ'],
            ['u[', 'ὗ'],
            ['w[', 'ὧ'],
            ['0A', 'Ἀ'],
            ['0E', 'Ἐ'],
            ['0H', 'Ἠ'],
            ['0I', 'Ἰ'],
            ['0O', 'Ὀ'],
            ['0W', 'Ὠ'],
            ['9A', 'Ἁ'],
            ['9E', 'Ἑ'],
            ['9H', 'Ἡ'],
            ['9I', 'Ἱ'],
            ['9O', 'Ὁ'],
            ['9U', 'Ὑ'],
            ['9W', 'Ὡ'],
            ['/A', 'Ά'],
            ['/E', 'Έ'],
            ['/H', 'Ή'],
            ['/I', 'Ί'],
            ['/O', 'Ό'],
            ['/U', 'Ύ'],
            ['/W', 'Ώ'],
            ['1A', 'Ἄ'],
            ['1E', 'Ἔ'],
            ['1H', 'Ἤ'],
            ['1I', 'Ἴ'],
            ['1O', 'Ὄ'],
            ['1W', 'Ὤ'],
            ['3A', 'Ἅ'],
            ['3E', 'Ἕ'],
            ['3H', 'Ἥ'],
            ['3I', 'Ἵ'],
            ['3O', 'Ὅ'],
            ['3U', 'Ὕ'],
            ['3W', 'Ὥ'],
            ['\\A', 'Ὰ'],
            ['\\E', 'Ὲ'],
            ['\\H', 'Ὴ'],
            ['\\I', 'Ὶ'],
            ['\\O', 'Ὸ'],
            ['\\U', 'Ὺ'],
            ['\\W', 'Ὼ'],
            ['2A', 'Ἂ'],
            ['2E', 'Ἒ'],
            ['2H', 'Ἢ'],
            ['2I', 'Ἲ'],
            ['2O', 'Ὂ'],
            ['2W', 'Ὤ'],
            ['4A', 'Ἃ'],
            ['4E', 'Ἓ'],
            ['4H', 'Ἣ'],
            ['4I', 'Ἳ'],
            ['4O', 'Ὃ'],
            ['4U', 'Ὓ'],
            ['4W', 'Ὣ'],
            [']A', 'Ἆ'],
            [']H', 'Ἦ'],
            [']I', 'Ἶ'],
            [']W', 'Ὦ'],
            ['[A', 'Ἇ'],
            ['[H', 'Ἧ'],
            ['[I', 'Ἷ'],
            ['[U', 'Ὗ'],
            ['[W', 'Ὧ'],
            ['r9', 'ῥ'],
            ['9R', '῾Ρ'],
            ['i+', 'ϊ'],
            ['u+', 'ϋ'],
        ];
    }

    public function wideProvider()
    {
        return [
            ['a)', 'ἀ'],
            ['a(', 'ἁ'],
            ['a&', 'ά'],
        ];
    }

    public function uncombinedProvider()
    {
        return [
            ['a0/', 'ἄ'],
            ['a/0', 'ἄ'],
            ['a)/', 'ἄ'],
            ['a/)', 'ἄ'],
            ['a9/', 'ἅ'],
            ['a/9', 'ἅ'],
            ['a(/', 'ἅ'],
            ['a/(', 'ἅ'],
            ['a0&', 'ἄ'],
            ['a&0', 'ἄ'],
            ['a)&', 'ἄ'],
            ['a&)', 'ἄ'],
            ['a9&', 'ἅ'],
            ['a&9', 'ἅ'],
            ['a(&', 'ἅ'],
            ['a&(', 'ἅ'],

            ['a0\\', 'ἂ'],
            ['a\\0', 'ἂ'],
            ['a)\\', 'ἂ'],
            ['a\\)', 'ἂ'],
            ['a9\\', 'ἃ'],
            ['a\\9', 'ἃ'],
            ['a(\\', 'ἃ'],
            ['a\\(', 'ἃ'],
            ['a0_', 'ἂ'],
            ['a_0', 'ἂ'],
            ['a)_', 'ἂ'],
            ['a_)', 'ἂ'],
            ['a9_', 'ἃ'],
            ['a_9', 'ἃ'],
            ['a(_', 'ἃ'],
            ['a_(', 'ἃ'],

            ['w=0', 'ὦ'],
            ['w0=', 'ὦ'],
            ['w~0', 'ὦ'],
            ['w0~', 'ὦ'],
            ['w=)', 'ὦ'],
            ['w)=', 'ὦ'],
            ['w~)', 'ὦ'],
            ['w)~', 'ὦ'],
            ['w=9', 'ὧ'],
            ['w9=', 'ὧ'],
            ['w~9', 'ὧ'],
            ['w9~', 'ὧ'],
            ['w=(', 'ὧ'],
            ['w(=', 'ὧ'],
            ['w~(', 'ὧ'],
            ['w(~', 'ὧ'],
        ];
    }

    public function subscriptumProvider()
    {
        return [
            ['a|0', 'ᾀ'],
            ['h|0', 'ᾐ'],
            ['w|0', 'ᾠ'],
            ['a|9', 'ᾁ'],
            ['h|9', 'ᾑ'],
            ['w|9', 'ᾡ'],
            ['a|/', 'ᾴ'],
            ['h|/', 'ῄ'],
            ['w|/', 'ῴ'],
            ['a|1', 'ᾄ'],
            ['h|1', 'ᾔ'],
            ['w|1', 'ᾤ'],
            ['a|3', 'ᾅ'],
            ['h|3', 'ᾕ'],
            ['w|3', 'ᾥ'],
            ['a|\\', 'ᾲ'],
            ['h|\\', 'ῂ'],
            ['w|\\', 'ῲ'],
            ['a|2', 'ᾂ'],
            ['h|2', 'ᾒ'],
            ['w|2', 'ᾢ'],
            ['a|4', 'ᾃ'],
            ['h|4', 'ᾓ'],
            ['w|4', 'ᾣ'],
            ['a|=', 'ᾷ'],
            ['h|=', 'ῇ'],
            ['w|=', 'ῷ'],
            ['a|]', 'ᾆ'],
            ['h|]', 'ᾖ'],
            ['w|]', 'ᾦ'],
            ['a|[', 'ᾇ'],
            ['h|[', 'ᾗ'],
            ['w|[', 'ᾧ'],
            ['a0|', 'ᾀ'],
            ['h0|', 'ᾐ'],
            ['w0|', 'ᾠ'],
            ['a9|', 'ᾁ'],
            ['h9|', 'ᾑ'],
            ['w9|', 'ᾡ'],
            ['a/|', 'ᾴ'],
            ['h/|', 'ῄ'],
            ['w/|', 'ῴ'],
            ['a1|', 'ᾄ'],
            ['h1|', 'ᾔ'],
            ['w1|', 'ᾤ'],
            ['a3|', 'ᾅ'],
            ['h3|', 'ᾕ'],
            ['w3|', 'ᾥ'],
            ['a\\|', 'ᾲ'],
            ['h\\|', 'ῂ'],
            ['w\\|', 'ῲ'],
            ['a2|', 'ᾂ'],
            ['h2|', 'ᾒ'],
            ['w2|', 'ᾢ'],
            ['a4|', 'ᾃ'],
            ['h4|', 'ᾓ'],
            ['w4|', 'ᾣ'],
            ['a=|', 'ᾷ'],
            ['h=|', 'ῇ'],
            ['w=|', 'ῷ'],
            ['a]|', 'ᾆ'],
            ['h]|', 'ᾖ'],
            ['w]|', 'ᾦ'],
            ['a[|', 'ᾇ'],
            ['h[|', 'ᾗ'],
            ['w[|', 'ᾧ'],
            ['a|', 'ᾳ'],
            ['h|', 'ῃ'],
            ['w|', 'ῳ'],
        ];
    }
}
