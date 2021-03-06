<?php
/**
 * JBZoo Html
 *
 * This file is part of the JBZoo CCK package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package   Html
 * @license   MIT
 * @copyright Copyright (C) JBZoo.com,  All rights reserved.
 * @link      https://github.com/JBZoo/Html
 * @author    Sergey Kalistratov <kalistratov.s.m@gmail.com>
 */

namespace JBZoo\PHPUnit;

use JBZoo\Html\Html;

/**
 * Class HiddenTest
 *
 * @package JBZoo\PHPUnit
 */
class HiddenTest extends PHPUnit
{

    /**
     * @var \JBZoo\Html\Html
     */
    protected $html;

    /**
     * @var \JBZoo\Html\Render\Hidden
     */
    protected $hidden;

    /**
     * Setup test data.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->html   = Html::getInstance();
        $this->hidden = $this->html->_('hidden');
    }

    /**
     * Test input text output.
     *
     * @return void
     */
    public function testInputText()
    {
        $actual   = $this->hidden->render('image', 'my-value');
        $expected = '<input name="image" value="my-value" type="hidden" class="jb-input-hidden" />';
        isSame($expected, $actual);

        $actual   = $this->hidden->render('image', 'my-value', 'simple');
        $expected = '<input name="image" value="my-value" type="hidden" class="jb-input-hidden simple" />';
        isSame($expected, $actual);

        $actual   = $this->hidden->render('image', 'my-value', array('simple', 'array'));
        $expected = '<input name="image" value="my-value" type="hidden" class="jb-input-hidden simple array" />';
        isSame($expected, $actual);

        $actual   = $this->hidden->render('image', 'my-value', 'simple', 'unique');
        $expected = '<input name="image" value="my-value" type="hidden" id="unique" class="jb-input-hidden simple" />';
        isSame($expected, $actual);

        $actual = $this->hidden->render('image', 'my-value', 'simple', 'unique', array(
            'name'  => 'name',
            'id'    => 'new-id',
            'type'  => 'failed',
            'value' => 'test value',
        ));

        $expected = '<input name="image" value="my-value" type="hidden" id="unique" class="jb-input-hidden simple" />';
        isSame($expected, $actual);

        $actual = $this->hidden->render('image', 'my-value', '', '', array(
            'data-toggle' => 'tooltip',
            'data-position' => 'top',
        ));

        $expected = '<input name="image" value="my-value" type="hidden" data-toggle="tooltip" data-position="top" class="jb-input-hidden" />';
        isSame($expected, $actual);
    }

    /**
     * Test input hidden group.
     *
     * @return void
     */
    public function testGroup()
    {
        $expected = array(
            array('input' => array(
                'class' => 'jb-input-hidden',
                'name'  => 'test',
                'value' => 'test test',
                'type'  => 'hidden',
            )),
            array('input' => array(
                'class' => 'jb-input-hidden',
                'name'  => 'test2',
                'value' => 'test test2',
                'type'  => 'hidden'
            )),
            array('input' => array(
                'class' => 'jb-input-hidden array-hidden',
                'name'  => 'array',
                'value' => 'val-test',
                'type'  => 'hidden',
                'id'    => 'hide-id',
            )),
        );

        $html = $this->hidden->group(array(
            'test'  => 'test test',
            'test2' => 'test test2',
            'array' => array(
                'value' => 'val-test',
                'class' => 'array-hidden',
                'id'    => 'hide-id',
            ),
        ));

        isHtml($expected, $html);
    }
}
