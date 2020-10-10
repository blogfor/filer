<?php

    class Home extends CI_Controller{
        public function index(){
            $this->load->view("home");
        }


        public function upload(){




            // (
            //     [email] => subhadipghosh215@gmail.com
            // )
            // Array
            // (
            //     [zip_file] => Array
            //         (
            //             [name] => froala_editor_3.2.2.zip
            //             [type] => application/x-zip-compressed
            //             [tmp_name] => C:\xampp\tmp\phpBC23.tmp
            //             [error] => 0
            //             [size] => 1786365
            //         )
            
            // )


            

            $config['upload_path']   = 'uploads';
            $config['allowed_types'] = 'iso|rar|zip';
            $config['max_size'] = 10000000;
            $this->load->library('upload', $config);

            $email = $_POST["email"];
            $link = base_url().$config['upload_path'].'/'.$_FILES["zip_file"]["name"];
            $date = date('Y-m-d');
            $name = $_FILES["zip_file"]["name"];

            $fileRow = [
                'email' => $email,
                'link'  => $link,
                'date'  => $date
            ];

            



            $upload = $this->upload->do_upload('zip_file');
                
            if ( !$upload) {
                echo $this->upload->display_errors();
            }                
            else { 
                echo "done";
                $fileDb = $this->db->insert('files', $fileRow);
            }

        }
    }

?>