<?php
declare(strict_types=1);

use FormFiller\PDF\Field;
use PHPUnit\Framework\TestCase;

/**
 * @covers FormFiller\PDF\Field
 */
final class FieldTest extends TestCase
{

    /**
     * Test if a field is produced with an array of fields
     *
     * @throws Exception
     */
    public function testFieldFromArray(){
        $fields = '[{"cat_name":{"llx":278.585,"lly":363.377,"urx":428.585,"ury":386.902,"width":150,"height":23.525,"page":1}},{"reward":{"llx":366.262,"lly":297.106,"urx":555.914,"ury":314.53,"width":189.652,"height":17.424,"page":1}},{"phone":{"llx":365.753,"lly":250.59,"urx":555.406,"ury":268.523,"width":189.653,"height":17.933,"page":1}}]';

        $fields = json_decode($fields, true);

        $fieldEntities = [];

        foreach($fields as $field) {
            $fieldEntities[] = Field::fieldFromArray($field);
        }

        $this->assertCount( 3, $fieldEntities );
    }

    /**
     * Test field setters + getters
     */
    public function testFieldSettersAndGetters(){
        $field = new Field;
        $field->setId("cat");
        $field->setWidth(420);
        $field->setHeight(420);
        $field->setLlx(420);
        $field->setLly(420);
        $field->setUrx(420);
        $field->setUry(420);
        $field->setPage(1);
        $field->setValue('miaow');

        $this->assertNotNull($field->getId());
        $this->assertNotNull($field->getWidth());
        $this->assertNotNull($field->getHeight());
        $this->assertNotNull($field->getLlx());
        $this->assertNotNull($field->getLly());
        $this->assertNotNull($field->getUrx());
        $this->assertNotNull($field->getUry());
        $this->assertNotNull($field->getPage());
        $this->assertNotNull($field->getValue());
    }
}