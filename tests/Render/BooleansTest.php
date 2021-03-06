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
 * Class BooleansTest
 *
 * @package JBZoo\PHPUnit
 */
class BooleansTest extends PHPUnit
{

    /**
     * Test tag create.
     *
     * @return void
     */
    public function testRadio()
    {
        $radio = Html::_('radiobool');

        $actual   = $radio->render('show');
        $expected = array(
            array('label' => array('for' => 'preg:/radio-[0-9]+/', 'class' => 'jb-radio-lbl jb-label-0'),
                'input' => array(
                    'id'      => 'preg:/radio-[0-9]+/',
                    'name'    => 'show',
                    'type'    => 'radio',
                    'value'   => 0,
                    'class'   => 'jb-val-0',
                    'checked' => 'checked',
                )),
                ' No',
            '/label',
            array('label' => array('for' => 'preg:/radio-[0-9]+/', 'class' => 'jb-radio-lbl jb-label-1'),
                'input' => array(
                    'id'      => 'preg:/radio-[0-9]+/',
                    'name'    => 'show',
                    'type'    => 'radio',
                    'value'   => 1,
                    'class'   => 'jb-val-1',
                )),
                ' Yes',
            '/label',
        );

        isHtml($expected, $actual);

        $actual = $radio->render('show', 1, array('data-rel' => 'test'), false);
        $expected = array(
            array('input' => array(
                'id'       => 'preg:/radio-[0-9]+/',
                'name'     => 'show',
                'type'     => 'radio',
                'value'    => 0,
                'class'    => 'jb-val-0',
                'data-rel' => 'test',
            )),
            array('label' => array('for' => 'preg:/radio-[0-9]+/', 'class' => 'jb-radio-lbl jb-label-0')),
                'No',
            '/label',

            array('input' => array(
                'id'       => 'preg:/radio-[0-9]+/',
                'name'     => 'show',
                'type'     => 'radio',
                'value'    => 1,
                'class'    => 'jb-val-1',
                'data-rel' => 'test',
                'checked'  => 'checked',
            )),
            array('label' => array('for' => 'preg:/radio-[0-9]+/', 'class' => 'jb-radio-lbl jb-label-1')),
                'Yes',
            '/label',
        );

        isHtml($expected, $actual);
    }

    /**
     * Test bool checkbox.
     *
     * @return void
     */
    public function testCheckbox()
    {
        $radio = Html::_('checkbool');

        $actual = $radio->render('show');
        $expected = array(
            'label' => array('for' => 'preg:/checkbox-[0-9]+/', 'class' => 'jb-checkbox-lbl jb-label-1'),
                'input' => array(
                    'id'    => 'preg:/checkbox-[0-9]+/',
                    'name'  => 'show',
                    'type'  => 'checkbox',
                    'value' => 1,
                    'class' => 'jb-val-1',
                ),
                ' Yes',
            '/label'
        );

        isHtml($expected, $actual);

        $actual = $radio->render('show', 1, array('data-rel' => 'tooltip'), false);
        $expected = array(
            'input' => array(
                'id'       => 'preg:/checkbox-[0-9]+/',
                'name'     => 'show',
                'type'     => 'checkbox',
                'value'    => 1,
                'class'    => 'jb-val-1',
                'data-rel' => 'tooltip',
                'checked'  => 'checked',
            ),
            'label' => array('for' => 'preg:/checkbox-[0-9]+/', 'class' => 'jb-checkbox-lbl jb-label-1'),
                'Yes',
            '/label'
        );

        isHtml($expected, $actual);
    }
}
