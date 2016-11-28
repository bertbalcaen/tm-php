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

namespace Ticketmatic\Endpoints\Settings;

use Ticketmatic\Client;
use Ticketmatic\ClientException;
use Ticketmatic\Json;
use Ticketmatic\Model\AddVoucherCodes;
use Ticketmatic\Model\Voucher;
use Ticketmatic\Model\VoucherCode;
use Ticketmatic\Model\VoucherQuery;

/**
 * You can find more information about vouchers here (events/vouchers).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_vouchers).
 */
class Vouchers
{

    /**
     * Get a list of vouchers
     *
     * @param Client $client
     * @param \Ticketmatic\Model\VoucherQuery|array $params
     *
     * @throws ClientException
     *
     * @return VouchersList
     */
    public static function getlist(Client $client, $params = null) {
        if ($params == null || is_array($params)) {
            $params = new VoucherQuery($params == null ? array() : $params);
        }
        $req = $client->newRequest("GET", "/{accountname}/settings/vouchers");

        $req->addQuery("typeid", $params->typeid);
        $req->addQuery("filter", $params->filter);
        $req->addQuery("includearchived", $params->includearchived);
        $req->addQuery("lastupdatesince", $params->lastupdatesince);

        $result = $req->run();
        return VouchersList::fromJson($result);
    }

    /**
     * Get a single voucher
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Voucher
     */
    public static function get(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/vouchers/{id}");
        $req->addParameter("id", $id);


        $result = $req->run();
        return Voucher::fromJson($result);
    }

    /**
     * Create a new voucher
     *
     * @param Client $client
     * @param \Ticketmatic\Model\Voucher|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Voucher
     */
    public static function create(Client $client, $data) {
        if ($data == null || is_array($data)) {
            $d = new Voucher($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/vouchers");
        $req->setBody($data);

        $result = $req->run();
        return Voucher::fromJson($result);
    }

    /**
     * Modify an existing voucher
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\Voucher|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\Voucher
     */
    public static function update(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new Voucher($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("PUT", "/{accountname}/settings/vouchers/{id}");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return Voucher::fromJson($result);
    }

    /**
     * Remove a voucher
     *
     * Vouchers are archivable: this call won't actually delete the object from the
     * database. Instead, it will mark the object as archived, which means it won't
     * show up anymore in most places.
     *
     * Most object types are archivable and can't be deleted: this is needed to ensure
     * consistency of historical data.
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     */
    public static function delete(Client $client, $id) {
        $req = $client->newRequest("DELETE", "/{accountname}/settings/vouchers/{id}");
        $req->addParameter("id", $id);


        $req->run();
    }

    /**
     * Fetch translatable fields
     *
     * Returns a dictionary with string values in all languages for each translatable
     * field.
     *
     * See translations (api/coreconcepts/translations) for more information.
     *
     * @param Client $client
     * @param int $id
     *
     * @throws ClientException
     *
     * @return string[]
     */
    public static function translations(Client $client, $id) {
        $req = $client->newRequest("GET", "/{accountname}/settings/vouchers/{id}/translate");
        $req->addParameter("id", $id);


        $result = $req->run();
        return $result;
    }

    /**
     * Update translations
     *
     * Sets updated translation strings.
     *
     * See translations
     * (https://apps.ticketmatic.com/#/knowledgebase/api/coreconcepts/translations) for
     * more information.
     *
     * @param Client $client
     * @param int $id
     * @param string[]|array $data
     *
     * @throws ClientException
     *
     * @return string[]
     */
    public static function translate(Client $client, $id, $data) {
        $req = $client->newRequest("PUT", "/{accountname}/settings/vouchers/{id}/translate");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return $result;
    }

    /**
     * Create voucher codes
     *
     * Creates individual voucher codes.
     *
     * Codes will be randomly generated unless supplied.
     *
     * @param Client $client
     * @param int $id
     * @param \Ticketmatic\Model\AddVoucherCodes|array $data
     *
     * @throws ClientException
     *
     * @return \Ticketmatic\Model\VoucherCode[]
     */
    public static function createcodes(Client $client, $id, $data) {
        if ($data == null || is_array($data)) {
            $d = new AddVoucherCodes($data == null ? array() : $data);
            $data = $d->jsonSerialize();
        }
        $req = $client->newRequest("POST", "/{accountname}/settings/vouchers/{id}/codes");
        $req->addParameter("id", $id);

        $req->setBody($data);

        $result = $req->run();
        return Json::unpackArray("VoucherCode", $result);
    }
}