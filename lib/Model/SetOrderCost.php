<?php
/**
 * Copyright (C) 2014-2017 by Ticketmatic BVBA <developers@ticketmatic.com>
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
 * @link        https://www.ticketmatic.com/
 */

namespace Ticketmatic\Model;

use Ticketmatic\Json;

/**
 * Used to update order costs in an order.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/SetOrderCost).
 */
class SetOrderCost implements \jsonSerializable
{
    /**
     * Create a new SetOrderCost
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * The amount for this ordercost
     *
     * @var float
     */
    public $amount;

    /**
     * Id of the service charge to use for this ordercost
     *
     * @var int
     */
    public $servicechargedefinitionid;

    /**
     * Unpack SetOrderCost from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\SetOrderCost
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new SetOrderCost(array(
            "amount" => isset($obj->amount) ? $obj->amount : null,
            "servicechargedefinitionid" => isset($obj->servicechargedefinitionid) ? $obj->servicechargedefinitionid : null,
        ));
    }

    /**
     * Serialize SetOrderCost to JSON.
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->amount)) {
            $result["amount"] = floatval($this->amount);
        }
        if (!is_null($this->servicechargedefinitionid)) {
            $result["servicechargedefinitionid"] = intval($this->servicechargedefinitionid);
        }

        return $result;
    }
}
