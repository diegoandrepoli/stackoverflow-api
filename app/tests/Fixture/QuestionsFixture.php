<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * QuestionsFixture
 *
 */
class QuestionsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'question_id' => ['type' => 'string', 'length' => 700, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'last_update' => ['type' => 'string', 'length' => 700, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'title' => ['type' => 'string', 'length' => 700, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'owner_name' => ['type' => 'string', 'length' => 700, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'score' => ['type' => 'string', 'length' => 700, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'creation_date' => ['type' => 'string', 'length' => 700, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'link' => ['type' => 'string', 'length' => 700, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'is_answered' => ['type' => 'string', 'length' => 700, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'question_id' => 'Lorem ipsum dolor sit amet',
            'last_update' => 'Lorem ipsum dolor sit amet',
            'title' => 'Lorem ipsum dolor sit amet',
            'owner_name' => 'Lorem ipsum dolor sit amet',
            'score' => 'Lorem ipsum dolor sit amet',
            'creation_date' => 'Lorem ipsum dolor sit amet',
            'link' => 'Lorem ipsum dolor sit amet',
            'is_answered' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
