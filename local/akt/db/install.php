<?php

function xmldb_local_akt_install() {
    global $CFG, $DB;
    $dbman = $DB->get_manager();
    $table = new xmldb_table('oauth2_issuer');
    $field = new xmldb_field('companyid', XMLDB_TYPE_INTEGER, '20', null, XMLDB_NOTNULL, null, '0', 'id');


    if (!$dbman->field_exists($table, $field)) {
        $dbman->add_field($table, $field);
    }


}
