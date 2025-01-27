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
 * Individual tickets can be updated. Per call you can specify any number of ticket
 * IDs and one operation.
 *
 * Each operation accepts different parameters, dependent on the operation type:
 *
 * * **Set ticket holders**: an array of ticket holder IDs (see Contact
 * (api/types/Contact)), one for each ticket (`ticketholderids`).
 *
 * * **Update price type**: an array of ticket price type IDs (as can be found in
 * the Event pricing (api/types/Event)), one for each ticket (`tickettypepriceids`)
 *
 * * **Add to bundles**: an array of bundle IDs, one for each ticket
 *
 * * **Remove from bundles**: none.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/UpdateTickets).
 */
class UpdateTickets implements \jsonSerializable
{
    /**
     * Create a new UpdateTickets
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Operation to execute.
     *
     * Supported values:
     *
     * * `setticketholders`
     *
     * * `updatepricetype`
     *
     * * `addtobundles`
     *
     * * `removefrombundles`
     *
     * @var string
     */
    public $operation;

    /**
     * Operation parameters
     *
     * @var object[]
     */
    public $params;

    /**
     * Ticket IDs
     *
     * @var int[]
     */
    public $tickets;

    /**
     * Unpack UpdateTickets from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\UpdateTickets
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new UpdateTickets(array(
            "operation" => isset($obj->operation) ? $obj->operation : null,
            "params" => isset($obj->params) ? $obj->params : null,
            "tickets" => isset($obj->tickets) ? $obj->tickets : null,
        ));
    }

    /**
     * Serialize UpdateTickets to JSON.
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->operation)) {
            $result["operation"] = strval($this->operation);
        }
        if (!is_null($this->params)) {
            $result["params"] = $this->params;
        }
        if (!is_null($this->tickets)) {
            $result["tickets"] = $this->tickets;
        }

        return $result;
    }
}
