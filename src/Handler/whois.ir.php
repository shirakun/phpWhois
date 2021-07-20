<?php 
namespace shirakun\Handler;
/**
 * <?php 
namespace shirakun\Handler;Whois IR Lookup Extension - http://github.com/sepehr/<?php 
namespace shirakun\Handler;whois-ir
 *
 * An extension to <?php 
namespace shirakun\Handler;Whois (http://<?php 
namespace shirakun\Handler;whois.org) library to support IR lookups.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

// Define the handler flag.
if (!defined('__IR_HANDLER__')) {
    define('__IR_HANDLER__', 1);
}

// Loadup the parser.
use shirakun\Parser;

/**
 * IR Domain names lookup handler class.
 */
class ir_handler
{
    public function parse($data_str, $query)
    {
        $translate = array(
            'nic-hdl' => 'handle',
            'org'     => 'organization',
            'e-mail'  => 'email',
            'person'  => 'name',
            'fax-no'  => 'fax',
            'domain'  => 'name',
        );

        $contacts = array(
            'admin-c'  => 'admin',
            'tech-c'   => 'tech',
            'holder-c' => 'owner',
        );

        $reg = Parser::generic_parser_a($data_str['rawdata'], $translate, $contacts, 'domain', 'Ymd');

        $r['regrinfo'] = $reg;
        $r['regyinfo'] = array(
            'referrer'  => 'http://whois.nic.ir/',
            'registrar' => 'NIC-IR',
        );
        return $r;
    }
}
