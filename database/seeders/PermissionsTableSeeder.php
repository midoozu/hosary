<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 21,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 22,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 23,
                'title' => 'setting_access',
            ],
            [
                'id'    => 24,
                'title' => 'product_management_access',
            ],
            [
                'id'    => 25,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 26,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 27,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 28,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 29,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 30,
                'title' => 'product_tag_create',
            ],
            [
                'id'    => 31,
                'title' => 'product_tag_edit',
            ],
            [
                'id'    => 32,
                'title' => 'product_tag_show',
            ],
            [
                'id'    => 33,
                'title' => 'product_tag_delete',
            ],
            [
                'id'    => 34,
                'title' => 'product_tag_access',
            ],
            [
                'id'    => 35,
                'title' => 'product_create',
            ],
            [
                'id'    => 36,
                'title' => 'product_edit',
            ],
            [
                'id'    => 37,
                'title' => 'product_show',
            ],
            [
                'id'    => 38,
                'title' => 'product_delete',
            ],
            [
                'id'    => 39,
                'title' => 'product_access',
            ],
            [
                'id'    => 40,
                'title' => 'asset_management_access',
            ],
            [
                'id'    => 41,
                'title' => 'asset_category_create',
            ],
            [
                'id'    => 42,
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => 43,
                'title' => 'asset_category_show',
            ],
            [
                'id'    => 44,
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => 45,
                'title' => 'asset_category_access',
            ],
            [
                'id'    => 46,
                'title' => 'asset_location_create',
            ],
            [
                'id'    => 47,
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => 48,
                'title' => 'asset_location_show',
            ],
            [
                'id'    => 49,
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => 50,
                'title' => 'asset_location_access',
            ],
            [
                'id'    => 51,
                'title' => 'asset_status_create',
            ],
            [
                'id'    => 52,
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => 53,
                'title' => 'asset_status_show',
            ],
            [
                'id'    => 54,
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => 55,
                'title' => 'asset_status_access',
            ],
            [
                'id'    => 56,
                'title' => 'asset_create',
            ],
            [
                'id'    => 57,
                'title' => 'asset_edit',
            ],
            [
                'id'    => 58,
                'title' => 'asset_show',
            ],
            [
                'id'    => 59,
                'title' => 'asset_delete',
            ],
            [
                'id'    => 60,
                'title' => 'asset_access',
            ],
            [
                'id'    => 61,
                'title' => 'assets_history_access',
            ],
            [
                'id'    => 62,
                'title' => 'basic_c_r_m_access',
            ],
            [
                'id'    => 63,
                'title' => 'crm_status_create',
            ],
            [
                'id'    => 64,
                'title' => 'crm_status_edit',
            ],
            [
                'id'    => 65,
                'title' => 'crm_status_show',
            ],
            [
                'id'    => 66,
                'title' => 'crm_status_delete',
            ],
            [
                'id'    => 67,
                'title' => 'crm_status_access',
            ],
            [
                'id'    => 68,
                'title' => 'crm_customer_create',
            ],
            [
                'id'    => 69,
                'title' => 'crm_customer_edit',
            ],
            [
                'id'    => 70,
                'title' => 'crm_customer_show',
            ],
            [
                'id'    => 71,
                'title' => 'crm_customer_delete',
            ],
            [
                'id'    => 72,
                'title' => 'crm_customer_access',
            ],
            [
                'id'    => 73,
                'title' => 'crm_note_create',
            ],
            [
                'id'    => 74,
                'title' => 'crm_note_edit',
            ],
            [
                'id'    => 75,
                'title' => 'crm_note_show',
            ],
            [
                'id'    => 76,
                'title' => 'crm_note_delete',
            ],
            [
                'id'    => 77,
                'title' => 'crm_note_access',
            ],
            [
                'id'    => 78,
                'title' => 'crm_document_create',
            ],
            [
                'id'    => 79,
                'title' => 'crm_document_edit',
            ],
            [
                'id'    => 80,
                'title' => 'crm_document_show',
            ],
            [
                'id'    => 81,
                'title' => 'crm_document_delete',
            ],
            [
                'id'    => 82,
                'title' => 'crm_document_access',
            ],
            [
                'id'    => 83,
                'title' => 'clinic_create',
            ],
            [
                'id'    => 84,
                'title' => 'clinic_edit',
            ],
            [
                'id'    => 85,
                'title' => 'clinic_show',
            ],
            [
                'id'    => 86,
                'title' => 'clinic_delete',
            ],
            [
                'id'    => 87,
                'title' => 'clinic_access',
            ],
            [
                'id'    => 88,
                'title' => 'doctor_create',
            ],
            [
                'id'    => 89,
                'title' => 'doctor_edit',
            ],
            [
                'id'    => 90,
                'title' => 'doctor_show',
            ],
            [
                'id'    => 91,
                'title' => 'doctor_delete',
            ],
            [
                'id'    => 92,
                'title' => 'doctor_access',
            ],
            [
                'id'    => 93,
                'title' => 'company_create',
            ],
            [
                'id'    => 94,
                'title' => 'company_edit',
            ],
            [
                'id'    => 95,
                'title' => 'company_show',
            ],
            [
                'id'    => 96,
                'title' => 'company_delete',
            ],
            [
                'id'    => 97,
                'title' => 'company_access',
            ],
            [
                'id'    => 98,
                'title' => 'service_create',
            ],
            [
                'id'    => 99,
                'title' => 'service_edit',
            ],
            [
                'id'    => 100,
                'title' => 'service_show',
            ],
            [
                'id'    => 101,
                'title' => 'service_delete',
            ],
            [
                'id'    => 102,
                'title' => 'service_access',
            ],
            [
                'id'    => 103,
                'title' => 'appointment_create',
            ],
            [
                'id'    => 104,
                'title' => 'appointment_edit',
            ],
            [
                'id'    => 105,
                'title' => 'appointment_show',
            ],
            [
                'id'    => 106,
                'title' => 'appointment_delete',
            ],
            [
                'id'    => 107,
                'title' => 'appointment_access',
            ],
            [
                'id'    => 108,
                'title' => 'branch_create',
            ],
            [
                'id'    => 109,
                'title' => 'branch_edit',
            ],
            [
                'id'    => 110,
                'title' => 'branch_show',
            ],
            [
                'id'    => 111,
                'title' => 'branch_delete',
            ],
            [
                'id'    => 112,
                'title' => 'branch_access',
            ],
            [
                'id'    => 113,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
