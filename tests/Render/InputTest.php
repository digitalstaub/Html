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
 * Class HtmlTest
 *
 * @package JBZoo\PHPUnit
 */
class InputTest extends PHPUnit
{

    /**
     * @var \JBZoo\Html\Html
     */
    protected $html;

    /**
     * @var \JBZoo\Html\Render\Input
     */
    protected $input;

    /**
     * Setup test data.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->html  = Html::getInstance();
        $this->input = $this->html->_('Input');
    }

    /**
     * Test default renders.
     *
     * @return void.
     */
    public function testDefaultInstance()
    {
        $Html = Html::getInstance();

        isClass('JBZoo\Html\Render\Input', $Html->_('Input'));
        isClass('JBZoo\Html\Render\Input', $Html->_('input'));
    }

    /**
     * Test add custom render.
     *
     * @return void
     */
    public function testCustomAddRender()
    {
        $expected = 'Im test custom render';
        $result   = $this->html->_('test', 'Custom\Html')->render('name', 'value', 'class', 'id');

        isSame($expected, $result);
    }

    /**
     * Test input text output.
     *
     * @return void
     */
    public function testInputText()
    {
        $actual   = $this->input->render('image', 'my-value');
        $expected = '<input name="image" value="my-value" type="text" class="jb-input-text" />';
        isSame($expected, $actual);

        $actual   = $this->input->render('image', 'my-value', 'simple');
        $expected = '<input name="image" value="my-value" type="text" class="jb-input-text simple" />';
        isSame($expected, $actual);

        $actual   = $this->input->render('image', 'my-value', array('simple', 'array'));
        $expected = '<input name="image" value="my-value" type="text" class="jb-input-text simple array" />';
        isSame($expected, $actual);

        $actual   = $this->input->render('image', 'my-value', 'simple', 'unique');
        $expected = '<input name="image" value="my-value" type="text" id="unique" class="jb-input-text simple" />';
        isSame($expected, $actual);

        $actual = $this->input->render('image', 'my-value', 'simple', 'unique', array(
            'name'  => 'name',
            'id'    => 'new-id',
            'type'  => 'failed',
            'value' => 'test value',
        ));

        $expected = '<input name="image" value="my-value" type="text" id="unique" class="jb-input-text simple" />';
        isSame($expected, $actual);

        $actual = $this->input->render('image', 'my-value', '', '', array(
            'data-toggle' => 'tooltip',
            'data-position' => 'top',
        ));

        $expected = '<input name="image" value="my-value" type="text" data-toggle="tooltip" data-position="top" class="jb-input-text" />';
        isSame($expected, $actual);
    }
}
