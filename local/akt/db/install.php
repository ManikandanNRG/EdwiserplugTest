<?php

function xmldb_local_akt_install() {
    global $CFG, $DB;
    $dbman = $DB->get_manager();
    $table = new xmldb_table('oauth2_issuer');
    $field = new xmldb_field('companyid', XMLDB_TYPE_INTEGER, '20', null, XMLDB_NOTNULL, null, '0', 'id');


    if (!$dbman->field_exists($table, $field)) {
        $dbman->add_field($table, $field);
    }

    $authrole = $DB->get_record('role', array('id' => "companydepartmentmanager"));
    // Reset all default authenticated users permissions.
    unassign_capability('block/iomad_approve_access:approve', $authrole->id);
    unassign_capability('block/iomad_company_admin:companymanagement_view', $authrole->id);
    unassign_capability('block/iomad_company_admin:coursemanagement_view', $authrole->id);
    unassign_capability('local/iomad_learningpath:manage', $authrole->id);
    unassign_capability('local/iomad_learningpath:view', $authrole->id);
    unassign_capability('local/report_emails:resend', $authrole->id);
    unassign_capability('local/report_emails:view', $authrole->id); 
    $authrole->name = "Tenant Manager";
    $DB->update_record("role", $authrole);
}
