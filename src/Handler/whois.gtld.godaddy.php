<?php 
namespace shirakun\Handler;

if (!defined('__GODADDY_HANDLER__')) {
    define('__GODADDY_HANDLER__', 1);
}

use shirakun\Parser;

class godaddy_handler
{
    public function parse($data_str, $query)
    {
        $items = array(
            'owner'           => 'Registrant:',
            'admin'           => 'Administrative Contact',
            'tech'            => 'Technical Contact',
            'domain.name'     => 'Domain Name:',
            'domain.nserver.' => 'Domain servers in listed order:',
            'domain.created'  => 'Created on:',
            'domain.expires'  => 'Expires on:',
            'domain.changed'  => 'Last Updated on:',
            'domain.sponsor'  => 'Registered through:',
        );

        $r          = Parser::get_blocks($data_str, $items);
        $r['owner'] = Parser::get_contact($r['owner']);
        $r['admin'] = Parser::get_contact($r['admin'], false, true);
        $r['tech']  = Parser::get_contact($r['tech'], false, true);
        return Util::format_dates($r, 'dmy');
    }
}
?>