<?php
declare(strict_types=1);

use FormFiller\PDF\Converter\Converter;
use PHPUnit\Framework\TestCase;

/**
 * @covers FormFiller\PDF\Converter\Converter
 */
final class ConverterTest extends TestCase
{

    /**
     * @var array $fakeData
     */
    protected $fakeData;

    /**
     * @var Converter $converter
     */
    protected Converter $converter;

    /**
     * Setup the current test suite
     */
    protected function setUp()
    {
        $this->fakeData = $this->getFakeData();
        $this->converter = new Converter($this->fakeData);
        $this->converter->loadPagesWithFieldsCount();
    }

    /**
     * Test if converter load his pages
     * @cover FormFiller\PDF\Converter\Converter::loadPagesWithFieldsCount()
     */
    public function testPagesLoaded(){
        $this->converter->loadPagesWithFieldsCount();
        $this->assertNotNull($this->converter->getPages());
    }

    /**
     * Test if fields are formatted in JSON
     * @cover FormFiller\PDF\Converter\Converter::formatFieldsAsJSON()
     */
    public function testFieldsFormattedAsJSON(){
        $coords = $this->converter->formatFieldsAsJSON();
        $this->assertEquals(<<<TAG
[{"cat_name":{"llx":278.585,"lly":363.377,"urx":428.585,"ury":386.902,"width":150,"height":23.525,"page":1}},{"reward":{"llx":366.262,"lly":297.106,"urx":555.914,"ury":314.53,"width":189.652,"height":17.424,"page":1}},{"phone":{"llx":365.753,"lly":250.59,"urx":555.406,"ury":268.523,"width":189.653,"height":17.933,"page":1}}]
TAG
, $coords);
    }

	/**
	 * Test if page is find for defined field
	 *
	 * @throws ReflectionException
	 * @uses   Reflection
	 * @covers FormFiller\PDF\Converter\Converter::findPageForField()
	 */
    public function testPageFindForField(){
        $foo = self::getMethod('findPageForField');
        $page = $foo->invokeArgs($this->converter, ["2"]);
        $this->assertEquals(1, $page);
    }

    /**
     * Get fake data for converter
     *
     * @return string
     */
    private function getFakeData(): string {
        return "3 widget annotations found on page 1.
----------------------------------------------

cat_name: 
     llx: 278.585
     lly: 363.377
     urx: 428.585
     ury: 386.902
   width: 150
  height: 23.525


reward: 
     llx: 366.262
     lly: 297.106
     urx: 555.914
     ury: 314.53
   width: 189.652
  height: 17.424


phone: 
     llx: 365.753
     lly: 250.59
     urx: 555.406
     ury: 268.523
   width: 189.653
  height: 17.933";
    }

	/**
	 * Allow to use (and test) private methods
	 *
	 * @param $name
	 *
	 * @return ReflectionMethod
	 * @throws ReflectionException
	 */
    protected static function getMethod($name): ReflectionMethod {
        $class = new ReflectionClass('FormFiller\PDF\Converter\Converter');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }
}