<?php

class M_account extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    // get user profil
    function get_user_profil($params)
    {
        $sql = "SELECT * FROM
                (
                    SELECT a.*, c.role_id, c.role_nm, login_date, ip_address, c.default_page
                    FROM com_user a
                    INNER JOIN com_role_user b ON a.user_id = b.user_id
                    INNER JOIN com_role c ON c.role_id = b.role_id
                    LEFT JOIN com_user_login d ON a.user_id = d.user_id
                    WHERE a.user_id = ? AND c.role_id = ?
                    ORDER BY login_date DESC
                ) result
                GROUP BY user_id";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return [];
        }
    }

    // get user detail
    function get_user_detail_by_username($params)
    {
        $sql = "SELECT a.*, c.role_id, c.role_nm, c.default_page
                FROM com_user a
                LEFT JOIN com_role_user b ON a.user_id = b.user_id
                LEFT JOIN com_role c ON b.role_id = c.role_id
                WHERE user_name = ? AND c.portal_id = ?
                AND c.role_id = ?
                LIMIT 0, 1";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    // get user detail with auto role
    function get_user_detail_by_username_auto_role($params)
    {
        $sql = "SELECT a.*, c.role_id, c.role_nm, c.default_page
                FROM com_user a
                INNER JOIN com_role_user b ON a.user_id = b.user_id
                INNER JOIN com_role c ON b.role_id = c.role_id
                WHERE user_name = ? AND c.portal_id = ?
                LIMIT 0, 1";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    // get login
    function get_user_login($username, $password, $role_id, $portal)
    {
        // get hash key
        $result = $this->get_user_detail_by_username([$username, $portal, $role_id]);
        // update_data_account
        // $params = ['userdemo', 'userdemo', ''];
        // self::update_data_account($params);
        // die('updated');
        if (!empty($result)) {
            // get user
            if (password_verify($password, $result['user_pass'])) {
                // cek authority then return id
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // get login auto role
    function get_user_login_auto_role($username, $password, $portal)
    {
        // process
        // get hash key
        $result = $this->get_user_detail_by_username_auto_role([$username, $portal]);
        if (!empty($result)) {
            // get user
            if (password_verify($password, $result['user_pass'])) {
                // cek authority then return id
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // save user login
    function save_user_login($user_id, $remote_address)
    {
        // get today login
        $sql = "SELECT * FROM com_user_login WHERE user_id = ? AND DATE(login_date) = CURRENT_DATE";
        $query = $this->db->query($sql, [$user_id]);
        if ($query->num_rows() > 0) {
            // tidak perlu diinputkan lagi
            return false;
        } else {
            $sql = "INSERT INTO com_user_login (user_id, login_date, ip_address) VALUES (?, NOW(), ?)";
            return $this->db->query($sql, [$user_id, $remote_address]);
        }
    }

    // save user logout
    function update_user_logout($user_id)
    {
        // update by this date
        $sql = "UPDATE com_user_login SET logout_date = NOW() WHERE user_id = ? AND DATE(login_date) = CURRENT_DATE";
        return $this->db->query($sql, $user_id);
    }

    /*
     * Data Pribadi Pengguna
     */

    // check username
    function is_exist_username($params)
    {
        $sql = "SELECT * FROM com_user WHERE user_name = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $query->free_result();
            return true;
        } else {
            return false;
        }
    }

    // check mail
    function is_exist_email($params)
    {
        $sql = "SELECT * FROM com_user WHERE user_mail = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $query->free_result();
            return true;
        } else {
            return false;
        }
    }

    // check user_id
    function is_exist_id($params)
    {
        $sql = "SELECT * FROM com_user WHERE user_id = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $query->free_result();
            return true;
        } else {
            return false;
        }
    }

    // check password
    function is_exist_password($user_id, $password)
    {
        $sql = "SELECT * FROM com_user WHERE user_id = ?";
        $query = $this->db->query($sql, $user_id);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
        } else {
            return false;
        }
        // --
        if (password_verify($password, $result['user_pass'])) {
            return true;
        } else {
            return false;
        }
    }

    // get user account
    function get_user_account($params)
    {
        $sql = "SELECT * FROM com_user WHERE user_id = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return [];
        }
    }

    // get data operator
    function get_data_operator($params)
    {
        $sql = "SELECT a.*, c.role_id, c.role_nm
                FROM com_user a
                INNER JOIN com_role_user b ON a.user_id = b.user_id
                INNER JOIN com_role c ON b.role_id = c.role_id
                WHERE a.user_id = ?
                GROUP BY a.user_id";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return [];
        }
    }

    // update data account
    function update_data_account($params)
    {
        $sql = "SELECT * FROM com_user WHERE user_id = ?";
        $query = $this->db->query($sql, $params[2]);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
        } else {
            return false;
        }
        // encode password
        $params[1] = password_hash($params[1], PASSWORD_DEFAULT);
        // update
        $sql = "UPDATE com_user SET user_name = ?, user_pass = ?, updated_at = NOW() WHERE user_id = ?";
        return $this->db->query($sql, $params);
    }

    // roles
    function get_all_roles_by_portal($portal_id)
    {
        $sql = "SELECT * FROM com_role WHERE portal_id = ?";
        $query = $this->db->query($sql, $portal_id);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return [];
        }
    }

    // detail roles
    function get_detail_roles_by_id($params)
    {
        $sql = "SELECT * FROM com_role WHERE role_id = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return [];
        }
    }

    // update permissions
    function update_permissions($params)
    {
        // delete by user & portal
        $sql = "DELETE a.* FROM com_role_user a
                INNER JOIN com_role b ON a.role_id = b.role_id
                WHERE a.user_id = ? AND b.portal_id = 2";
        $this->db->query($sql, $params);
        // insert
        $sql = "INSERT INTO com_role_user (user_id, role_id) VALUES (?, ?)";
        return $this->db->query($sql, $params);
    }

    // roles
    function get_all_roles_by_users($params)
    {
        $sql = "SELECT * FROM com_role a
                INNER JOIN com_role_user b ON a.role_id = b.role_id
                WHERE portal_id = ? AND b.user_id = ?
                ORDER BY a.role_nm ASC";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return [];
        }
    }

    function get_detail_user_by_id($params)
    {
        $sql = "SELECT * FROM
                (
                    SELECT a.*, b.role_id, c.role_nm, c.default_page, d.login_date
                    FROM com_user a
                    LEFT JOIN com_role_user b ON a.user_id = b.user_id
                    LEFT JOIN com_role c ON b.role_id = c.role_id
                    LEFT JOIN com_user_login d ON a.user_id = d.user_id
                    WHERE a.user_id = ? AND b.role_id = ?
                    ORDER BY login_date DESC
                ) result
                GROUP BY user_id";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return [];
        }
    }

    function get_user_authorities($params)
    {
        $sql = "SELECT role_id, role_nm FROM com_user u INNER JOIN com_role_user ru USING(user_id) INNER JOIN com_role r USING(role_id) WHERE user_id = ?";

        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return [];
        }
    }

    function get_account_group_by_role()
    {
        $sql = "SELECT COUNT(role_id) as 'jumlah', r.`role_nm`  FROM com_user u INNER JOIN com_role_user ru USING (user_id) INNER JOIN com_role r USING(role_id) GROUP BY role_id";

        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return [];
        }
    }
}
