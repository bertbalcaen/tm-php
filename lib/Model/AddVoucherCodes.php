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
 * Parameters used to create voucher codes
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/AddVoucherCodes).
 */
class AddVoucherCodes implements \jsonSerializable
{
    /**
     * Create a new AddVoucherCodes
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Value of the voucher
     *
     * @var float
     */
    public $amount;

    /**
     * List of voucher codes, can also (optionally) contain expiry timestamps.
     *
     * @var \Ticketmatic\Model\VoucherCode[]
     */
    public $codes;

    /**
     * Number of codes to create
     *
     * @var int
     */
    public $count;

    /**
     * Whether or not to reactivate and update the expiry of already existing
     * vouchercodes.
     *
     * @var bool
     */
    public $update;

    /**
     * Unpack AddVoucherCodes from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\AddVoucherCodes
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new AddVoucherCodes(array(
            "amount" => isset($obj->amount) ? $obj->amount : null,
            "codes" => isset($obj->codes) ? Json::unpackArray("VoucherCode", $obj->codes) : null,
            "count" => isset($obj->count) ? $obj->count : null,
            "update" => isset($obj->update) ? $obj->update : null,
        ));
    }

    /**
     * Serialize AddVoucherCodes to JSON.
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->amount)) {
            $result["amount"] = floatval($this->amount);
        }
        if (!is_null($this->codes)) {
            $result["codes"] = $this->codes;
        }
        if (!is_null($this->count)) {
            $result["count"] = intval($this->count);
        }
        if (!is_null($this->update)) {
            $result["update"] = (bool)$this->update;
        }

        return $result;
    }
}
