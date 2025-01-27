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
 * A single order fee definition.
 *
 * More info: see the get operation (api/settings/pricing/orderfeedefinitions/get)
 * and the order fee definitions endpoint
 * (api/settings/pricing/orderfeedefinitions).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/OrderFeeDefinition).
 */
class OrderFeeDefinition implements \jsonSerializable
{
    /**
     * Create a new OrderFeeDefinition
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Unique ID
     *
     * **Note:** Ignored when creating a new order fee definition.
     *
     * **Note:** Ignored when creating a new order fee.
     *
     * @var int
     */
    public $id;

    /**
     * Type of the order fee. Can be Automatic (2401), Script (2402) or Manual (2403)
     *
     * @var int
     */
    public $typeid;

    /**
     * Name for the order fee
     *
     * @var string
     */
    public $name;

    /**
     * Definition of the rule that defines when the order fee will be applied
     *
     * **Note:** Not set when retrieving a list of order fee definitions.
     *
     * **Note:** Not set when retrieving a list of order fees.
     *
     * @var \Ticketmatic\Model\OrderfeeRule
     */
    public $rule;

    /**
     * Whether or not this item is archived
     *
     * **Note:** Ignored when creating a new order fee definition.
     *
     * **Note:** Ignored when creating a new order fee.
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Archived timestamp
     *
     * **Note:** Ignored when creating a new order fee definition.
     *
     * **Note:** Ignored when creating a new order fee.
     *
     * @var \DateTime
     */
    public $archivedts;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new order fee definition.
     *
     * **Note:** Ignored when creating a new order fee.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new order fee definition.
     *
     * **Note:** Ignored when creating a new order fee.
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Unpack OrderFeeDefinition from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\OrderFeeDefinition
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new OrderFeeDefinition(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "typeid" => isset($obj->typeid) ? $obj->typeid : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "rule" => isset($obj->rule) ? OrderfeeRule::fromJson($obj->rule) : null,
            "isarchived" => isset($obj->isarchived) ? $obj->isarchived : null,
            "archivedts" => isset($obj->archivedts) ? Json::unpackTimestamp($obj->archivedts) : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
        ));
    }

    /**
     * Serialize OrderFeeDefinition to JSON.
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
        if (!is_null($this->typeid)) {
            $result["typeid"] = intval($this->typeid);
        }
        if (!is_null($this->name)) {
            $result["name"] = strval($this->name);
        }
        if (!is_null($this->rule)) {
            $result["rule"] = $this->rule;
        }
        if (!is_null($this->isarchived)) {
            $result["isarchived"] = (bool)$this->isarchived;
        }
        if (!is_null($this->archivedts)) {
            $result["archivedts"] = Json::packTimestamp($this->archivedts);
        }
        if (!is_null($this->createdts)) {
            $result["createdts"] = Json::packTimestamp($this->createdts);
        }
        if (!is_null($this->lastupdatets)) {
            $result["lastupdatets"] = Json::packTimestamp($this->lastupdatets);
        }

        return $result;
    }
}
