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

namespace JBZoo\Html\Render;

use JBZoo\Utils\Str;
use JBZoo\Html\ListAbstract;

/**
 * Class Select
 *
 * @package JBZoo\Html\Render
 */
class Select extends ListAbstract
{

    /**
     * Generates an HTML checkbox/radio list.
     *
     * @param array $options
     * @param string $name
     * @param string|array $selected
     * @param array $attrs
     * @param bool|false $tpl
     * @return string
     */
    public function render(array $options, $name, $selected = array(), array $attrs = array(), $tpl = false)
    {
        $selected = (array) $selected;

        $attrs += array(
            'multiple' => false,
            'method'   => 'post'
        );

        if ($attrs['multiple'] === true && !strpos($name, '[]')) {
            $name .= '[]';
        }

        $attrs['name'] = $name;

        $attrs   = $this->_mergeAttr($attrs, $this->_jbSrt('select'));
        $options = $this->_getOptions($options, $selected, $attrs['multiple']);

        return '<select ' . $this->buildAttrs($attrs) . '>' . $options . '</select>';
    }

    /**
     * Check on no selected and add new select option.
     *
     * @param array $options
     * @param array $selected
     * @param bool|false $isMultiply
     * @return array
     */
    protected function _checkNoSelected(array $options, array $selected, $isMultiply = false)
    {
        if ($isMultiply === true) {
            return array($options, $selected);
        }

        $_selected = array_pop($selected);

        if (!array_key_exists($_selected, $options) && !empty($selected)) {
            $options[$_selected] = $this->_translate('--No selected--');
        }

        return array($options, array($_selected));
    }

    /**
     * Create options group.
     *
     * @param string $key
     * @param array $gOptions
     * @param array $selected
     * @param array $options
     * @return string
     */
    protected function _createGroup($key, array $gOptions, array $selected, array $options)
    {
        $count  = 0;
        $label  = (is_int($key)) ? 'Select group ' . $key : $key;
        $output = array(
            '<optgroup label="' . $this->_translate($label) . '">'
        );
        foreach ($gOptions as $value => $label) {
            if (array_key_exists($value, $options)) {
                continue;
            }

            $count++;
            $attrs = array(
                'class' => implode(' ', array(
                    $this->_jbSrt('option'),
                    $this->_jbSrt('option-' . Str::slug($key) . '-' . $count),
                )),
                'value' => $value,
                'selected' => false,
            );

            if (in_array($value, $selected)) {
                $attrs['selected'] = true;
            }

            $output[] = $this->_option($attrs, $label);
        }

        $output[] = '</optgroup>';

        return implode(PHP_EOL, $output);
    }

    /**
     * Get select options.
     *
     * @param array $options
     * @param array $selected
     * @param bool|false $isMultiple
     * @return string
     */
    protected function _getOptions(array $options, array $selected = array(), $isMultiple = false)
    {
        $count  = 0;
        $output = array();

        list($options, $_selected) = $this->_checkNoSelected($options, $selected, $isMultiple);

        foreach ($options as $key => $data) {
            $count++;
            $label = $data;
            $value = $key;
            $attrs = array(
                'value' => $value,
                'selected' => false,
            );

            $classes = implode(' ', array(
                $this->_jbSrt('option'),
                $this->_jbSrt('option-' . $count),
            ));

            if (in_array($value, $_selected)) {
                $attrs['selected'] = true;
            }

            $attrs = $this->_mergeAttr($attrs, $classes);

            if (is_array($data)) {
                $output[] = $this->_createGroup($key, $data, $_selected, $options);
            } else {
                $output[] = $this->_option($attrs, $label);
            }
        }

        return implode(PHP_EOL, $output);
    }

    /**
     * Create option.
     *
     * @param array $attrs
     * @param string $label
     * @return string
     */
    protected function _option(array $attrs, $label)
    {
        return '<option ' . $this->buildAttrs($attrs) . '>' . $this->_translate($label) . '</option>';
    }
}