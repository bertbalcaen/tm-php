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
 * Rate limiting status. See rate limiting (api/ratelimiting) for more details on
 * rate limiting.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/QueueStatus).
 */
class QueueStatus implements \jsonSerializable
{
    /**
     * Create a new QueueStatus
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Queueing ID, used to request status updates
     *
     * @var string
     */
    public $id;

    /**
     * The ID of the newly created order. Only returned when a throttled "create order"
     * call has finished queueing.
     *
     * @var int
     */
    public $orderid;

    /**
     * Number of people waiting ahead. Might not be returned when the queue hasn't
     * started yet.
     *
     * @var int
     */
    public $ahead;

    /**
     * Number of milliseconds to wait before requesting a new status update
     *
     * @var int
     */
    public $backoff;

    /**
     * Further instructions on how to handle this error
     *
     * @var string
     */
    public $description;

    /**
     * Optional message shown to waiting customers
     *
     * @var string
     */
    public $message;

    /**
     * Status code: `1`: wait more, `2`: ready to proceed
     *
     * @var int
     */
    public $progress;

    /**
     * Whether the queue has started
     *
     * @var bool
     */
    public $started;

    /**
     * When the queue will start
     *
     * @var \DateTime
     */
    public $starttime;

    /**
     * Unpack QueueStatus from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\QueueStatus
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new QueueStatus(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "orderid" => isset($obj->orderid) ? $obj->orderid : null,
            "ahead" => isset($obj->ahead) ? $obj->ahead : null,
            "backoff" => isset($obj->backoff) ? $obj->backoff : null,
            "description" => isset($obj->description) ? $obj->description : null,
            "message" => isset($obj->message) ? $obj->message : null,
            "progress" => isset($obj->progress) ? $obj->progress : null,
            "started" => isset($obj->started) ? $obj->started : null,
            "starttime" => isset($obj->starttime) ? Json::unpackTimestamp($obj->starttime) : null,
        ));
    }

    /**
     * Serialize QueueStatus to JSON.
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = strval($this->id);
        }
        if (!is_null($this->orderid)) {
            $result["orderid"] = intval($this->orderid);
        }
        if (!is_null($this->ahead)) {
            $result["ahead"] = intval($this->ahead);
        }
        if (!is_null($this->backoff)) {
            $result["backoff"] = intval($this->backoff);
        }
        if (!is_null($this->description)) {
            $result["description"] = strval($this->description);
        }
        if (!is_null($this->message)) {
            $result["message"] = strval($this->message);
        }
        if (!is_null($this->progress)) {
            $result["progress"] = intval($this->progress);
        }
        if (!is_null($this->started)) {
            $result["started"] = (bool)$this->started;
        }
        if (!is_null($this->starttime)) {
            $result["starttime"] = Json::packTimestamp($this->starttime);
        }

        return $result;
    }
}
