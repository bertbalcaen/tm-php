<?php
/**
 * Copyright (C) 2014-2016 by Ticketmatic BVBA <developers@ticketmatic.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @license     MIT X11 http://opensource.org/licenses/MIT
 * @author      Ticketmatic BVBA <developers@ticketmatic.com>
 * @copyright   Ticketmatic BVBA
 * @link        http://www.ticketmatic.com/
 */

namespace Ticketmatic\Model;

use Ticketmatic\Json;

/**
 * Templates to allow different seat description for seats
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/SeatDescriptionTemplate).
 */
class SeatDescriptionTemplate implements \jsonSerializable
{
    /**
     * Create a new SeatDescriptionTemplate
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * The name of the template
     *
     * @var string
     */
    public $name;

    /**
     * The ID of the template
     *
     * @var int
     */
    public $it;

    /**
     * The template itself with placeholders for rowname, seatname and zonename
     *
     * @var string
     */
    public $template;

    /**
     * Unpack SeatDescriptionTemplate from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\SeatDescriptionTemplate
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new SeatDescriptionTemplate(array(
            "name" => isset($obj->name) ? $obj->name : null,
            "it" => isset($obj->it) ? $obj->it : null,
            "template" => isset($obj->template) ? $obj->template : null,
        ));
    }

    /**
     * Serialize SeatDescriptionTemplate to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->name)) {
            $result["name"] = strval($this->name);
        }
        if (!is_null($this->it)) {
            $result["it"] = intval($this->it);
        }
        if (!is_null($this->template)) {
            $result["template"] = strval($this->template);
        }

        return $result;
    }
}
