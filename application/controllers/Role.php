<?php
defined("BASEPATH") or exit("No direct script access allowed");

class Role extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Role_model", "role_model");
        $this->load->model("Permission_model", "permission_model");
        $this->load->model("datatables/Permission_datatables", "dt");
        $this->load->model("datatables/Role_datatables", "rd");
        $this->load->model(
            "datatables/Role_permission_datatables",
            "dt_role_permission"
        );
        $this->auth->only(["read-role"]);
    }

    public function read()
    {
        $data["roles"] = $this->role_model->all();
        $this->load->view("akses_pengguna/v_role_list", $data);
    }

    public function add_permission()
    {
        // Set validation rules
        if ($this->auth->api_access("add_permission-role")) {
            $this->form_validation->set_rules(
                "name",
                "Nama Lengkap",
                "trim|required"
            );
            $this->form_validation->set_rules(
                "display_name",
                "Display Name",
                "trim|required"
            );
            $this->form_validation->set_rules(
                "description",
                "Description",
                "trim|required"
            );

            $output = null;
            if ($this->form_validation->run() == false) {
                $output = [
                    "rc" => "99",
                    "data" => "Harap lengkapi form dengan benar!",
                ];
            } else {
                $data = $this->input->post();
                $isExist = $this->permission_model->find($data["id"]);
                if ($isExist == null) {
                    if ($this->auth->api_access("add_permission-role")) {
                        if ($this->permission_model->add($data)) {
                            $output = [
                                "rc" => "00",
                                "data" => "Data berhasil diinsert",
                            ];
                        } else {
                            $output = [
                                "rc" => "99",
                                "data" => "Data gagal diinsert",
                            ];
                        }
                    } else {
                        $output = [
                            "rc" => "99",
                            "data" => $this->auth->getMessageError(
                                "permission_denied"
                            ),
                        ];
                    }
                } else {
                    if ($this->auth->api_access("update_permission-role")) {
                        if ($this->permission_model->edit($data)) {
                            $output = [
                                "rc" => "00",
                                "data" => "Data berhasil diupdate",
                            ];
                        } else {
                            $output = [
                                "rc" => "99",
                                "data" => "Data gagal diupdate",
                            ];
                        }
                    } else {
                        $output = [
                            "rc" => "99",
                            "data" => $this->auth->getMessageError(
                                "permission_denied"
                            ),
                        ];
                    }
                }
            }
            echo json_encode($output);
        } else {
            echo json_encode([
                "rc" => "99",
                "data" => $this->auth->getMessageError("permission_denied"),
            ]);
        }
    }

    public function add()
    {
        // Set validation rules
        if ($this->auth->api_access("add-role")) {
            $this->form_validation->set_rules(
                "name",
                "Nama Lengkap",
                "trim|required"
            );
            $this->form_validation->set_rules(
                "display_name",
                "Display Name",
                "trim|required"
            );
            $this->form_validation->set_rules(
                "description",
                "Description",
                "trim|required"
            );

            $output = null;
            if ($this->form_validation->run() == false) {
                $output = [
                    "rc" => "99",
                    "data" => "Harap lengkapi form dengan benar!",
                ];
            } else {
                $data = $this->input->post();
                $isExist = $this->role_model->find($data["id"]);
                if ($isExist == null) {
                    if ($this->auth->api_access("add-role")) {
                        if ($this->role_model->add($data)) {
                            $output = [
                                "rc" => "00",
                                "data" => "Data berhasil diinsert",
                            ];
                        } else {
                            $output = [
                                "rc" => "99",
                                "data" => "Data gagal diinsert",
                            ];
                        }
                    } else {
                        $output = [
                            "rc" => "99",
                            "data" => $this->auth->getMessageError(
                                "permission_denied"
                            ),
                        ];
                    }
                } else {
                    if ($this->auth->api_access("update-role")) {
                        if ($this->role_model->edit($data)) {
                            $output = [
                                "rc" => "00",
                                "data" => "Data berhasil diupdate",
                            ];
                        } else {
                            $output = [
                                "rc" => "99",
                                "data" => "Data gagal diupdate",
                            ];
                        }
                    } else {
                        $output = [
                            "rc" => "99",
                            "data" => $this->auth->getMessageError(
                                "permission_denied"
                            ),
                        ];
                    }
                }
            }
            echo json_encode($output);
        } else {
            echo json_encode([
                "rc" => "99",
                "data" => $this->auth->getMessageError("permission_denied"),
            ]);
        }
    }

    public function find_permission($id)
    {
        if (!is_null($id)) {
            $data = $this->permission_model->find($id);
            if (!is_null($data)) {
                echo json_encode(["rc" => "00", "data" => $data]);
            } else {
                echo json_encode([
                    "rc" => "99",
                    "data" => "Data tidak ditemukan",
                ]);
            }
        } else {
            echo json_encode(["rc" => "99", "data" => "Bad Request"]);
        }
    }

    public function find($id)
    {
        if (!is_null($id)) {
            $data = $this->role_model->find($id);
            if (!is_null($data)) {
                echo json_encode(["rc" => "00", "data" => $data]);
            } else {
                echo json_encode([
                    "rc" => "99",
                    "data" => "Data tidak ditemukan",
                ]);
            }
        } else {
            echo json_encode(["rc" => "99", "data" => "Bad Request"]);
        }
    }

    public function getAJaxPermissions()
    {
        $list = $this->dt->get_datatables();
        $data = [];
        $no = $_POST["start"];
        foreach ($list as $item) {
            $no++;
            $row = [];
            $row[] = $item->name;
            $row[] = $item->display_name;
            $row[] = $item->description;

            // Mengubah status menjadi teks
            $status = "Unknown";
            switch ($item->status) {
                case 0:
                    $status = "Deactivated";
                    break;
                case 1:
                    $status = "Activated";
                    break;
            }
            $row[] = $status;
            $row[] =
                '<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button> | 
            <button class="btn btn-sm btn-info" data-pc-animate="fade-in-scale" type="button" data-bs-toggle="modal" data-bs-target="#modal_permission" onclick="showPopupPermission(\'' .
                $item->id .
                '\')"><i class="fa fa-edit"></i></button>';
            $row[] = $item->id;

            $data[] = $row;
        }

        $output = [
            "draw" => $_POST["draw"],
            "recordsTotal" => $this->dt->count_all(),
            "recordsFiltered" => $this->dt->count_filtered(),
            "data" => $data,
        ];
        // Output dalam format JSON
        echo json_encode($output);
    }

    public function roles()
    {
        $list = $this->rd->get_datatables();
        $data = [];
        $no = $_POST["start"];
        foreach ($list as $item) {
            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $item->name;
            $row[] = $item->display_name;
            $row[] = $item->description;

            // Mengubah status menjadi teks
            $status = "Unknown";
            switch ($item->status) {
                case 0:
                    $status = "Deactivated";
                    break;
                case 1:
                    $status = "Activated";
                    break;
            }
            $row[] = $status;
            $row[] =
                '<button class="btn btn-sm btn-danger"
                            onclick="axiosGetDelete(\'role/delete_role/' .
                $item->id .
                '\',\'Menghapus peran ' .
                $item->name .
                '\')"><i
                    class="fa fa-trash"></i></button> | <button class="btn btn-sm btn-info" data-pc-animate="fade-in-scale"
                    type="button" data-bs-toggle="modal" data-bs-target="#modal_peran" onclick="showPopupUpdate(\'' .
                $item->id .
                '\')"><i
                    class="fa fa-edit"></i></button> | <button class="btn btn-sm btn-success" data-pc-animate="fade-in-scale"
                    type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"
                    onclick="showPopupRolePermission(\'' .
                $item->id .
                '\')"><i class="ti ti-accessible"></i></button>';
            $data[] = $row;
        }
        $output = [
            "draw" => $_POST["draw"],
            "recordsTotal" => $this->rd->count_all(),
            "recordsFiltered" => $this->rd->count_filtered(),
            "data" => $data,
        ];

        echo json_encode($output);
    }

    public function delete_role($id)
    {
        if ($this->auth->api_access("delete_role-role")) {
            if (!is_null($id)) {
                if ($this->role_model->delete($id)) {
                    echo json_encode([
                        "rc" => "00",
                        "data" => "Data berhasil dihapus",
                    ]);
                } else {
                    echo json_encode([
                        "rc" => "99",
                        "data" => "Data gagal dihapus",
                    ]);
                }
            } else {
                echo json_encode(["rc" => "99", "data" => "Bad Request"]);
            }
        } else {
            echo json_encode([
                "rc" => "99",
                "data" => $this->auth->getMessageError("permission_denied"),
            ]);
        }
    }

    public function delete_permission($id)
    {
        if ($this->auth->api_access("delete_permission-role")) {
            if (!is_null($id)) {
                if ($this->permission_model->delete($id)) {
                    echo json_encode([
                        "rc" => "00",
                        "data" => "Data berhasil dihapus",
                    ]);
                } else {
                    echo json_encode([
                        "rc" => "99",
                        "data" => "Data gagal dihapus",
                    ]);
                }
            } else {
                echo json_encode(["rc" => "99", "data" => "Bad Request"]);
            }
        } else {
            echo json_encode([
                "rc" => "99",
                "data" => $this->auth->getMessageError("permission_denied"),
            ]);
        }
    }

    public function find_permission_by_role($role_id)
    {
        $list = $this->dt_role_permission->get_roles_permissions($role_id);
        $data = [];
        foreach ($list as $item) {
            $switchBtn = "checked";
            if ($item->permission_status == "false") {
                $switchBtn = "";
            }
            $data[] = [
                $item->role_id,
                $item->role_name,
                $item->role_display_name,
                $item->permission_id,
                $item->permission_name,
                $item->permission_display_name,
                ($status =
                    '<div class="form-check form-switch switch-lg"><input type="checkbox"
                onchange="addOrDeleteRolePermission(\'' .
                    $item->role_id .
                    '\',\'' .
                    $item->permission_id .
                    '\')"
                class="form-check-input input-primary f-16" id="permission_' .
                    $item->permission_id .
                    '" ' .
                    $switchBtn .
                    '></label>
        </div>'),
            ];
        }
        $output = [
            "draw" => $this->input->post("draw"),
            "recordsTotal" => count($list),
            "recordsFiltered" => count($list),
            "data" => $data,
        ];
        echo json_encode($output);
    }

    public function delete_or_add_permission_role($role_id, $permission_id)
    {
        //
        if ($this->auth->api_access("delete_or_add_permission_role-role")) {
            $permission[] = $permission_id;
            $intersection = array_intersect(
                $permission,
                $this->role_model->roleWisePermissions($role_id)
            );
            if (!empty($intersection)) {
                if (
                    $this->role_model->deletePermission(
                        $role_id,
                        $permission_id
                    )
                ) {
                    echo json_encode([
                        "rc" => "00",
                        "data" => "Berhasil di nonaktifkan",
                    ]);
                } else {
                    echo json_encode([
                        "rc" => "99",
                        "data" => "Gagal di nonaktifkan",
                    ]);
                }
                //
            } else {
                $data = [
                    "role_id" => $role_id,
                    "permission_id" => $permission_id,
                ];
                //echo json_encode(array('rc' => '00','data' =>'Must be Added'));
                if ($this->role_model->addPermission($data)) {
                    echo json_encode([
                        "rc" => "00",
                        "data" => "Berhasil di aktifkan",
                    ]);
                } else {
                    echo json_encode([
                        "rc" => "99",
                        "data" => "Gagal di aktifkan",
                    ]);
                }
            }
        } else {
            echo json_encode([
                "rc" => "99",
                "data" => $this->auth->getMessageError("permission_denied"),
            ]);
        }
    }
}